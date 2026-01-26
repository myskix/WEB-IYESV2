<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // Hapus kolom rating
            $table->dropColumn('rating');
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // (Opsional) Jika di-rollback, kembalikan kolomnya
            $table->integer('rating')->default(5)->nullable();
        });
    }
};
