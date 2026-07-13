<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HasilPanen;
use App\Models\Kolam;
use App\Models\JenisIkan;
use Illuminate\Http\Request;

class HasilPanenController extends Controller
{
    public function index(Request $request)
    {
        $query = HasilPanen::with(['kolam.pembudidaya', 'jenisIkan']);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->whereHas('kolam', fn($k) => $k->where('nama_kolam', 'like', "%$s%"))
                  ->orWhereHas('jenisIkan', fn($i) => $i->where('nama_ikan', 'like', "%$s%"))
                  ->orWhereHas('kolam.pembudidaya', fn($p) => $p->where('nama', 'like', "%$s%"));
            });
        }

        if ($request->filled('jenis_ikan_id')) {
            $query->where('jenis_ikan_id', $request->jenis_ikan_id);
        }

        if ($request->filled('kolam_id')) {
            $query->where('kolam_id', $request->kolam_id);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_panen', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_panen', $request->tahun);
        }

        $hasilPanen  = $query->latest('tanggal_panen')->paginate(15)->withQueryString();
        $kolamList   = Kolam::orderBy('nama_kolam')->get();
        $jenisIkanList = JenisIkan::where('status', 'aktif')->orderBy('nama_ikan')->get();

        $totalBobot       = $query->sum('bobot_kg');
        $totalPendapatan  = $query->sum('total_pendapatan');

        return view('admin.hasil-panen.index', compact(
            'hasilPanen', 'kolamList', 'jenisIkanList', 'totalBobot', 'totalPendapatan'
        ));
    }

    public function create()
    {
        $kolamList     = Kolam::with('pembudidaya')->orderBy('nama_kolam')->get();
        $jenisIkanList = JenisIkan::where('status', 'aktif')->orderBy('nama_ikan')->get();
        return view('admin.hasil-panen.create', compact('kolamList', 'jenisIkanList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kolam_id'        => 'required|exists:kolam,id',
            'jenis_ikan_id'   => 'required|exists:jenis_ikan,id',
            'tanggal_panen'   => 'required|date',
            'bobot_kg'        => 'required|numeric|min:0',
            'jumlah_ekor'     => 'required|integer|min:0',
            'harga_per_kg'    => 'required|numeric|min:0',
            'total_pendapatan'=> 'required|numeric|min:0',
            'keterangan'      => 'nullable|string',
        ]);

        HasilPanen::create($validated);

        return redirect()->route('hasil-panen.index')
            ->with('success', 'Data hasil panen berhasil ditambahkan.');
    }

    public function show(HasilPanen $hasilPanen)
    {
        $hasilPanen->load(['kolam.pembudidaya', 'jenisIkan']);
        return view('admin.hasil-panen.show', compact('hasilPanen'));
    }

    public function edit(HasilPanen $hasilPanen)
    {
        $kolamList     = Kolam::with('pembudidaya')->orderBy('nama_kolam')->get();
        $jenisIkanList = JenisIkan::where('status', 'aktif')->orderBy('nama_ikan')->get();
        return view('admin.hasil-panen.edit', compact('hasilPanen', 'kolamList', 'jenisIkanList'));
    }

    public function update(Request $request, HasilPanen $hasilPanen)
    {
        $validated = $request->validate([
            'kolam_id'        => 'required|exists:kolam,id',
            'jenis_ikan_id'   => 'required|exists:jenis_ikan,id',
            'tanggal_panen'   => 'required|date',
            'bobot_kg'        => 'required|numeric|min:0',
            'jumlah_ekor'     => 'required|integer|min:0',
            'harga_per_kg'    => 'required|numeric|min:0',
            'total_pendapatan'=> 'required|numeric|min:0',
            'keterangan'      => 'nullable|string',
        ]);

        $hasilPanen->update($validated);

        return redirect()->route('hasil-panen.index')
            ->with('success', 'Data hasil panen berhasil diperbarui.');
    }

    public function destroy(HasilPanen $hasilPanen)
    {
        $hasilPanen->delete();
        return redirect()->route('hasil-panen.index')
            ->with('success', 'Data hasil panen berhasil dihapus.');
    }
}
