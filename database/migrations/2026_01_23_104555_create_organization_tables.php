<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Pages (Konten Statis: About Us, Vision Mission)
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('thumbnail')->nullable(); // Banner halaman
            $table->timestamps();
        });

        // 2. Board Members (Pengurus)
        Schema::create('board_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position'); // Jabatan
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('period')->nullable(); // "2024-2025"
            $table->integer('sort_order')->default(0); // Agar Ketua muncul paling atas
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. Partners (Mitra & Sponsor)
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->string('url')->nullable();
            $table->enum('type', ['sponsor', 'media_partner', 'university', 'government'])->default('sponsor');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });

        // 4. Annual Reports (Laporan Tahunan - PDF)
        Schema::create('annual_reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->year('year'); // 2024, 2025
            $table->string('file_path'); // Lokasi file PDF
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });

        // 5. Testimonials
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role_or_company')->nullable(); // "CEO of X" atau "Student"
            $table->text('content');
            $table->string('photo')->nullable();
            $table->integer('rating')->default(5); // Bintang 1-5
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 6. Contacts (Pesan Masuk)
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->text('message');
            $table->boolean('is_read')->default(false); // Penanda sudah dibaca admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('annual_reports');
        Schema::dropIfExists('partners');
        Schema::dropIfExists('board_members');
        Schema::dropIfExists('pages');
    }
};