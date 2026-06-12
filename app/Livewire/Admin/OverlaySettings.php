<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use Livewire\Component;

class OverlaySettings extends Component
{
    public string $themeColor = 'blue';
    public string $animationStyle = 'bounce-in';
    public int $displayDuration = 8;
    public bool $showConfetti = true;

    public function mount()
    {
        $this->themeColor = AppSetting::getValue('overlay_theme_color', 'blue');
        $this->animationStyle = AppSetting::getValue('overlay_animation_style', 'bounce-in');
        $this->displayDuration = (int) AppSetting::getValue('overlay_display_duration', '8');
        $this->showConfetti = AppSetting::getValue('overlay_show_confetti', 'true') === 'true';
    }

    public function save()
    {
        $this->validate([
            'themeColor' => 'required|string',
            'animationStyle' => 'required|string',
            'displayDuration' => 'required|integer|min:3|max:30',
            'showConfetti' => 'boolean',
        ]);

        AppSetting::setValue('overlay_theme_color', $this->themeColor, 'string', 'overlay');
        AppSetting::setValue('overlay_animation_style', $this->animationStyle, 'string', 'overlay');
        AppSetting::setValue('overlay_display_duration', (string) $this->displayDuration, 'integer', 'overlay');
        AppSetting::setValue('overlay_show_confetti', $this->showConfetti ? 'true' : 'false', 'boolean', 'overlay');

        // Dispatch broadcast event so current overlay updates immediately
        event(new \App\Events\OverlayUpdate([
            'themeColor' => $this->themeColor,
            'animationStyle' => $this->animationStyle,
            'displayDuration' => $this->displayDuration,
            'showConfetti' => $this->showConfetti,
        ]));

        $this->dispatch('notify', message: 'Pengaturan Overlay berhasil disimpan & di-broadcast!', type: 'success');
    }

    public function triggerTestPopup()
    {
        $testData = [
            'id' => rand(1000, 9999),
            'name' => 'Fery Tester',
            'title' => 'Cahaya Keberuntungan 🌟',
            'content' => 'Ini adalah tes popup dari dashboard admin. Semua terlihat berjalan dengan sangat baik! Hari ini akan penuh dengan hal positif.',
            'luck_level' => 95,
            'emoji' => '🚀',
            'mode' => 'template',
        ];

        event(new \App\Events\FortuneGenerated($testData));
        $this->dispatch('notify', message: 'Test pop-up dikirim ke overlay!', type: 'success');
    }

    public function render()
    {
        return view('livewire.admin.overlay-settings')
            ->layout('components.layouts.admin', ['title' => 'Pengaturan Overlay OBS']);
    }
}
