@extends('template-admin.layout')
@section('title', 'Detail Pembudidaya')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item"><a href="{{ route('pembudidaya.index') }}">Pembudidaya</a></li>
 <li class="breadcrumb-item active">Detail</li>
 </ul>
 </div>
 <div class="col-md-12 d-flex align-items-center justify-content-between gap-2 flex-wrap">
 <h2 class="mb-0" style="color:#14532d;font-weight:800;"> Detail Pembudidaya</h2>
 <div class="d-flex gap-2">
 <a href="{{ route('pembudidaya.edit', $pembudidaya) }}" class="btn" style="background:#fef3c7;color:#b45309;border-radius:10px;padding:8px 20px;font-weight:600;"> Edit</a>
 <a href="{{ route('pembudidaya.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;padding:8px 20px;">← Kembali</a>
 </div>
 </div>
 </div>
 </div>
 </div>

 <div class="row g-4">
 <!-- Info Card -->
 <div class="col-md-5">
 <div class="card" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:linear-gradient(135deg,#14532d,#166534);border-radius:20px 20px 0 0;padding:24px;text-align:center;">
 <div style="width:72px;height:72px;background:rgba(255,255,255,.15);border-radius:20px;display:flex;align-items:center;justify-content:center;font-size:2.2em;margin:0 auto 12px;">{{ $pembudidaya->jenis_kelamin == 'L' ? '' : '' }}</div>
 <h4 style="color:white;margin:0;font-weight:800;">{{ $pembudidaya->nama }}</h4>
 <div style="color:rgba(255,255,255,.7);font-size:.85em;">NIK: {{ $pembudidaya->nik }}</div>
 </div>
 <div class="card-body p-4">
 <table style="width:100%;font-size:.88em;">
 <tr><td style="color:#9ca3af;padding:6px 0;width:40%;">Alamat</td><td style="font-weight:500;color:#374151;">{{ $pembudidaya->alamat }}</td></tr>
 <tr><td style="color:#9ca3af;padding:6px 0;">No. HP</td><td style="font-weight:500;color:#374151;">{{ $pembudidaya->no_hp ?? '-' }}</td></tr>
 <tr><td style="color:#9ca3af;padding:6px 0;">Email</td><td style="font-weight:500;color:#374151;">{{ $pembudidaya->email ?? '-' }}</td></tr>
 <tr><td style="color:#9ca3af;padding:6px 0;">Tgl Daftar</td><td style="font-weight:500;color:#374151;">{{ $pembudidaya->tanggal_daftar?->format('d M Y') ?? '-' }}</td></tr>
 <tr><td style="color:#9ca3af;padding:6px 0;">Status</td><td>
 @if($pembudidaya->status == 'aktif')
 <span style="background:#dcfce7;color:#15803d;padding:3px 12px;border-radius:20px;font-size:.82em;font-weight:600;"> Aktif</span>
 @else
 <span style="background:#fee2e2;color:#dc2626;padding:3px 12px;border-radius:20px;font-size:.82em;font-weight:600;"> Non-Aktif</span>
 @endif
 </td></tr>
 @if($pembudidaya->keterangan)
 <tr><td style="color:#9ca3af;padding:6px 0;">Keterangan</td><td style="font-weight:500;color:#374151;">{{ $pembudidaya->keterangan }}</td></tr>
 @endif
 </table>
 </div>
 </div>
 </div>

 <!-- Kolam List -->
 <div class="col-md-7">
 <div class="card" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:transparent;border-bottom:1px solid #f0f0f0;padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
 <h5 style="margin:0;font-weight:700;color:#1a1a2e;"> Daftar Kolam ({{ $pembudidaya->kolam->count() }})</h5>
 <a href="{{ route('kolam.create') }}" style="background:#eff6ff;color:#1d4ed8;padding:6px 16px;border-radius:8px;font-size:.82em;font-weight:600;text-decoration:none;">+ Kolam Baru</a>
 </div>
 <div class="card-body p-3">
 @forelse($pembudidaya->kolam as $k)
 <div style="background:#f9fafb;border-radius:12px;padding:14px;margin-bottom:10px;display:flex;gap:12px;align-items:center;">
 <div style="width:40px;height:40px;background:{{ $k->status_kolam == 'aktif' ? '#d1fae5' : ($k->status_kolam == 'perbaikan' ? '#fef3c7' : '#fee2e2') }};border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2em;flex-shrink:0;"></div>
 <div style="flex:1;">
 <div style="font-weight:600;color:#1a1a2e;">{{ $k->nama_kolam }}</div>
 <div style="font-size:.78em;color:#6b7280;">{{ ucfirst($k->jenis_kolam) }} • {{ $k->luas_m2 }} m² • {{ $k->jenisIkan->pluck('nama_ikan')->join(', ') ?: 'Belum ada ikan' }}</div>
 </div>
 <div>
 <span style="background:{{ $k->status_kolam == 'aktif' ? '#dcfce7' : ($k->status_kolam == 'perbaikan' ? '#fef3c7' : '#fee2e2') }};color:{{ $k->status_kolam == 'aktif' ? '#15803d' : ($k->status_kolam == 'perbaikan' ? '#b45309' : '#dc2626') }};padding:3px 10px;border-radius:20px;font-size:.78em;font-weight:600;">{{ $k->status_label }}</span>
 </div>
 <a href="{{ route('kolam.show', $k) }}" style="color:#6b7280;font-size:1.2em;text-decoration:none;">→</a>
 </div>
 @empty
 <div class="text-center py-4" style="color:#9ca3af;">Belum ada kolam terdaftar.</div>
 @endforelse
 </div>
 </div>
 </div>
 </div>
</div>
@endsection
