<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('program_editions', function (Blueprint $table) {
            $table->longText('location_map')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('program_editions', function (Blueprint $table) {
            $table->dropColumn('location_map');
        });
    }
};
