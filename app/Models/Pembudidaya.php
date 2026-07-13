<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembudidaya extends Model
{
    use HasFactory;

    protected $table = 'pembudidaya';

    protected $fillable = [
        'nik', 'nama', 'alamat', 'no_hp', 'email',
        'jenis_kelamin', 'tanggal_daftar', 'status', 'keterangan',
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
    ];

    public function kolam()
    {
        return $this->hasMany(Kolam::class);
    }

    public function getTotalKolamAttribute()
    {
        return $this->kolam()->count();
    }

    public function getTotalKolamAktifAttribute()
    {
        return $this->kolam()->where('status_kolam', 'aktif')->count();
    }
}
