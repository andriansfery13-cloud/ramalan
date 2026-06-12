<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('khodam_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('type')->default('hewan'); // hewan, hantu, benda, dsb
            $table->string('emoji')->default('👻');
            $table->integer('power_level')->default(50);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('khodam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('target_name');
            $table->string('khodam_name');
            $table->text('description');
            $table->string('emoji')->nullable();
            $table->integer('power_level')->default(50);
            $table->string('mode')->default('template');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khodam_results');
        Schema::dropIfExists('khodam_templates');
    }
};
