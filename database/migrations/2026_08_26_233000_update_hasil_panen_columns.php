<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_panen', function (Blueprint $table) {
            if (Schema::hasColumn('hasil_panen', 'bobot_kg')) {
                $table->dropColumn('bobot_kg');
            }
            if (Schema::hasColumn('hasil_panen', 'jumlah_ekor')) {
                $table->dropColumn('jumlah_ekor');
            }
            if (Schema::hasColumn('hasil_panen', 'harga_per_kg')) {
                $table->dropColumn('harga_per_kg');
            }
            if (Schema::hasColumn('hasil_panen', 'total_pendapatan')) {
                $table->dropColumn('total_pendapatan');
            }
            if (!Schema::hasColumn('hasil_panen', 'total_panen_kg')) {
                $table->decimal('total_panen_kg', 10, 2)->default(0)->after('tanggal_panen');
            }
        });
    }

    public function down(): void
    {
        Schema::table('hasil_panen', function (Blueprint $table) {
            if (Schema::hasColumn('hasil_panen', 'total_panen_kg')) {
                $table->dropColumn('total_panen_kg');
            }
            $table->decimal('bobot_kg', 10, 2)->default(0);
            $table->integer('jumlah_ekor')->default(0);
            $table->decimal('harga_per_kg', 12, 2)->default(0);
            $table->decimal('total_pendapatan', 15, 2)->default(0);
        });
    }
};
