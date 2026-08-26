<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_panen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kolam_id')->constrained('kolam')->onDelete('cascade');
            $table->foreignId('jenis_ikan_id')->constrained('jenis_ikan')->onDelete('cascade');
            $table->date('tanggal_panen');
            $table->decimal('total_panen_kg', 10, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_panen');
    }
};
