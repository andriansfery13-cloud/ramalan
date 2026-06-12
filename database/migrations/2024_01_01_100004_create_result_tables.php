<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fortunes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('category');
            $table->string('sub_category')->nullable();
            $table->string('title')->nullable();
            $table->text('content');
            $table->integer('luck_level')->default(50);
            $table->string('emoji')->nullable();
            $table->string('mode')->default('template'); // template or openai
            $table->string('source')->default('web'); // web, tiktok, api
            $table->timestamps();

            $table->index(['name', 'category']);
            $table->index('created_at');
        });

        Schema::create('name_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->json('letter_analysis'); // [{letter, meaning, trait}]
            $table->string('dominant_character')->nullable();
            $table->text('personality')->nullable();
            $table->text('strength')->nullable();
            $table->text('potential')->nullable();
            $table->string('mode')->default('template');
            $table->timestamps();
        });

        Schema::create('name_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name_a');
            $table->string('name_b');
            $table->integer('friendship_score')->default(0);
            $table->integer('cooperation_score')->default(0);
            $table->integer('entertainment_score')->default(0);
            $table->integer('romantic_score')->default(0);
            $table->integer('overall_score')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('name_battles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name_a');
            $table->string('name_b');
            $table->integer('score_a')->default(0);
            $table->integer('score_b')->default(0);
            $table->string('winner');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('aura_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('aura_type');
            $table->string('title');
            $table->text('description');
            $table->string('color');
            $table->string('emoji');
            $table->integer('power_level')->default(50);
            $table->string('mode')->default('template');
            $table->timestamps();
        });

        Schema::create('roast_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->text('content');
            $table->string('intensity')->default('mild');
            $table->string('mode')->default('template');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roast_results');
        Schema::dropIfExists('aura_readings');
        Schema::dropIfExists('name_battles');
        Schema::dropIfExists('name_matches');
        Schema::dropIfExists('name_analyses');
        Schema::dropIfExists('fortunes');
    }
};
