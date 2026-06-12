<?php

namespace App\Livewire;

use App\Models\SpinnerEntry;
use App\Models\SpinnerSession;
use Livewire\Component;

class SpinnerWheel extends Component
{
    public string $newName = '';
    public array $names = [];
    public ?string $winner = null;
    public bool $isSpinning = false;

    public function addName()
    {
        if (empty(trim($this->newName))) return;
        if (count($this->names) >= 20) return;

        $this->names[] = trim($this->newName);
        $this->newName = '';
    }

    public function removeName(int $index)
    {
        array_splice($this->names, $index, 1);
    }

    public function spin()
    {
        if (count($this->names) < 2) return;

        $this->isSpinning = true;
        $winnerIndex = array_rand($this->names);
        $this->winner = $this->names[$winnerIndex];

        // Save session
        $session = SpinnerSession::create([
            'user_id' => auth()->id(),
            'title' => 'Spinner Session',
            'winner_name' => $this->winner,
            'status' => 'completed',
        ]);

        $colors = ['#3b82f6', '#ef4444', '#22c55e', '#f59e0b', '#8b5cf6', '#ec4899', '#06b6d4', '#f97316'];
        foreach ($this->names as $i => $name) {
            SpinnerEntry::create([
                'spinner_session_id' => $session->id,
                'name' => $name,
                'color' => $colors[$i % count($colors)],
                'is_winner' => $name === $this->winner,
            ]);
        }

        $this->dispatch('spinner-complete', winner: $this->winner);
    }

    public function resetSpinner()
    {
        $this->winner = null;
        $this->isSpinning = false;
    }

    public function render()
    {
        return view('livewire.spinner-wheel');
    }
}
