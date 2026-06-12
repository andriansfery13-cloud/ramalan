<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\KhodamService;
use App\Models\AppSetting;

class KhodamCheck extends Component
{
    public $name = '';
    public $result = null;
    public $isLoading = false;

    public function checkKhodam(KhodamService $service)
    {
        $this->validate([
            'name' => 'required|string|max:100',
        ]);

        $this->isLoading = true;
        
        $mode = AppSetting::getValue('global_mode', 'template');
        $userId = auth()->id();

        $this->result = $service->checkKhodam($this->name, $userId, $mode);
        
        $this->isLoading = false;
    }

    public function resetCheck()
    {
        $this->reset(['name', 'result', 'isLoading']);
    }

    public function render()
    {
        return view('livewire.khodam-check')->layout('components.layouts.app');
    }
}
