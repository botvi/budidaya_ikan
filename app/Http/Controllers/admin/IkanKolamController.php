<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\IkanKolam;
use App\Models\Kolam;
use Illuminate\Http\Request;

class IkanKolamController extends Controller
{
    /**
     * Simpan data tebar benih/ikan ke kolam.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kolam_id'      => 'required|exists:kolam,id',
            'jenis_ikan_id' => 'required|exists:jenis_ikan,id',
            'jumlah_benih'  => 'required|integer|min:1',
            'tanggal_tebar' => 'required|date',
            'status'        => 'required|in:aktif,panen,gagal',
            'catatan'       => 'nullable|string|max:500',
        ]);

        IkanKolam::create($validated);

        return redirect()->back()->with('success', 'Data tebar ikan berhasil ditambahkan ke kolam.');
    }

    /**
     * Update data tebar ikan/status ikan di kolam.
     */
    public function update(Request $request, IkanKolam $ikanKolam)
    {
        $validated = $request->validate([
            'jenis_ikan_id' => 'required|exists:jenis_ikan,id',
            'jumlah_benih'  => 'required|integer|min:0',
            'tanggal_tebar' => 'required|date',
            'status'        => 'required|in:aktif,panen,gagal',
            'catatan'       => 'nullable|string|max:500',
        ]);

        $ikanKolam->update($validated);

        return redirect()->back()->with('success', 'Data ikan kolam berhasil diperbarui.');
    }

    /**
     * Hapus data ikan dari kolam.
     */
    public function destroy(IkanKolam $ikanKolam)
    {
        $ikanKolam->delete();

        return redirect()->back()->with('success', 'Data ikan kolam berhasil dihapus.');
    }
}
