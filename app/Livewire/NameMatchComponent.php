<?php

namespace App\Livewire;

use App\Services\NameMatchService;
use Livewire\Component;

class NameMatchComponent extends Component
{
    public string $nameA = '';
    public string $nameB = '';
    public ?array $result = null;

    protected $rules = [
        'nameA' => 'required|min:2|max:50',
        'nameB' => 'required|min:2|max:50',
    ];

    public function match()
    {
        $this->validate();
        $service = app(NameMatchService::class);
        $this->result = $service->match($this->nameA, $this->nameB, auth()->id());
    }

    public function resetResult()
    {
        $this->result = null;
        $this->nameA = '';
        $this->nameB = '';
    }

    public function render()
    {
        return view('livewire.name-match');
    }
}
