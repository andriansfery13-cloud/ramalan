<?php

namespace App\Livewire;

use App\Models\Leaderboard;
use Livewire\Component;

class LiveLeaderboard extends Component
{
    public string $activeType = 'hoki';

    public function setType(string $type)
    {
        $this->activeType = $type;
    }

    public function render()
    {
        $types = [
            'hoki' => ['label' => 'Paling Hoki', 'icon' => '🎰', 'color' => 'text-yellow-400'],
            'aktif' => ['label' => 'Paling Aktif', 'icon' => '⚡', 'color' => 'text-blue-400'],
            'sering_diramal' => ['label' => 'Sering Diramal', 'icon' => '🔮', 'color' => 'text-purple-400'],
            'sultan' => ['label' => 'Sultan', 'icon' => '👑', 'color' => 'text-amber-400'],
        ];

        $entries = Leaderboard::ofType($this->activeType)
            ->topScores(20)
            ->get();

        return view('livewire.live-leaderboard', [
            'types' => $types,
            'entries' => $entries,
        ]);
    }
}
