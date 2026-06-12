<?php

namespace App\Http\Controllers\Api;

use App\Events\TiktokCommentReceived;
use App\Events\TiktokGiftReceived;
use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Services\FortuneService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TiktokWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Simple token authentication
        $token = $request->bearerToken();
        $expectedToken = config('services.tiktok.webhook_secret', 'ramalanku-secret-token');
        
        if ($token !== $expectedToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $type = $request->input('type');
        $data = $request->input('data');

        try {
            match ($type) {
                'chat' => $this->handleChat($data),
                'gift' => $this->handleGift($data),
                'viewer_count' => $this->handleViewerCount($data),
                'like' => $this->handleLike($data),
                default => null,
            };

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('TikTok Webhook Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function handleChat(array $data)
    {
        // Broadcast comment to frontend for overlay display
        event(new TiktokCommentReceived($data));

        // Dispatch job to parse commands and generate fortunes/khodams
        \App\Jobs\ProcessTiktokComment::dispatch($data);
    }

    private function handleGift(array $data)
    {
        event(new TiktokGiftReceived($data));
        
        // You could trigger special overlay effects here based on gift value
    }

    private function handleViewerCount(array $data)
    {
        // Store or broadcast viewer count
    }

    private function handleLike(array $data)
    {
        // Store or broadcast likes
    }
}
