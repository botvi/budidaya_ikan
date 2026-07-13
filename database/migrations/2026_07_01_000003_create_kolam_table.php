<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kolam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembudidaya_id')->constrained('pembudidaya')->onDelete('cascade');
            $table->string('nama_kolam');
            $table->enum('jenis_kolam', ['terpal', 'beton', 'tanah', 'keramba', 'lainnya'])->default('tanah');
            $table->decimal('luas_m2', 10, 2)->nullable()->comment('Luas kolam dalam m2');
            $table->decimal('kedalaman_m', 5, 2)->nullable()->comment('Kedalaman dalam meter');
            $table->string('alamat_kolam');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status_kolam', ['aktif', 'tidak_aktif', 'perbaikan'])->default('aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kolam');
    }
};
