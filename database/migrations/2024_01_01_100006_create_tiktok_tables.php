<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('viewers', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('display_name')->nullable();
            $table->string('platform')->default('tiktok');
            $table->integer('fortune_count')->default(0);
            $table->integer('gift_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->timestamps();

            $table->index('username');
        });

        Schema::create('tiktok_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('room_id')->nullable();
            $table->string('host_username')->nullable();
            $table->string('status')->default('active'); // active, ended
            $table->integer('viewer_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->integer('gift_count')->default(0);
            $table->timestamps();
        });

        Schema::create('tiktok_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiktok_session_id')->constrained()->cascadeOnDelete();
            $table->string('username');
            $table->text('comment');
            $table->boolean('is_processed')->default(false);
            $table->timestamps();
        });

        Schema::create('tiktok_gifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiktok_session_id')->constrained()->cascadeOnDelete();
            $table->string('username');
            $table->string('gift_name');
            $table->integer('gift_count')->default(1);
            $table->integer('diamond_count')->default(0);
            $table->string('response')->nullable();
            $table->boolean('is_processed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tiktok_gifts');
        Schema::dropIfExists('tiktok_comments');
        Schema::dropIfExists('tiktok_sessions');
        Schema::dropIfExists('viewers');
    }
};
