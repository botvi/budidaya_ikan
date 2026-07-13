<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembudidaya', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20)->unique();
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_hp', 20)->nullable();
            $table->string('email')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->date('tanggal_daftar')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembudidaya');
    }
};
