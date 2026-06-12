<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FortuneGenerated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $fortune;

    public function __construct(array $fortune)
    {
        $this->fortune = $fortune;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('overlay'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'FortuneGenerated';
    }
}
