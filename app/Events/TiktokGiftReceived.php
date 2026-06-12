<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TiktokGiftReceived implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $gift;

    public function __construct(array $gift)
    {
        $this->gift = $gift;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('tiktok'),
        ];
    }
}
