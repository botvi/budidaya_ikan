<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolam extends Model
{
    use HasFactory;

    protected $table = 'kolam';

    protected $fillable = [
        'pembudidaya_id', 'nama_kolam', 'jenis_kolam', 'luas_m2',
        'kedalaman_m', 'alamat_kolam', 'latitude', 'longitude',
        'geometry', 'status_kolam', 'keterangan', 'foto_kolam',
    ];

    protected $casts = [
        'latitude'    => 'float',
        'longitude'   => 'float',
        'luas_m2'     => 'float',
        'kedalaman_m' => 'float',
        'geometry'    => 'array',
    ];

    public function pembudidaya()
    {
        return $this->belongsTo(Pembudidaya::class);
    }

    public function ikanKolam()
    {
        return $this->hasMany(IkanKolam::class);
    }

    public function hasilPanen()
    {
        return $this->hasMany(HasilPanen::class);
    }

    public function jenisIkan()
    {
        return $this->belongsToMany(JenisIkan::class, 'ikan_kolam');
    }

    public function getTotalPanenKgAttribute()
    {
        return $this->hasilPanen()->sum('bobot_kg');
    }

    public function getTotalPendapatanAttribute()
    {
        return $this->hasilPanen()->sum('total_pendapatan');
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status_kolam) {
            'aktif'       => 'Aktif',
            'tidak_aktif' => 'Tidak Aktif',
            'perbaikan'   => 'Perbaikan',
            default       => ucfirst($this->status_kolam),
        };
    }

    public function hasCoordinates(): bool
    {
        return $this->latitude !== null && $this->longitude !== null;
    }

    public function hasGeometry(): bool
    {
        return !empty($this->geometry);
    }
}
