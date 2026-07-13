<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pembudidaya;
use App\Models\JenisIkan;
use App\Models\Kolam;
use App\Models\HasilPanen;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPembudidaya = Pembudidaya::where('status', 'aktif')->count();
        $totalKolam       = Kolam::count();
        $totalKolamAktif  = Kolam::where('status_kolam', 'aktif')->count();
        $totalJenisIkan   = JenisIkan::where('status', 'aktif')->count();
        $totalPanenKg     = HasilPanen::sum('bobot_kg');
        $totalPendapatan  = HasilPanen::sum('total_pendapatan');
        $totalPanen       = HasilPanen::count();

        // Panen per bulan (6 bulan terakhir)
        $panenPerBulan = HasilPanen::selectRaw('MONTH(tanggal_panen) as bulan, YEAR(tanggal_panen) as tahun, SUM(bobot_kg) as total_kg, SUM(total_pendapatan) as total_pendapatan')
            ->where('tanggal_panen', '>=', now()->subMonths(6))
            ->groupByRaw('MONTH(tanggal_panen), YEAR(tanggal_panen)')
            ->orderByRaw('YEAR(tanggal_panen), MONTH(tanggal_panen)')
            ->get();

        // Kolam terbaru dengan koordinat
        $kolamTerbaru = Kolam::with(['pembudidaya', 'jenisIkan'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->take(5)
            ->get();

        // Top jenis ikan berdasarkan total panen
        $topIkan = HasilPanen::with('jenisIkan')
            ->selectRaw('jenis_ikan_id, SUM(bobot_kg) as total_kg, SUM(total_pendapatan) as total_pendapatan, COUNT(*) as jumlah_panen')
            ->groupBy('jenis_ikan_id')
            ->orderByDesc('total_kg')
            ->take(5)
            ->get();

        // Recent panen
        $recentPanen = HasilPanen::with(['kolam.pembudidaya', 'jenisIkan'])
            ->latest('tanggal_panen')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalPembudidaya', 'totalKolam', 'totalKolamAktif', 'totalJenisIkan',
            'totalPanenKg', 'totalPendapatan', 'totalPanen',
            'panenPerBulan', 'kolamTerbaru', 'topIkan', 'recentPanen'
        ));
    }
}
