<?php

namespace App\Services;

use App\Models\AppSetting;
use App\Models\NameAnalysis;
use App\Models\NameMeaningTemplate;

class NameAnalysisService
{
    public function analyze(string $name, ?int $userId = null): array
    {
        $mode = AppSetting::getValue('name_analysis_mode', 'template');

        $result = match ($mode) {
            'openai' => $this->analyzeWithOpenAI($name),
            default => $this->analyzeFromTemplate($name),
        };

        // Save to database
        $analysis = NameAnalysis::create([
            'user_id' => $userId,
            'name' => $name,
            'letter_analysis' => $result['letters'],
            'dominant_character' => $result['dominant_character'],
            'personality' => $result['personality'],
            'strength' => $result['strength'],
            'potential' => $result['potential'],
            'mode' => $mode,
        ]);

        // Broadcast to overlay
        event(new \App\Events\FortuneGenerated([
            'id' => $analysis->id,
            'name' => $name,
            'title' => '✨ Arti Nama: ' . $name,
            'content' => $result['personality'] . ' ' . $result['potential'],
            'luck_level' => rand(75, 95),
            'emoji' => '✨',
            'mode' => $mode,
        ]));

        return $result;
    }

    private function analyzeFromTemplate(string $name): array
    {
        $cleanName = preg_replace('/[^A-Za-z]/', '', strtoupper($name));
        $letters = [];
        $traits = ['personality' => [], 'strength' => [], 'potential' => []];

        foreach (str_split($cleanName) as $char) {
            $template = NameMeaningTemplate::getByLetterHash($char, $name);

            if ($template) {
                $letters[] = [
                    'letter' => $char,
                    'meaning' => $template->meaning,
                    'trait' => $template->trait,
                ];

                if (isset($traits[$template->category])) {
                    $traits[$template->category][] = $template->meaning;
                }
            } else {
                $letters[] = [
                    'letter' => $char,
                    'meaning' => 'Spesial',
                    'trait' => 'Memiliki keunikan tersendiri',
                ];
            }
        }

        // Determine dominant character
        $allMeanings = array_column($letters, 'meaning');
        $dominant = !empty($allMeanings) ? $allMeanings[0] : 'Unik';

        return [
            'name' => $name,
            'letters' => $letters,
            'dominant_character' => $dominant,
            'personality' => !empty($traits['personality'])
                ? 'Kamu adalah orang yang ' . strtolower(implode(', ', array_slice($traits['personality'], 0, 3))) . '.'
                : 'Kamu memiliki kepribadian yang unik dan menarik.',
            'strength' => !empty($traits['strength'])
                ? 'Kekuatanmu terletak pada sifat ' . strtolower(implode(', ', array_slice($traits['strength'], 0, 3))) . '.'
                : 'Kamu memiliki kekuatan yang luar biasa dalam dirimu.',
            'potential' => !empty($traits['potential'])
                ? 'Potensimu sangat besar di bidang ' . strtolower(implode(', ', array_slice($traits['potential'], 0, 3))) . '.'
                : 'Potensimu belum terbatas dan siap untuk berkembang.',
        ];
    }

    private function analyzeWithOpenAI(string $name): array
    {
        try {
            $openAI = app(OpenAIService::class);

            $prompt = "Analisis arti dari nama \"{$name}\" per huruf. Untuk setiap huruf, berikan satu kata sifat positif yang dimulai dengan huruf tersebut beserta penjelasan singkat. Kemudian berikan ringkasan: karakter dominan, kepribadian umum, kekuatan, dan potensi.\n\nFormat JSON:\n{\"letters\": [{\"letter\": \"X\", \"meaning\": \"kata\", \"trait\": \"penjelasan\"}], \"dominant_character\": \"...\", \"personality\": \"...\", \"strength\": \"...\", \"potential\": \"...\"}";

            $result = $openAI->chat($prompt);
            $data = json_decode($result, true);

            if ($data && isset($data['letters'])) {
                $data['name'] = $name;
                return $data;
            }
        } catch (\Exception $e) {
            // Fallback
        }

        return $this->analyzeFromTemplate($name);
    }
}
