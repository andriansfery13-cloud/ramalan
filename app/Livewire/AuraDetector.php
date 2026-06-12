<?php

namespace App\Livewire;

use App\Services\AuraDetectorService;
use Livewire\Component;

class AuraDetector extends Component
{
    public string $name = '';
    public ?array $result = null;

    protected $rules = ['name' => 'required|min:2|max:50'];

    public function detect()
    {
        $this->validate();
        $service = app(AuraDetectorService::class);
        $this->result = $service->detect($this->name, auth()->id());
    }

    public function resetResult()
    {
        $this->result = null;
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.aura-detector');
    }
}
