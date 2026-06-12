<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OverlayUpdate implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $settings;

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('overlay'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'OverlayUpdate';
    }
}
