<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPanen extends Model
{
    use HasFactory;

    protected $table = 'hasil_panen';

    protected $fillable = [
        'kolam_id', 'jenis_ikan_id', 'tanggal_panen', 'total_panen_kg', 'keterangan',
    ];

    protected $casts = [
        'tanggal_panen'   => 'date',
        'total_panen_kg'  => 'float',
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
