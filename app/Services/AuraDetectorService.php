<?php

namespace App\Services;

use App\Models\AuraReading;
use App\Models\AuraTemplate;
use App\Models\AppSetting;

class AuraDetectorService
{
    public function detect(string $name, ?int $userId = null): array
    {
        $mode = AppSetting::getValue('aura_mode', 'template');

        $result = match ($mode) {
            'openai' => $this->detectWithOpenAI($name),
            default => $this->detectFromTemplate($name),
        };

        $aura = AuraReading::create([
            'user_id' => $userId,
            'name' => $name,
            'aura_type' => $result['aura_type'],
            'title' => $result['title'],
            'description' => $result['description'],
            'color' => $result['color'],
            'emoji' => $result['emoji'],
            'power_level' => $result['power_level'],
            'mode' => $mode,
        ]);

        event(new \App\Events\FortuneGenerated([
            'id' => $aura->id,
            'name' => $name,
            'title' => '🌈 Aura: ' . $result['title'],
            'content' => $result['description'],
            'luck_level' => $result['power_level'],
            'emoji' => $result['emoji'],
            'mode' => $mode,
        ]));

        return $result;
    }

    private function detectFromTemplate(string $name): array
    {
        $auraType = AuraTemplate::getAuraTypeForName($name);
        $template = AuraTemplate::active()
            ->where('aura_type', $auraType)
            ->get();

        if ($template->isEmpty()) {
            return [
                'name' => $name,
                'aura_type' => 'positif',
                'title' => 'Aura Positif',
                'description' => 'Kamu memancarkan energi positif yang kuat!',
                'color' => '#22c55e',
                'emoji' => '✨',
                'power_level' => rand(60, 95),
            ];
        }

        $hash = abs(crc32(strtolower(trim($name))));
        $selected = $template[$hash % $template->count()];

        return [
            'name' => $name,
            'aura_type' => $selected->aura_type,
            'title' => $selected->title,
            'description' => $selected->description,
            'color' => $selected->color,
            'emoji' => $selected->emoji,
            'power_level' => rand(60, 95),
        ];
    }

    private function detectWithOpenAI(string $name): array
    {
        try {
            $openAI = app(OpenAIService::class);
            $auraTypes = 'Sultan, Positif, Misterius, Anime, Gamer, Ambisius, Santai';

            $prompt = "Deteksi aura dari nama \"{$name}\". Pilih salah satu tipe aura: {$auraTypes}. Berikan judul aura, deskripsi 2-3 kalimat yang lucu dan positif, warna hex, emoji, dan power level 60-95.\n\nFormat JSON:\n{\"aura_type\": \"...\", \"title\": \"...\", \"description\": \"...\", \"color\": \"#...\", \"emoji\": \"...\", \"power_level\": angka}";

            $result = $openAI->chat($prompt);
            $data = json_decode($result, true);

            if ($data && isset($data['aura_type'])) {
                $data['name'] = $name;
                return $data;
            }
        } catch (\Exception $e) {
            // Fallback
        }

        return $this->detectFromTemplate($name);
    }
}
