<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverlaySetting extends Model
{
    protected $fillable = [
        'user_id', 'background_color', 'text_color', 'accent_color',
        'font_family', 'font_size', 'animation_in', 'animation_out',
        'effect', 'display_duration', 'show_emoji', 'show_luck_bar',
    ];

    protected $casts = [
        'show_emoji' => 'boolean',
        'show_luck_bar' => 'boolean',
    ];

    public static function getForUser(?int $userId = null): self
    {
        if ($userId) {
            $setting = static::where('user_id', $userId)->first();
            if ($setting) return $setting;
        }

        return static::first() ?? new self([
            'background_color' => 'transparent',
            'text_color' => '#ffffff',
            'accent_color' => '#3b82f6',
            'font_family' => 'Outfit',
            'font_size' => 24,
            'animation_in' => 'bounceIn',
            'animation_out' => 'fadeOut',
            'effect' => 'glow',
            'display_duration' => 8,
            'show_emoji' => true,
            'show_luck_bar' => true,
        ]);
    }
}
