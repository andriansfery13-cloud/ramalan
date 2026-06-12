<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use App\Models\OverlaySetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AppSettingSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ramalanku.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create demo user
        User::create([
            'name' => 'Demo User',
            'email' => 'demo@ramalanku.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // App Settings
        $settings = [
            // Mode
            ['key' => 'fortune_mode', 'value' => 'template', 'type' => 'string', 'group' => 'mode', 'description' => 'Mode ramalan: template atau openai'],
            ['key' => 'name_analysis_mode', 'value' => 'template', 'type' => 'string', 'group' => 'mode', 'description' => 'Mode arti nama: template atau openai'],
            ['key' => 'roast_mode', 'value' => 'template', 'type' => 'string', 'group' => 'mode', 'description' => 'Mode roast: template atau openai'],
            ['key' => 'aura_mode', 'value' => 'template', 'type' => 'string', 'group' => 'mode', 'description' => 'Mode aura: template atau openai'],

            // OpenAI
            ['key' => 'openai_api_key', 'value' => '', 'type' => 'string', 'group' => 'openai', 'description' => 'API Key OpenAI'],
            ['key' => 'openai_model', 'value' => 'gpt-4o-mini', 'type' => 'string', 'group' => 'openai', 'description' => 'Model OpenAI yang digunakan'],
            ['key' => 'openai_fortune_prompt', 'value' => 'Buat ramalan hiburan yang lucu, positif, aman, tidak mengandung unsur mistik, tidak mengklaim masa depan secara nyata, dan hanya untuk hiburan berdasarkan nama berikut.', 'type' => 'string', 'group' => 'openai', 'description' => 'Prompt untuk ramalan'],

            // TikTok
            ['key' => 'tiktok_auto_mode', 'value' => 'false', 'type' => 'boolean', 'group' => 'tiktok', 'description' => 'Mode auto TikTok Live'],
            ['key' => 'tiktok_trigger_keyword', 'value' => 'ramal aku', 'type' => 'string', 'group' => 'tiktok', 'description' => 'Keyword trigger auto ramalan'],

            // Gift Responses
            ['key' => 'gift_response_rose', 'value' => 'Terima kasih @{user}! 🌹', 'type' => 'string', 'group' => 'gift', 'description' => 'Response untuk gift Rose'],
            ['key' => 'gift_response_heart', 'value' => 'Aura keberuntungan @{user} meningkat! ❤️', 'type' => 'string', 'group' => 'gift', 'description' => 'Response untuk gift Heart'],
            ['key' => 'gift_response_galaxy', 'value' => 'SULTAN TERDETEKSI! @{user} 🌌', 'type' => 'string', 'group' => 'gift', 'description' => 'Response untuk gift Galaxy'],
            ['key' => 'gift_response_universe', 'value' => 'RAJA GALAKSI HADIR! @{user} 🪐', 'type' => 'string', 'group' => 'gift', 'description' => 'Response untuk gift Universe'],

            // General
            ['key' => 'app_name', 'value' => 'Ramalanku', 'type' => 'string', 'group' => 'general', 'description' => 'Nama aplikasi'],
            ['key' => 'app_tagline', 'value' => 'Ramalan Seru, Interaktif, dan Menghibur untuk Live TikTok', 'type' => 'string', 'group' => 'general', 'description' => 'Tagline aplikasi'],
        ];

        foreach ($settings as $setting) {
            AppSetting::create($setting);
        }

        // Default overlay settings
        OverlaySetting::create([
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
