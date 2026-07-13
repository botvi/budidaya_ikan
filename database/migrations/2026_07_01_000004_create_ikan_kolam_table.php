<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ikan_kolam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kolam_id')->constrained('kolam')->onDelete('cascade');
            $table->foreignId('jenis_ikan_id')->constrained('jenis_ikan')->onDelete('cascade');
            $table->integer('jumlah_benih')->default(0)->comment('Jumlah benih ditebar');
            $table->date('tanggal_tebar')->nullable();
            $table->enum('status', ['aktif', 'panen', 'gagal'])->default('aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ikan_kolam');
    }
};
