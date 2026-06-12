<?php

namespace App\Services;

use App\Models\AppSetting;

class OpenAIService
{
    /**
     * Send a chat completion request to OpenAI.
     */
    public function chat(string $prompt, ?string $systemPrompt = null): string
    {
        $apiKey = AppSetting::getValue('openai_api_key', config('openai.api_key', ''));
        $model = AppSetting::getValue('openai_model', 'gpt-4o-mini');

        if (empty($apiKey)) {
            throw new \RuntimeException('OpenAI API key is not configured.');
        }

        $messages = [];

        if ($systemPrompt) {
            $messages[] = ['role' => 'system', 'content' => $systemPrompt];
        } else {
            $messages[] = [
                'role' => 'system',
                'content' => 'Kamu adalah AI ramalan hiburan yang lucu, positif, dan aman. Semua ramalan bersifat hiburan dan tidak mengklaim kebenaran. Berikan response dalam Bahasa Indonesia.',
            ];
        }

        $messages[] = ['role' => 'user', 'content' => $prompt];

        try {
            $client = \OpenAI::client($apiKey);

            $response = $client->chat()->create([
                'model' => $model,
                'messages' => $messages,
                'max_tokens' => 500,
                'temperature' => 0.8,
            ]);

            return $response->choices[0]->message->content ?? '';
        } catch (\Exception $e) {
            throw new \RuntimeException('OpenAI API error: ' . $e->getMessage());
        }
    }
}
