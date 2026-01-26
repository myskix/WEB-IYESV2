<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Programs (Brand Utama)
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: "IYES Future Leader"
            $table->string('slug')->unique();
            $table->text('brief_description');
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('icon')->nullable(); // Untuk tampilan grid icon
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0); // Untuk mengatur urutan tampilan
            $table->timestamps();
        });

        // 2. Program Editions (Batch/Angkatan)
        Schema::create('program_editions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Contoh: "Batch 1 - 2024"
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['upcoming', 'open_registration', 'ongoing', 'completed'])->default('upcoming');
            $table->string('registration_link')->nullable();
            $table->timestamps();
        });

        // 3. Alumni
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_edition_id')->nullable()->constrained()->nullOnDelete(); // Relasi ke batch spesifik
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('current_position')->nullable(); // Jabatan sekarang
            $table->string('company_or_institution')->nullable(); // Tempat kerja/kuliah
            $table->string('linkedin_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
        Schema::dropIfExists('program_editions');
        Schema::dropIfExists('programs');
    }
};
