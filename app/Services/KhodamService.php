<?php

namespace App\Services;

use App\Models\KhodamResult;
use App\Models\KhodamTemplate;
use Illuminate\Support\Facades\Cache;

class KhodamService
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function checkKhodam(string $name, ?int $userId = null, string $mode = 'template'): array
    {
        // Cache key based on name to keep it consistent
        $cacheKey = "khodam_" . md5(strtolower(trim($name))) . "_{$mode}";

        $result = Cache::remember($cacheKey, now()->addHours(24), function () use ($name, $mode) {
            if ($mode === 'openai' && config('services.openai.api_key')) {
                return $this->checkWithOpenAI($name);
            }
            return $this->checkFromTemplate($name);
        });

        // Save result
        $khodam = KhodamResult::create([
            'user_id' => $userId,
            'target_name' => $name,
            'khodam_name' => $result['khodam_name'],
            'description' => $result['description'],
            'emoji' => $result['emoji'],
            'power_level' => $result['power_level'],
            'mode' => $mode,
        ]);

        // Broadcast to overlay
        event(new \App\Events\FortuneGenerated([
            'id' => $khodam->id,
            'name' => $name,
            'title' => '👻 Khodam: ' . $result['khodam_name'],
            'content' => $result['description'],
            'luck_level' => $result['power_level'],
            'emoji' => $result['emoji'],
            'mode' => $mode,
        ]));

        return $khodam->toArray();
    }

    protected function checkFromTemplate(string $name): array
    {
        $template = KhodamTemplate::getByNameHash($name);

        if (!$template) {
            return [
                'khodam_name' => 'Kucing Oren Biasa',
                'description' => 'Tidak terdeteksi khodam kuat, hanya ada kucing oren yang numpang tidur di pundakmu.',
                'emoji' => '🐈',
                'power_level' => 10,
            ];
        }

        return [
            'khodam_name' => $template->name,
            'description' => $template->description,
            'emoji' => $template->emoji,
            'power_level' => $template->power_level,
        ];
    }

    protected function checkWithOpenAI(string $name): array
    {
        try {
            $prompt = "Buatkan hasil 'Cek Khodam' (pendamping gaib/hewan mistis/hantu lucu ala Indonesia) untuk nama: {$name}.
            Berikan nama khodam yang lucu atau unik (seperti Buaya Darat, Macan Tutul Pink, Pocong Ngesot, Naga Sunda, dll).
            Kembalikan dalam format JSON: 
            {
                \"khodam_name\": \"Nama Khodam\",
                \"description\": \"Deskripsi lucu dan kocak tentang khodam ini dan apa efeknya ke {$name} (max 3 kalimat)\",
                \"emoji\": \"Satu emoji yang cocok\",
                \"power_level\": \"Angka integer 1-100\"
            }";

            $response = $this->openAIService->generateText($prompt);
            $data = json_decode($response, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($data['khodam_name'])) {
                return $data;
            }
        } catch (\Exception $e) {
            \Log::error('OpenAI Khodam Error: ' . $e->getMessage());
        }

        return $this->checkFromTemplate($name);
    }
}
