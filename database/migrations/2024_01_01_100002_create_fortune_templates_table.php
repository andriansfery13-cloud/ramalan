<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fortune_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type')->default('general'); // general, funny, luck, love
            $table->string('title')->nullable();
            $table->text('content');
            $table->string('emoji')->nullable();
            $table->integer('luck_level')->default(50); // 1-100
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['type', 'sub_category_id']);
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fortune_templates');
    }
};
