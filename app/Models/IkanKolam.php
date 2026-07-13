<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IkanKolam extends Model
{
    use HasFactory;

    protected $table = 'ikan_kolam';

    protected $fillable = [
        'kolam_id', 'jenis_ikan_id', 'jumlah_benih',
        'tanggal_tebar', 'status', 'catatan',
    ];

    protected $casts = [
        'tanggal_tebar' => 'date',
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
