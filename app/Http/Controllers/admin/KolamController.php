<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use App\Models\Pembudidaya;
use App\Models\JenisIkan;
use App\Models\IkanKolam;
use Illuminate\Http\Request;

class KolamController extends Controller
{
    public function index(Request $request)
    {
        $query = Kolam::with(['pembudidaya', 'jenisIkan']);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama_kolam', 'like', "%$s%")
                  ->orWhere('alamat_kolam', 'like', "%$s%")
                  ->orWhereHas('pembudidaya', fn($p) => $p->where('nama', 'like', "%$s%"));
            });
        }

        if ($request->filled('jenis_kolam')) {
            $query->where('jenis_kolam', $request->jenis_kolam);
        }

        if ($request->filled('status_kolam')) {
            $query->where('status_kolam', $request->status_kolam);
        }

        if ($request->filled('pembudidaya_id')) {
            $query->where('pembudidaya_id', $request->pembudidaya_id);
        }

        $kolam = $query->latest()->paginate(15)->withQueryString();
        $pembudidayaList = Pembudidaya::where('status', 'aktif')->orderBy('nama')->get();

        return view('admin.kolam.index', compact('kolam', 'pembudidayaList'));
    }

    public function create()
    {
        $pembudidayaList = Pembudidaya::where('status', 'aktif')->orderBy('nama')->get();
        $jenisIkanList   = JenisIkan::where('status', 'aktif')->orderBy('nama_ikan')->get();
        return view('admin.kolam.create', compact('pembudidayaList', 'jenisIkanList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pembudidaya_id' => 'required|exists:pembudidaya,id',
            'nama_kolam'     => 'required|string|max:255',
            'jenis_kolam'    => 'required|in:terpal,beton,tanah,keramba,lainnya',
            'luas_m2'        => 'nullable|numeric|min:0',
            'kedalaman_m'    => 'nullable|numeric|min:0',
            'alamat_kolam'   => 'required|string',
            'latitude'       => 'nullable|numeric|between:-90,90',
            'longitude'      => 'nullable|numeric|between:-180,180',
            'status_kolam'   => 'required|in:aktif,tidak_aktif,perbaikan',
            'keterangan'     => 'nullable|string',
            'foto_kolam'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_kolam')) {
            $file = $request->file('foto_kolam');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kolam'), $filename);
            $validated['foto_kolam'] = 'uploads/kolam/' . $filename;
        }

        // Simpan geometry polygon GeoJSON jika ada
        if ($request->filled('geometry')) {
            $geo = json_decode($request->geometry, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['geometry'] = $geo;
                // Auto-set centroid dari polygon jika lat/lng kosong
                if (empty($validated['latitude']) && !empty($geo['coordinates'])) {
                    $coords = $geo['coordinates'][0] ?? [];
                    if (!empty($coords)) {
                        $latSum = array_sum(array_column($coords, 1));
                        $lngSum = array_sum(array_column($coords, 0));
                        $n = count($coords);
                        $validated['latitude']  = round($latSum / $n, 8);
                        $validated['longitude'] = round($lngSum / $n, 8);
                    }
                }
            }
        }

        $kolam = Kolam::create($validated);

        // Tambahkan ikan ke kolam jika dipilih
        if ($request->filled('jenis_ikan_id')) {
            IkanKolam::create([
                'kolam_id'      => $kolam->id,
                'jenis_ikan_id' => $request->jenis_ikan_id,
                'jumlah_benih'  => $request->jumlah_benih ?? 0,
                'tanggal_tebar' => $request->tanggal_tebar,
                'status'        => 'aktif',
            ]);
        }

        return redirect()->route('kolam.index')
            ->with('success', 'Data kolam berhasil ditambahkan.');
    }

    public function show(Kolam $kolam)
    {
        $kolam->load(['pembudidaya', 'ikanKolam.jenisIkan', 'hasilPanen.jenisIkan']);
        return view('admin.kolam.show', compact('kolam'));
    }

    public function edit(Kolam $kolam)
    {
        $pembudidayaList = Pembudidaya::where('status', 'aktif')->orderBy('nama')->get();
        $jenisIkanList   = JenisIkan::where('status', 'aktif')->orderBy('nama_ikan')->get();
        $kolam->load('ikanKolam.jenisIkan');
        return view('admin.kolam.edit', compact('kolam', 'pembudidayaList', 'jenisIkanList'));
    }

    public function update(Request $request, Kolam $kolam)
    {
        $validated = $request->validate([
            'pembudidaya_id' => 'required|exists:pembudidaya,id',
            'nama_kolam'     => 'required|string|max:255',
            'jenis_kolam'    => 'required|in:terpal,beton,tanah,keramba,lainnya',
            'luas_m2'        => 'nullable|numeric|min:0',
            'kedalaman_m'    => 'nullable|numeric|min:0',
            'alamat_kolam'   => 'required|string',
            'latitude'       => 'nullable|numeric|between:-90,90',
            'longitude'      => 'nullable|numeric|between:-180,180',
            'status_kolam'   => 'required|in:aktif,tidak_aktif,perbaikan',
            'keterangan'     => 'nullable|string',
            'foto_kolam'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_kolam')) {
            // Hapus foto lama jika ada
            if ($kolam->foto_kolam && file_exists(public_path($kolam->foto_kolam))) {
                unlink(public_path($kolam->foto_kolam));
            }
            $file = $request->file('foto_kolam');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kolam'), $filename);
            $validated['foto_kolam'] = 'uploads/kolam/' . $filename;
        }

        // Simpan geometry polygon GeoJSON jika ada
        if ($request->filled('geometry')) {
            $geo = json_decode($request->geometry, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['geometry'] = $geo;
                // Auto-set centroid dari polygon jika lat/lng kosong
                if (empty($validated['latitude']) && !empty($geo['coordinates'])) {
                    $coords = $geo['coordinates'][0] ?? [];
                    if (!empty($coords)) {
                        $latSum = array_sum(array_column($coords, 1));
                        $lngSum = array_sum(array_column($coords, 0));
                        $n = count($coords);
                        $validated['latitude']  = round($latSum / $n, 8);
                        $validated['longitude'] = round($lngSum / $n, 8);
                    }
                }
            }
        } elseif ($request->has('clear_geometry')) {
            $validated['geometry'] = null;
        }

        $kolam->update($validated);

        return redirect()->route('kolam.index')
            ->with('success', 'Data kolam berhasil diperbarui.');
    }

    public function destroy(Kolam $kolam)
    {
        $kolam->delete();
        return redirect()->route('kolam.index')
            ->with('success', 'Data kolam berhasil dihapus.');
    }
}
