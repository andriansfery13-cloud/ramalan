<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spinner_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title')->default('Spinner');
            $table->string('winner_name')->nullable();
            $table->string('status')->default('pending'); // pending, spinning, completed
            $table->timestamps();
        });

        Schema::create('spinner_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spinner_session_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('color')->nullable();
            $table->boolean('is_winner')->default(false);
            $table->timestamps();
        });

        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id();
            $table->string('viewer_name');
            $table->string('type')->default('hoki'); // hoki, aktif, sering_diramal, sultan
            $table->integer('score')->default(0);
            $table->string('session_id')->nullable();
            $table->timestamps();

            $table->index(['type', 'score']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderboards');
        Schema::dropIfExists('spinner_entries');
        Schema::dropIfExists('spinner_sessions');
    }
};
