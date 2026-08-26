@extends('template-admin.layout')
@section('title', 'Data Kolam')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item active">Data Kolam</li>
 </ul>
 </div>
 <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
 <h2 class="mb-0" style="color:#14532d;font-weight:800;"> Data Kolam</h2>
 <div class="d-flex gap-2">
 <a href="{{ route('public.peta') }}" target="_blank" class="btn" style="background:#7c3aed;color:white;border-radius:10px;padding:10px 18px;font-weight:600;"> Peta GIS</a>
 <a href="{{ route('kolam.create') }}" class="btn" style="background:linear-gradient(135deg,#1d4ed8,#2563eb);color:white;border:none;border-radius:10px;padding:10px 22px;font-weight:600;">+ Tambah Kolam</a>
 </div>
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
 <div class="col-md-4">
 <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder=" Cari nama kolam, alamat, pembudidaya..." style="border-radius:10px;">
 </div>
 <div class="col-md-2">
 <select name="jenis_kolam" class="form-select" style="border-radius:10px;">
 <option value="">Semua Jenis</option>
 @foreach(['terpal','beton','tanah','keramba','lainnya'] as $jk)
 <option value="{{ $jk }}" {{ request('jenis_kolam') == $jk ? 'selected' : '' }}>{{ ucfirst($jk) }}</option>
 @endforeach
 </select>
 </div>
 <div class="col-md-2">
 <select name="status_kolam" class="form-select" style="border-radius:10px;">
 <option value="">Semua Status</option>
 <option value="aktif" {{ request('status_kolam') == 'aktif' ? 'selected' : '' }}>Aktif</option>
 <option value="tidak_aktif" {{ request('status_kolam') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
 <option value="perbaikan" {{ request('status_kolam') == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
 </select>
 </div>
 <div class="col-md-2">
 <select name="pembudidaya_id" class="form-select" style="border-radius:10px;">
 <option value="">Semua Pembudidaya</option>
 @foreach($pembudidayaList as $pb)
 <option value="{{ $pb->id }}" {{ request('pembudidaya_id') == $pb->id ? 'selected' : '' }}>{{ $pb->nama }}</option>
 @endforeach
 </select>
 </div>
 <div class="col-md-2 d-flex gap-2">
 <button type="submit" class="btn" style="background:#1d4ed8;color:white;border-radius:10px;flex:1;">Filter</button>
 <a href="{{ route('kolam.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;flex:1;">Reset</a>
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
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Nama Kolam</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Pembudidaya</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Jenis</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Luas</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Ikan</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Koordinat</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Status</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Aksi</th>
 </tr>
 </thead>
 <tbody>
 @forelse($kolam as $i => $k)
 <tr style="border-bottom:1px solid #f8f8f8;">
 <td class="ps-4" style="padding:14px 12px;color:#9ca3af;">{{ $kolam->firstItem() + $i }}</td>
 <td style="padding:14px 12px;">
 <div style="font-weight:600;color:#111827;">{{ $k->nama_kolam }}</div>
 <div style="font-size:.76em;color:#9ca3af;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:160px;">{{ $k->alamat_kolam }}</div>
 </td>
 <td style="padding:14px 12px;color:#374151;">{{ $k->pembudidaya->nama ?? '-' }}</td>
 <td style="padding:14px 12px;">
 <span style="background:#f1f5f9;color:#475569;padding:3px 10px;border-radius:20px;font-size:.8em;font-weight:600;">{{ ucfirst($k->jenis_kolam) }}</span>
 </td>
 <td style="padding:14px 12px;color:#374151;">{{ $k->luas_m2 ? $k->luas_m2.' m²' : '-' }}</td>
 <td style="padding:14px 12px;">
 @if($k->ikanKolam->count() > 0)
 <div class="d-flex flex-wrap gap-1">
 @foreach($k->ikanKolam as $ik)
 @php
 $ikBg = $ik->status == 'aktif' ? '#dcfce7' : ($ik->status == 'panen' ? '#dbeafe' : '#fee2e2');
 $ikTx = $ik->status == 'aktif' ? '#15803d' : ($ik->status == 'panen' ? '#1d4ed8' : '#dc2626');
 @endphp
 <span style="background:{{ $ikBg }};color:{{ $ikTx }};padding:2px 8px;border-radius:12px;font-size:.76em;font-weight:600;" title="{{ number_format($ik->jumlah_benih) }} ekor &bull; Status: {{ ucfirst($ik->status) }}">
 🐟 {{ $ik->jenisIkan->nama_ikan ?? '-' }}
 <span style="font-size:.9em;opacity:.85;">({{ ucfirst($ik->status) }})</span>
 </span>
 @endforeach
 </div>
 @else
 <span style="color:#9ca3af;font-size:.82em;">-</span>
 @endif
 </td>
 <td style="padding:14px 12px;">
 @if($k->hasCoordinates())
 <span style="background:#f0fdf4;color:#15803d;padding:3px 10px;border-radius:20px;font-size:.76em;font-weight:600;">📍 {{ number_format($k->latitude, 4) }}, {{ number_format($k->longitude, 4) }}</span>
 @else
 <span style="background:#fef2f2;color:#dc2626;padding:3px 10px;border-radius:20px;font-size:.76em;">⚠️ Belum ada</span>
 @endif
 </td>
 <td style="padding:14px 12px;">
 @php $statusColor = $k->status_kolam == 'aktif' ? '#dcfce7:#15803d' : ($k->status_kolam == 'perbaikan' ? '#fef3c7:#b45309' : '#fee2e2:#dc2626');
 [$bg, $tx] = explode(':', $statusColor); @endphp
 <span style="background:{{ $bg }};color:{{ $tx }};padding:4px 12px;border-radius:20px;font-size:.82em;font-weight:600;">{{ $k->status_label }}</span>
 </td>
 <td style="padding:14px 12px;">
 <div class="d-flex gap-1">
 <a href="{{ route('kolam.show', $k) }}" class="btn btn-sm" style="background:#eff6ff;color:#1d4ed8;border-radius:8px;padding:5px 10px;" title="Lihat Detail & Kelola Ikan">
 👁️
 </a>
 <a href="{{ route('kolam.edit', $k) }}" class="btn btn-sm" style="background:#fef3c7;color:#b45309;border-radius:8px;padding:5px 10px;" title="Edit Kolam">
 ✏️
 </a>
 <form action="{{ route('kolam.destroy', $k) }}" method="POST" onsubmit="return confirm('Hapus kolam {{ $k->nama_kolam }}?')">
 @csrf @method('DELETE')
 <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:5px 10px;border:none;" title="Hapus Kolam">
 🗑️
 </button>
 </form>
 </div>
 </td>
 </tr>
 @empty
 <tr><td colspan="9" class="text-center py-5" style="color:#9ca3af;">Belum ada data kolam.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 @if($kolam->hasPages())
 <div class="card-footer bg-transparent border-0 p-3">{{ $kolam->links() }}</div>
 @endif
 </div>
</div>
@endsection
