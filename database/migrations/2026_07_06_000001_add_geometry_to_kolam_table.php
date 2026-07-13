<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kolam', function (Blueprint $table) {
            // Simpan GeoJSON polygon bentuk kolam (text/JSON)
            $table->text('geometry')->nullable()->after('longitude')
                  ->comment('GeoJSON polygon bentuk kolam');
        });
    }

    public function down(): void
    {
        Schema::table('kolam', function (Blueprint $table) {
            $table->dropColumn('geometry');
        });
    }
};
