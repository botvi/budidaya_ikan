<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JenisIkan;
use Illuminate\Http\Request;

class JenisIkanController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisIkan::withCount('ikanKolam');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama_ikan', 'like', "%$s%")
                  ->orWhere('nama_latin', 'like', "%$s%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jenisIkan = $query->latest()->paginate(15)->withQueryString();

        return view('admin.jenis-ikan.index', compact('jenisIkan'));
    }

    public function create()
    {
        return view('admin.jenis-ikan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ikan'      => 'required|string|max:255',
            'nama_latin'     => 'nullable|string|max:255',
            'deskripsi'      => 'nullable|string',
            'umur_panen_hari'=> 'nullable|integer|min:1',
            'status'         => 'required|in:aktif,nonaktif',
        ]);

        JenisIkan::create($validated);

        return redirect()->route('jenis-ikan.index')
            ->with('success', 'Data jenis ikan berhasil ditambahkan.');
    }

    public function edit(JenisIkan $jenisIkan)
    {
        return view('admin.jenis-ikan.edit', compact('jenisIkan'));
    }

    public function update(Request $request, JenisIkan $jenisIkan)
    {
        $validated = $request->validate([
            'nama_ikan'      => 'required|string|max:255',
            'nama_latin'     => 'nullable|string|max:255',
            'deskripsi'      => 'nullable|string',
            'umur_panen_hari'=> 'nullable|integer|min:1',
            'status'         => 'required|in:aktif,nonaktif',
        ]);

        $jenisIkan->update($validated);

        return redirect()->route('jenis-ikan.index')
            ->with('success', 'Data jenis ikan berhasil diperbarui.');
    }

    public function destroy(JenisIkan $jenisIkan)
    {
        $jenisIkan->delete();
        return redirect()->route('jenis-ikan.index')
            ->with('success', 'Data jenis ikan berhasil dihapus.');
    }
}
