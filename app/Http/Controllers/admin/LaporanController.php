<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pembudidaya;
use App\Models\Kolam;
use App\Models\JenisIkan;
use App\Models\HasilPanen;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // ================= Laporan Pembudidaya =================
        $pembudidaya = Pembudidaya::withCount('kolam')
            ->orderBy('nama')
            ->get();

        // ================= Laporan Kolam =================
        $kolam = Kolam::with(['pembudidaya', 'jenisIkan'])
            ->orderBy('nama_kolam')
            ->get();

        // ================= Laporan Jenis Ikan =================
        $jenisIkan = JenisIkan::withCount(['ikanKolam', 'hasilPanen'])
            ->orderBy('nama_ikan')
            ->get();

        // ================= Laporan Hasil Panen (dengan filter) =================
        $hasilPanenQuery = HasilPanen::with(['kolam.pembudidaya', 'jenisIkan']);

        if ($request->filled('jenis_ikan_id')) {
            $hasilPanenQuery->where('jenis_ikan_id', $request->jenis_ikan_id);
        }

        if ($request->filled('bulan')) {
            $hasilPanenQuery->whereMonth('tanggal_panen', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $hasilPanenQuery->whereYear('tanggal_panen', $request->tahun);
        }

        $hasilPanen = $hasilPanenQuery->orderByDesc('tanggal_panen')->get();

        $totalBobotPanen      = $hasilPanen->sum('total_panen_kg');

        $jenisIkanList = JenisIkan::orderBy('nama_ikan')->get();

        return view('admin.laporan.index', compact(
            'pembudidaya',
            'kolam',
            'jenisIkan',
            'hasilPanen',
            'totalBobotPanen',
            'jenisIkanList'
        ));
    }

    public function print(Request $request)
    {
        $type = $request->get('type', 'all'); // 'all', 'kolam', 'jenis-ikan', 'hasil-panen', 'pembudidaya'

        // ================= Laporan Pembudidaya =================
        $pembudidaya = Pembudidaya::withCount('kolam')
            ->orderBy('nama')
            ->get();

        // ================= Laporan Kolam =================
        $kolam = Kolam::with(['pembudidaya', 'jenisIkan', 'hasilPanen'])
            ->orderBy('nama_kolam')
            ->get();

        // ================= Laporan Jenis Ikan =================
        $jenisIkan = JenisIkan::withCount(['ikanKolam', 'hasilPanen'])
            ->orderBy('nama_ikan')
            ->get();

        // ================= Laporan Hasil Panen (dengan filter) =================
        $hasilPanenQuery = HasilPanen::with(['kolam.pembudidaya', 'jenisIkan']);

        if ($request->filled('jenis_ikan_id')) {
            $hasilPanenQuery->where('jenis_ikan_id', $request->jenis_ikan_id);
        }

        if ($request->filled('bulan')) {
            $hasilPanenQuery->whereMonth('tanggal_panen', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $hasilPanenQuery->whereYear('tanggal_panen', $request->tahun);
        }

        $hasilPanen = $hasilPanenQuery->orderByDesc('tanggal_panen')->get();
        $totalBobotPanen = $hasilPanen->sum('total_panen_kg');
        $jenisIkanList = JenisIkan::orderBy('nama_ikan')->get();

        return view('admin.laporan.print', compact(
            'type',
            'pembudidaya',
            'kolam',
            'jenisIkan',
            'hasilPanen',
            'totalBobotPanen',
            'jenisIkanList'
        ));
    }
}
