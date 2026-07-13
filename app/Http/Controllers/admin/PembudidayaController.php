<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pembudidaya;
use Illuminate\Http\Request;

class PembudidayaController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembudidaya::withCount('kolam');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama', 'like', "%$s%")
                  ->orWhere('nik', 'like', "%$s%")
                  ->orWhere('alamat', 'like', "%$s%")
                  ->orWhere('no_hp', 'like', "%$s%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pembudidaya = $query->latest()->paginate(15)->withQueryString();

        return view('admin.pembudidaya.index', compact('pembudidaya'));
    }

    public function create()
    {
        return view('admin.pembudidaya.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'           => 'required|string|max:20|unique:pembudidaya,nik',
            'nama'          => 'required|string|max:255',
            'alamat'        => 'required|string',
            'no_hp'         => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_daftar'=> 'nullable|date',
            'status'        => 'required|in:aktif,nonaktif',
            'keterangan'    => 'nullable|string',
        ]);

        Pembudidaya::create($validated);

        return redirect()->route('pembudidaya.index')
            ->with('success', 'Data pembudidaya berhasil ditambahkan.');
    }

    public function show(Pembudidaya $pembudidaya)
    {
        $pembudidaya->load(['kolam.hasilPanen', 'kolam.jenisIkan']);
        return view('admin.pembudidaya.show', compact('pembudidaya'));
    }

    public function edit(Pembudidaya $pembudidaya)
    {
        return view('admin.pembudidaya.edit', compact('pembudidaya'));
    }

    public function update(Request $request, Pembudidaya $pembudidaya)
    {
        $validated = $request->validate([
            'nik'           => 'required|string|max:20|unique:pembudidaya,nik,' . $pembudidaya->id,
            'nama'          => 'required|string|max:255',
            'alamat'        => 'required|string',
            'no_hp'         => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_daftar'=> 'nullable|date',
            'status'        => 'required|in:aktif,nonaktif',
            'keterangan'    => 'nullable|string',
        ]);

        $pembudidaya->update($validated);

        return redirect()->route('pembudidaya.index')
            ->with('success', 'Data pembudidaya berhasil diperbarui.');
    }

    public function destroy(Pembudidaya $pembudidaya)
    {
        $pembudidaya->delete();
        return redirect()->route('pembudidaya.index')
            ->with('success', 'Data pembudidaya berhasil dihapus.');
    }
}
