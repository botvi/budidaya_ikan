@extends('template-admin.layout')
@section('title', 'Data Jenis Ikan')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item active">Jenis Ikan</li>
 </ul>
 </div>
 <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
 <h2 class="mb-0" style="color:#14532d;font-weight:800;"> Data Jenis Ikan</h2>
 <a href="{{ route('jenis-ikan.create') }}" class="btn" style="background:linear-gradient(135deg,#0891b2,#06b6d4);color:white;border:none;border-radius:10px;padding:10px 22px;font-weight:600;">+ Tambah Jenis Ikan</a>
 </div>
 </div>
 </div>
 </div>

 @if(session('success'))
 <div class="alert alert-success" style="border-radius:12px;border:none;background:#f0fdf4;color:#15803d;">{{ session('success') }}</div>
 @endif

 <!-- Filter -->
 <div class="card mb-4" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-body p-3">
 <form method="GET" class="row g-2 align-items-end">
 <div class="col-md-7">
 <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder=" Cari nama ikan atau nama latin..." style="border-radius:10px;">
 </div>
 <div class="col-md-3">
 <select name="status" class="form-select" style="border-radius:10px;">
 <option value="">Semua Status</option>
 <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
 <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
 </select>
 </div>
 <div class="col-md-2 d-flex gap-2">
 <button type="submit" class="btn" style="background:#0891b2;color:white;border-radius:10px;flex:1;">Filter</button>
 <a href="{{ route('jenis-ikan.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;flex:1;">Reset</a>
 </div>
 </form>
 </div>
 </div>

 <!-- Grid cards -->
 <div class="row g-3">
 @forelse($jenisIkan as $ikan)
 <div class="col-md-4 col-lg-3">
 <div class="card h-100" style="border-radius:16px;border:none;box-shadow:0 4px 20px rgba(0,0,0,.06);transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform=''">
 <div style="background:linear-gradient(135deg,#0891b2,#06b6d4);border-radius:16px 16px 0 0;padding:28px;text-align:center;">
 <div style="font-size:3em;"></div>
 </div>
 <div class="card-body" style="padding:16px;">
 <h6 style="font-weight:700;color:#1a1a2e;margin-bottom:4px;">{{ $ikan->nama_ikan }}</h6>
 <div style="font-size:.78em;color:#6b7280;font-style:italic;margin-bottom:10px;">{{ $ikan->nama_latin ?? 'Nama latin belum ada' }}</div>
 <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:10px;">
 @if($ikan->umur_panen_hari)
 <span style="background:#f0fdf4;color:#15803d;padding:2px 10px;border-radius:20px;font-size:.75em;font-weight:600;"> {{ $ikan->umur_panen_hari }} hari</span>
 @endif
 <span style="background:#eff6ff;color:#1d4ed8;padding:2px 10px;border-radius:20px;font-size:.75em;font-weight:600;">{{ $ikan->ikan_kolam_count }} kolam</span>
 @if($ikan->status == 'aktif')
 <span style="background:#dcfce7;color:#15803d;padding:2px 10px;border-radius:20px;font-size:.75em;font-weight:600;"> Aktif</span>
 @else
 <span style="background:#fee2e2;color:#dc2626;padding:2px 10px;border-radius:20px;font-size:.75em;font-weight:600;"> Non-Aktif</span>
 @endif
 </div>
 @if($ikan->deskripsi)
 <p style="font-size:.78em;color:#6b7280;margin-bottom:12px;line-height:1.5;">{{ Str::limit($ikan->deskripsi, 80) }}</p>
 @endif
 </div>
 <div class="card-footer" style="background:transparent;border-top:1px solid #f0f0f0;padding:12px 16px;display:flex;gap:8px;">
 <a href="{{ route('jenis-ikan.edit', $ikan) }}" style="flex:1;background:#fef3c7;color:#b45309;border-radius:8px;text-align:center;padding:6px;font-size:.82em;font-weight:600;text-decoration:none;"> Edit</a>
 <form action="{{ route('jenis-ikan.destroy', $ikan) }}" method="POST" onsubmit="return confirm('Hapus {{ $ikan->nama_ikan }}?')" style="flex:1;">
 @csrf @method('DELETE')
 <button type="submit" style="width:100%;background:#fee2e2;color:#dc2626;border-radius:8px;padding:6px;font-size:.82em;font-weight:600;border:none;"> Hapus</button>
 </form>
 </div>
 </div>
 </div>
 @empty
 <div class="col-12">
 <div class="text-center py-5" style="color:#9ca3af;">
 <div style="font-size:4em;margin-bottom:16px;"></div>
 <p>Belum ada data jenis ikan.</p>
 <a href="{{ route('jenis-ikan.create') }}" class="btn" style="background:#0891b2;color:white;border-radius:10px;padding:10px 24px;">+ Tambah Jenis Ikan</a>
 </div>
 </div>
 @endforelse
 </div>

 @if($jenisIkan->hasPages())
 <div class="mt-4">{{ $jenisIkan->links() }}</div>
 @endif
</div>
@endsection
