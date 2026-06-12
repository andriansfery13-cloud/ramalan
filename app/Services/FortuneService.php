<?php

namespace App\Services;

use App\Models\AppSetting;
use App\Models\Fortune;
use App\Models\FortuneTemplate;
use App\Models\SubCategory;

class FortuneService
{
    /**
     * Generate a fortune based on name and category.
     */
    public function generate(string $name, string $category, ?string $subCategory = null, ?int $userId = null): array
    {
        $mode = AppSetting::getValue('fortune_mode', 'template');

        $result = match ($mode) {
            'openai' => $this->generateFromOpenAI($name, $category, $subCategory),
            default => $this->generateFromTemplate($name, $category, $subCategory),
        };

        // Save to database
        $fortune = Fortune::create([
            'user_id' => $userId,
            'name' => $name,
            'category' => $category,
            'sub_category' => $subCategory,
            'title' => $result['title'],
            'content' => $result['content'],
            'luck_level' => $result['luck_level'],
            'emoji' => $result['emoji'],
            'mode' => $mode,
            'source' => 'web',
        ]);

        $result['id'] = $fortune->id;
        
        // Broadcast to overlay
        event(new \App\Events\FortuneGenerated($result));

        return $result;
    }

    private function generateFromTemplate(string $name, string $category, ?string $subCategory = null): array
    {
        // Map category to template type
        $typeMap = [
            'umum' => 'general',
            'cinta' => 'love',
            'karier' => 'general',
            'hiburan' => 'funny',
            'tiktok-live' => 'luck',
        ];

        $type = $typeMap[$category] ?? 'general';

        // Try to get by sub-category first
        $subCatId = null;
        if ($subCategory) {
            $subCat = SubCategory::where('slug', $subCategory)->first();
            $subCatId = $subCat?->id;
        }

        $template = FortuneTemplate::getByNameHash($name, $type, $subCatId);

        if (!$template) {
            $template = FortuneTemplate::getByNameHash($name, $type);
        }

        if (!$template) {
            return [
                'title' => 'Ramalan untuk ' . $name,
                'content' => 'Hari ini adalah hari yang penuh potensi untuk kamu, ' . $name . '! Tetap semangat dan jangan lupa tersenyum!',
                'luck_level' => rand(50, 90),
                'emoji' => '🌟',
            ];
        }

        return [
            'title' => $template->title . ' untuk ' . $name,
            'content' => $template->content,
            'luck_level' => $template->luck_level,
            'emoji' => $template->emoji,
        ];
    }

    private function generateFromOpenAI(string $name, string $category, ?string $subCategory = null): array
    {
        $openAIService = app(OpenAIService::class);

        $categoryLabel = match ($category) {
            'umum' => 'Kehidupan Umum',
            'cinta' => 'Cinta & Asmara',
            'karier' => 'Karier & Pekerjaan',
            'hiburan' => 'Hiburan & Lucu',
            'tiktok-live' => 'TikTok Live Special',
            default => 'Umum',
        };

        $prompt = AppSetting::getValue('openai_fortune_prompt',
            'Buat ramalan hiburan yang lucu, positif, aman, tidak mengandung unsur mistik, tidak mengklaim masa depan secara nyata, dan hanya untuk hiburan.'
        );

        $fullPrompt = "{$prompt}\n\nNama: {$name}\nKategori: {$categoryLabel}" .
            ($subCategory ? "\nSub-kategori: {$subCategory}" : '') .
            "\n\nBerikan response dalam format JSON:\n{\"title\": \"judul ramalan\", \"content\": \"isi ramalan (2-3 kalimat)\", \"luck_level\": angka 1-100, \"emoji\": \"emoji sesuai\"}";

        try {
            $result = $openAIService->chat($fullPrompt);
            $data = json_decode($result, true);

            if ($data && isset($data['content'])) {
                return [
                    'title' => $data['title'] ?? 'Ramalan untuk ' . $name,
                    'content' => $data['content'],
                    'luck_level' => $data['luck_level'] ?? rand(50, 90),
                    'emoji' => $data['emoji'] ?? '🔮',
                ];
            }
        } catch (\Exception $e) {
            // Fallback to template
        }

        return $this->generateFromTemplate($name, $category, $subCategory);
    }
}
