<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use Livewire\Component;

class ModeSettings extends Component
{
    // Modes
    public string $fortuneMode = 'template';
    public string $nameAnalysisMode = 'template';
    public string $roastMode = 'template';
    public string $auraMode = 'template';

    // OpenAI Config
    public string $openaiApiKey = '';
    public string $openaiModel = 'gpt-4o-mini';
    public string $openaiFortunePrompt = '';

    public function mount()
    {
        $this->fortuneMode = AppSetting::getValue('fortune_mode', 'template');
        $this->nameAnalysisMode = AppSetting::getValue('name_analysis_mode', 'template');
        $this->roastMode = AppSetting::getValue('roast_mode', 'template');
        $this->auraMode = AppSetting::getValue('aura_mode', 'template');

        $this->openaiApiKey = AppSetting::getValue('openai_api_key', '');
        $this->openaiModel = AppSetting::getValue('openai_model', 'gpt-4o-mini');
        $this->openaiFortunePrompt = AppSetting::getValue('openai_fortune_prompt', 'Buat ramalan hiburan yang lucu, positif, aman, tidak mengandung unsur mistik, tidak mengklaim masa depan secara nyata, dan hanya untuk hiburan berdasarkan nama berikut.');
    }

    public function saveModes()
    {
        AppSetting::setValue('fortune_mode', $this->fortuneMode, 'string', 'mode');
        AppSetting::setValue('name_analysis_mode', $this->nameAnalysisMode, 'string', 'mode');
        AppSetting::setValue('roast_mode', $this->roastMode, 'string', 'mode');
        AppSetting::setValue('aura_mode', $this->auraMode, 'string', 'mode');

        $this->dispatch('settings-saved', section: 'Mode Aplikasi');
    }

    public function saveOpenAIConfig()
    {
        $this->validate([
            'openaiApiKey' => 'nullable|string',
            'openaiModel' => 'required|string',
            'openaiFortunePrompt' => 'required|string',
        ]);

        AppSetting::setValue('openai_api_key', $this->openaiApiKey, 'string', 'openai');
        AppSetting::setValue('openai_model', $this->openaiModel, 'string', 'openai');
        AppSetting::setValue('openai_fortune_prompt', $this->openaiFortunePrompt, 'string', 'openai');

        $this->dispatch('settings-saved', section: 'Konfigurasi OpenAI');
    }

    public function render()
    {
        return view('livewire.admin.mode-settings')
            ->layout('components.layouts.admin', ['title' => 'Pengaturan Mode & AI']);
    }
}
