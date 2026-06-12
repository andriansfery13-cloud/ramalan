<?php

namespace App\Livewire;

use App\Services\RoastService;
use Livewire\Component;

class RoastGenerator extends Component
{
    public string $name = '';
    public string $intensity = 'mild';
    public ?array $result = null;

    protected $rules = ['name' => 'required|min:2|max:50'];

    public function roast()
    {
        $this->validate();
        $service = app(RoastService::class);
        $this->result = $service->roast($this->name, $this->intensity, auth()->id());
    }

    public function resetResult()
    {
        $this->result = null;
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.roast-generator');
    }
}
