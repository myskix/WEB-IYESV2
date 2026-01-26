<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Tambah kolom 'focus_areas' di tabel Programs
        Schema::table('programs', function (Blueprint $table) {
            $table->json('focus_areas')->nullable()->after('description');
            // Isinya nanti array: [['title' => 'Lingkungan', 'icon' => 'fas fa-tree'], ...]
        });

        // 2. Tambah kolom Deskripsi, Capaian, & Galeri di tabel Program Editions
        Schema::table('program_editions', function (Blueprint $table) {
            $table->longText('description')->nullable()->after('location'); // Deskripsi khusus edisi
            $table->json('achievements')->nullable()->after('description'); // Repeater Capaian
            $table->json('gallery')->nullable()->after('achievements'); // Multiple Upload
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn('focus_areas');
        });

        Schema::table('program_editions', function (Blueprint $table) {
            $table->dropColumn(['description', 'achievements', 'gallery']);
        });
    }
};
