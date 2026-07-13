<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIkan extends Model
{
    use HasFactory;

    protected $table = 'jenis_ikan';

    protected $fillable = [
        'nama_ikan', 'nama_latin', 'deskripsi', 'gambar',
        'umur_panen_hari', 'status',
    ];

    public function ikanKolam()
    {
        return $this->hasMany(IkanKolam::class);
    }

    public function hasilPanen()
    {
        return $this->hasMany(HasilPanen::class);
    }

    public function kolam()
    {
        return $this->belongsToMany(Kolam::class, 'ikan_kolam');
    }
}
