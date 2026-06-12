<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TiktokCommentReceived implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $comment;

    public function __construct(array $comment)
    {
        $this->comment = $comment;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('tiktok'),
        ];
    }
}
