<?php

namespace App\Services;

use App\Models\AppSetting;
use App\Models\RoastResult;
use App\Models\RoastTemplate;

class RoastService
{
    public function roast(string $name, string $intensity = 'mild', ?int $userId = null): array
    {
        $mode = AppSetting::getValue('roast_mode', 'template');

        $result = match ($mode) {
            'openai' => $this->roastWithOpenAI($name, $intensity),
            default => $this->roastFromTemplate($name, $intensity),
        };

        $roast = RoastResult::create([
            'user_id' => $userId,
            'name' => $name,
            'content' => $result['content'],
            'intensity' => $intensity,
            'mode' => $mode,
        ]);

        event(new \App\Events\FortuneGenerated([
            'id' => $roast->id,
            'name' => $name,
            'title' => '🔥 Roast: ' . $name,
            'content' => $result['content'],
            'luck_level' => match($intensity) {
                'mild' => 80,
                'medium' => 50,
                'spicy' => 20,
                default => 50
            },
            'emoji' => '🔥',
            'mode' => $mode,
        ]));

        return $result;
    }

    private function roastFromTemplate(string $name, string $intensity): array
    {
        $template = RoastTemplate::getByNameHash($name, $intensity);

        if (!$template) {
            $template = RoastTemplate::getByNameHash($name, 'mild');
        }

        $content = $template
            ? str_replace('{name}', $name, $template->content)
            : "Hei {$name}, kamu tuh kayak WiFi gratis — semua orang seneng denger namamu, tapi nggak ada yang beneran paham kenapa. 😂";

        return [
            'name' => $name,
            'content' => $content,
            'intensity' => $intensity,
        ];
    }

    private function roastWithOpenAI(string $name, string $intensity): array
    {
        try {
            $openAI = app(OpenAIService::class);

            $intensityLabel = match ($intensity) {
                'mild' => 'ringan dan ramah',
                'medium' => 'sedang dan lucu',
                'spicy' => 'pedas tapi tetap sopan',
                default => 'ringan',
            };

            $prompt = "Buat roasting lucu untuk nama \"{$name}\" dengan intensitas {$intensityLabel}. ATURAN: Tidak boleh menghina fisik, tidak SARA, tidak toxic. Harus lucu, kreatif, dan menghibur. Berikan 1 roasting saja dalam 2-3 kalimat.";

            $systemPrompt = "Kamu adalah komedian stand-up yang ramah. Semua roasting harus bersifat hiburan, tidak menyakiti perasaan, dan membuat orang tertawa. Gunakan Bahasa Indonesia gaul.";

            $content = $openAI->chat($prompt, $systemPrompt);

            return [
                'name' => $name,
                'content' => $content,
                'intensity' => $intensity,
            ];
        } catch (\Exception $e) {
            return $this->roastFromTemplate($name, $intensity);
        }
    }
}
