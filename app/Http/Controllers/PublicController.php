<?php

namespace App\Http\Controllers;

use App\Models\Kolam;
use App\Models\Pembudidaya;
use App\Models\JenisIkan;
use App\Models\HasilPanen;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $totalPembudidaya = Pembudidaya::where('status', 'aktif')->count();
        $totalKolam       = Kolam::where('status_kolam', 'aktif')->count();
        $totalJenisIkan   = JenisIkan::where('status', 'aktif')->count();
        $totalPanenKg     = HasilPanen::sum('bobot_kg');
        $recentPanen      = HasilPanen::with(['kolam.pembudidaya', 'jenisIkan'])->latest('tanggal_panen')->take(4)->get();
        $topPembudidaya   = Pembudidaya::withCount('kolam')->where('status', 'aktif')->orderByDesc('kolam_count')->take(4)->get();

        return view('welcome', compact(
            'totalPembudidaya', 'totalKolam', 'totalJenisIkan',
            'totalPanenKg', 'recentPanen', 'topPembudidaya'
        ));
    }

    public function peta()
    {
        $jenisKolam  = ['terpal', 'beton', 'tanah', 'keramba', 'lainnya'];
        $jenisIkanList = JenisIkan::where('status', 'aktif')->orderBy('nama_ikan')->get();
        $totalKolam = Kolam::whereNotNull('latitude')->whereNotNull('longitude')->count();

        return view('public.peta', compact('jenisKolam', 'jenisIkanList', 'totalKolam'));
    }

    public function apiKolamGis(Request $request)
    {
        $query = Kolam::with(['pembudidaya', 'jenisIkan', 'hasilPanen'])
            ->where(function($q) {
                $q->where(function($q2) {
                    $q2->whereNotNull('latitude')->whereNotNull('longitude');
                })->orWhereNotNull('geometry');
            });

        if ($request->filled('jenis_kolam')) {
            $query->where('jenis_kolam', $request->jenis_kolam);
        }

        if ($request->filled('status_kolam')) {
            $query->where('status_kolam', $request->status_kolam);
        }

        if ($request->filled('jenis_ikan_id')) {
            $query->whereHas('jenisIkan', fn($q) => $q->where('jenis_ikan.id', $request->jenis_ikan_id));
        }

        $kolam = $query->get();

        $features = $kolam->map(function ($k) {
            $jenisIkanNames = $k->jenisIkan->pluck('nama_ikan')->join(', ');
            $totalPanen     = $k->hasilPanen->sum('bobot_kg');
            $totalPendapatan = $k->hasilPanen->sum('total_pendapatan');

            $statusColor = match($k->status_kolam) {
                'aktif'       => '#22c55e',
                'tidak_aktif' => '#ef4444',
                'perbaikan'   => '#f59e0b',
                default       => '#6b7280',
            };

            return [
                'type' => 'Feature',
                'geometry' => [
                    'type'        => 'Point',
                    'coordinates' => [$k->longitude, $k->latitude],
                ],
                'properties' => [
                    'id'             => $k->id,
                    'nama_kolam'     => $k->nama_kolam,
                    'jenis_kolam'    => $k->jenis_kolam,
                    'luas_m2'        => $k->luas_m2,
                    'kedalaman_m'    => $k->kedalaman_m,
                    'alamat_kolam'   => $k->alamat_kolam,
                    'status_kolam'   => $k->status_kolam,
                    'status_label'   => $k->status_label,
                    'status_color'   => $statusColor,
                    'pembudidaya'    => $k->pembudidaya?->nama,
                    'pembudidaya_hp' => $k->pembudidaya?->no_hp,
                    'jenis_ikan'     => $jenisIkanNames ?: 'Belum ada',
                    'total_panen_kg' => $totalPanen,
                    'total_pendapatan'=> $totalPendapatan,
                    'detail_url'     => route('public.kolam.show', $k->id),
                    'polygon'        => $k->geometry, // GeoJSON polygon batas kolam
                ],
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $features,
        ]);
    }

    public function cari(Request $request)
    {
        $q = $request->get('q', '');
        $type = $request->get('type', 'all');

        $pembudidaya = collect();
        $kolam = collect();
        $jenisIkan = collect();

        if ($q && strlen($q) >= 2) {
            if (in_array($type, ['all', 'pembudidaya'])) {
                $pembudidaya = Pembudidaya::where('nama', 'like', "%$q%")
                    ->orWhere('nik', 'like', "%$q%")
                    ->orWhere('alamat', 'like', "%$q%")
                    ->withCount('kolam')
                    ->limit(10)->get();
            }

            if (in_array($type, ['all', 'kolam'])) {
                $kolam = Kolam::with(['pembudidaya', 'jenisIkan'])
                    ->where('nama_kolam', 'like', "%$q%")
                    ->orWhere('alamat_kolam', 'like', "%$q%")
                    ->limit(10)->get();
            }

            if (in_array($type, ['all', 'ikan'])) {
                $jenisIkan = JenisIkan::where('nama_ikan', 'like', "%$q%")
                    ->orWhere('nama_latin', 'like', "%$q%")
                    ->limit(10)->get();
            }
        }

        return view('public.cari', compact('q', 'type', 'pembudidaya', 'kolam', 'jenisIkan'));
    }

    public function kolamDetail(Kolam $kolam)
    {
        $kolam->load(['pembudidaya', 'ikanKolam.jenisIkan', 'hasilPanen.jenisIkan']);
        $nearbyKolam = Kolam::with('pembudidaya')
            ->whereNotNull('latitude')
            ->where('id', '!=', $kolam->id)
            ->get()
            ->filter(fn($k) => $this->distance($kolam->latitude, $kolam->longitude, $k->latitude, $k->longitude) < 50)
            ->take(4);

        return view('public.kolam-detail', compact('kolam', 'nearbyKolam'));
    }

    private function distance($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
        return $earthRadius * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }
}
