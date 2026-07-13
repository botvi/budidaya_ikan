<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPanen extends Model
{
    use HasFactory;

    protected $table = 'hasil_panen';

    protected $fillable = [
        'kolam_id', 'jenis_ikan_id', 'tanggal_panen', 'bobot_kg',
        'jumlah_ekor', 'harga_per_kg', 'total_pendapatan', 'keterangan',
    ];

    protected $casts = [
        'tanggal_panen'   => 'date',
        'bobot_kg'        => 'float',
        'harga_per_kg'    => 'float',
        'total_pendapatan'=> 'float',
    ];

    public function kolam()
    {
        return $this->belongsTo(Kolam::class);
    }

    public function jenisIkan()
    {
        return $this->belongsTo(JenisIkan::class);
    }
}
