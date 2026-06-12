<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use Livewire\Component;

class GeneralSettings extends Component
{
    public string $appName = 'Ramalanku';
    public string $appTagline = 'Ramalan Seru, Interaktif, dan Menghibur untuk Live TikTok';
    
    public bool $tiktokAutoMode = false;
    public string $tiktokTriggerKeyword = 'ramal aku';
    public string $tiktokGiftResponse = 'Aura keberuntungan {user} meningkat!';

    public function mount()
    {
        $this->appName = AppSetting::getValue('app_name', 'Ramalanku');
        $this->appTagline = AppSetting::getValue('app_tagline', 'Ramalan Seru, Interaktif, dan Menghibur untuk Live TikTok');
        
        $this->tiktokAutoMode = AppSetting::getValue('tiktok_auto_mode', 'false') === 'true';
        $this->tiktokTriggerKeyword = AppSetting::getValue('tiktok_trigger_keyword', 'ramal aku');
        $this->tiktokGiftResponse = AppSetting::getValue('tiktok_gift_response', 'Aura keberuntungan {user} meningkat!');
    }

    public function saveSystemSettings()
    {
        $this->validate([
            'appName' => 'required|string|max:255',
            'appTagline' => 'required|string|max:255',
        ]);

        AppSetting::setValue('app_name', $this->appName, 'string', 'system');
        AppSetting::setValue('app_tagline', $this->appTagline, 'string', 'system');

        $this->dispatch('notify', message: 'Pengaturan Sistem berhasil disimpan!', type: 'success');
    }

    public function saveTiktokSettings()
    {
        $this->validate([
            'tiktokAutoMode' => 'boolean',
            'tiktokTriggerKeyword' => 'required|string|max:50',
            'tiktokGiftResponse' => 'required|string|max:255',
        ]);

        AppSetting::setValue('tiktok_auto_mode', $this->tiktokAutoMode ? 'true' : 'false', 'boolean', 'tiktok');
        AppSetting::setValue('tiktok_trigger_keyword', $this->tiktokTriggerKeyword, 'string', 'tiktok');
        AppSetting::setValue('tiktok_gift_response', $this->tiktokGiftResponse, 'string', 'tiktok');

        $this->dispatch('notify', message: 'Pengaturan Integrasi TikTok berhasil disimpan!', type: 'success');
    }

    public function render()
    {
        return view('livewire.admin.general-settings')
            ->layout('components.layouts.admin', ['title' => 'Pengaturan Umum']);
    }
}
