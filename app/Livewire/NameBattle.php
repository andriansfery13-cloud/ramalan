<?php

namespace App\Livewire;

use App\Services\NameBattleService;
use Livewire\Component;

class NameBattle extends Component
{
    public string $nameA = '';
    public string $nameB = '';
    public ?array $result = null;

    protected $rules = [
        'nameA' => 'required|min:2|max:50',
        'nameB' => 'required|min:2|max:50',
    ];

    public function battle()
    {
        $this->validate();
        $service = app(NameBattleService::class);
        $this->result = $service->battle($this->nameA, $this->nameB, auth()->id());
    }

    public function resetResult()
    {
        $this->result = null;
        $this->nameA = '';
        $this->nameB = '';
    }

    public function render()
    {
        return view('livewire.name-battle');
    }
}
