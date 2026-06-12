<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeaderboardUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $leaderboard;

    public function __construct(array $leaderboard = [])
    {
        $this->leaderboard = $leaderboard;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('leaderboard'),
        ];
    }
}
