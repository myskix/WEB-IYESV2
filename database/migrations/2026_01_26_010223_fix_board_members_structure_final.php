<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('board_members', function (Blueprint $table) {
            // 1. Hapus kolom period lama (yang String)
            if (Schema::hasColumn('board_members', 'period')) {
                $table->dropColumn('period');
            }

            // 2. Tambah kolom is_founder (jika belum ada)
            if (!Schema::hasColumn('board_members', 'is_founder')) {
                $table->boolean('is_founder')->default(false)->after('position');
            }

            // 3. Tambah kolom division (jika belum ada)
            if (!Schema::hasColumn('board_members', 'division')) {
                $table->string('division')->nullable()->after('is_founder');
            }
        });

        // 4. Buat ulang kolom period dengan tipe JSON (agar bisa Multi-Select)
        Schema::table('board_members', function (Blueprint $table) {
            if (!Schema::hasColumn('board_members', 'period')) {
                $table->json('period')->nullable()->after('position');
            }
        });
    }

    public function down(): void
    {
        // Opsi Rollback
    }
};
