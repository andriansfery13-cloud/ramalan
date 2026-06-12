<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string'); // string, boolean, integer, json
            $table->string('group')->default('general');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('overlay_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('background_color')->default('transparent');
            $table->string('text_color')->default('#ffffff');
            $table->string('accent_color')->default('#3b82f6');
            $table->string('font_family')->default('Outfit');
            $table->integer('font_size')->default(24);
            $table->string('animation_in')->default('bounceIn');
            $table->string('animation_out')->default('fadeOut');
            $table->string('effect')->default('glow'); // glow, confetti, sparkle, neon
            $table->integer('display_duration')->default(8); // seconds
            $table->boolean('show_emoji')->default(true);
            $table->boolean('show_luck_bar')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overlay_settings');
        Schema::dropIfExists('app_settings');
    }
};
