<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('name_meaning_templates', function (Blueprint $table) {
            $table->id();
            $table->char('letter', 1);
            $table->string('meaning'); // e.g., "Friendly"
            $table->string('trait'); // e.g., "Ramah dan mudah bergaul"
            $table->string('category')->default('general'); // personality, strength, potential
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('letter');
        });

        Schema::create('roast_templates', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('intensity')->default('mild'); // mild, medium, spicy
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('aura_templates', function (Blueprint $table) {
            $table->id();
            $table->string('aura_type'); // sultan, positif, misterius, anime, gamer, ambisius, santai
            $table->string('title');
            $table->text('description');
            $table->string('color');
            $table->string('emoji');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('aura_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aura_templates');
        Schema::dropIfExists('roast_templates');
        Schema::dropIfExists('name_meaning_templates');
    }
};
