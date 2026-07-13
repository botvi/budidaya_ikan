@extends('template-admin.layout')
@section('title', 'Data Pembudidaya')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item active">Data Pembudidaya</li>
 </ul>
 </div>
 <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
 <h2 class="mb-0" style="color:#14532d;font-weight:800;"> Data Pembudidaya</h2>
 <a href="{{ route('pembudidaya.create') }}" class="btn" style="background:linear-gradient(135deg,#16a34a,#15803d);color:white;border:none;border-radius:10px;padding:10px 22px;font-weight:600;">+ Tambah Pembudidaya</a>
 </div>
 </div>
 </div>
 </div>

 @if(session('success'))
 <div class="alert alert-success" style="border-radius:12px;border:none;background:#f0fdf4;color:#15803d;">{{ session('success') }}</div>
 @endif

 <!-- Filter & Search -->
 <div class="card mb-4" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-body p-3">
 <form method="GET" class="row g-2 align-items-end">
 <div class="col-md-6">
 <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder=" Cari nama, NIK, alamat, nomor HP..." style="border-radius:10px;">
 </div>
 <div class="col-md-3">
 <select name="status" class="form-select" style="border-radius:10px;">
 <option value="">Semua Status</option>
 <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
 <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
 </select>
 </div>
 <div class="col-md-3 d-flex gap-2">
 <button type="submit" class="btn" style="background:#14532d;color:white;border-radius:10px;flex:1;">Filter</button>
 <a href="{{ route('pembudidaya.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;flex:1;">Reset</a>
 </div>
 </form>
 </div>
 </div>

 <!-- Table -->
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-body p-0">
 <div class="table-responsive">
 <table class="table table-hover mb-0" style="font-size:.88em;">
 <thead style="background:#f8fafc;">
 <tr>
 <th class="ps-4" style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">No</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">NIK</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Nama</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Alamat</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">No. HP</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Kolam</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Status</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Aksi</th>
 </tr>
 </thead>
 <tbody>
 @forelse($pembudidaya as $i => $p)
 <tr style="border-bottom:1px solid #f8f8f8;">
 <td class="ps-4" style="padding:14px 12px;color:#9ca3af;">{{ $pembudidaya->firstItem() + $i }}</td>
 <td style="padding:14px 12px;font-family:monospace;font-size:.85em;">{{ $p->nik }}</td>
 <td style="padding:14px 12px;">
 <div style="font-weight:600;color:#111827;">{{ $p->nama }}</div>
 <div style="font-size:.78em;color:#9ca3af;">{{ $p->jenis_kelamin == 'L' ? ' Laki-laki' : ' Perempuan' }}</div>
 </td>
 <td style="padding:14px 12px;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#374151;">{{ $p->alamat }}</td>
 <td style="padding:14px 12px;color:#374151;">{{ $p->no_hp ?? '-' }}</td>
 <td style="padding:14px 12px;">
 <span style="background:#dbeafe;color:#1d4ed8;padding:3px 10px;border-radius:20px;font-weight:600;font-size:.82em;">{{ $p->kolam_count }} kolam</span>
 </td>
 <td style="padding:14px 12px;">
 @if($p->status == 'aktif')
 <span style="background:#dcfce7;color:#15803d;padding:4px 12px;border-radius:20px;font-size:.82em;font-weight:600;"> Aktif</span>
 @else
 <span style="background:#fee2e2;color:#dc2626;padding:4px 12px;border-radius:20px;font-size:.82em;font-weight:600;"> Non-Aktif</span>
 @endif
 </td>
 <td style="padding:14px 12px;">
 <div class="d-flex gap-1">
 <a href="{{ route('pembudidaya.show', $p) }}" class="btn btn-sm" style="background:#eff6ff;color:#1d4ed8;border-radius:8px;padding:5px 12px;"></a>
 <a href="{{ route('pembudidaya.edit', $p) }}" class="btn btn-sm" style="background:#fef3c7;color:#b45309;border-radius:8px;padding:5px 12px;"></a>
 <form action="{{ route('pembudidaya.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus data {{ $p->nama }}?')">
 @csrf @method('DELETE')
 <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:5px 12px;border:none;"></button>
 </form>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="8" class="text-center py-5" style="color:#9ca3af;">Belum ada data pembudidaya.</td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 @if($pembudidaya->hasPages())
 <div class="card-footer bg-transparent border-0 p-3">
 {{ $pembudidaya->links() }}
 </div>
 @endif
 </div>
</div>
@endsection
