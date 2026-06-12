<?php

namespace App\Livewire;

use App\Services\NameAnalysisService;
use Livewire\Component;

class NameAnalysis extends Component
{
    public string $name = '';
    public ?array $result = null;

    protected $rules = ['name' => 'required|min:2|max:50'];

    public function analyze()
    {
        $this->validate();
        $service = app(NameAnalysisService::class);
        $this->result = $service->analyze($this->name, auth()->id());
    }

    public function resetResult()
    {
        $this->result = null;
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.name-analysis');
    }
}
