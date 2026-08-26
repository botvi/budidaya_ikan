@extends('template-admin.layout')
@section('title', 'Dashboard')

@section('content')
<div class="pc-content">
 <!-- Page Header -->
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item active">Dashboard</li>
 </ul>
 </div>
 <div class="col-md-12">
 <h2 class="mb-0" style="color:#14532d;font-weight:800;"> Dashboard Budidaya Ikan Air Tawar</h2>
 <p class="text-muted">Sistem Informasi Budidaya Ikan Air Tawar (SIBUDI) — Provinsi Riau</p>
 </div>
 </div>
 </div>
 </div>

 <!-- Stat Cards -->
 <div class="row g-3 mb-4">
 <div class="col-6 col-xl-3">
 <div class="card h-100" style="background:linear-gradient(135deg,#14532d,#166534);color:white;border:none;border-radius:16px;">
 <div class="card-body">
 <div class="d-flex align-items-center justify-content-between">
 <div>
 <div style="font-size:.78em;text-transform:uppercase;letter-spacing:.5px;opacity:.8;font-weight:600;">Pembudidaya Aktif</div>
 <div style="font-size:2em;font-weight:800;line-height:1.1;">{{ $totalPembudidaya }}</div>
 <div style="font-size:.75em;opacity:.7;">Orang terdaftar</div>
 </div>
 <div style="width:54px;height:54px;background:rgba(255,255,255,0.15);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.6em;"></div>
 </div>
 </div>
 </div>
 </div>
 <div class="col-6 col-xl-3">
 <div class="card h-100" style="background:linear-gradient(135deg,#1d4ed8,#2563eb);color:white;border:none;border-radius:16px;">
 <div class="card-body">
 <div class="d-flex align-items-center justify-content-between">
 <div>
 <div style="font-size:.78em;text-transform:uppercase;letter-spacing:.5px;opacity:.8;font-weight:600;">Total Kolam</div>
 <div style="font-size:2em;font-weight:800;line-height:1.1;">{{ $totalKolam }}</div>
 <div style="font-size:.75em;opacity:.7;">{{ $totalKolamAktif }} aktif</div>
 </div>
 <div style="width:54px;height:54px;background:rgba(255,255,255,0.15);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.6em;"></div>
 </div>
 </div>
 </div>
 </div>
 <div class="col-6 col-xl-3">
 <div class="card h-100" style="background:linear-gradient(135deg,#0891b2,#06b6d4);color:white;border:none;border-radius:16px;">
 <div class="card-body">
 <div class="d-flex align-items-center justify-content-between">
 <div>
 <div style="font-size:.78em;text-transform:uppercase;letter-spacing:.5px;opacity:.8;font-weight:600;">Jenis Ikan</div>
 <div style="font-size:2em;font-weight:800;line-height:1.1;">{{ $totalJenisIkan }}</div>
 <div style="font-size:.75em;opacity:.7;">Jenis dibudidayakan</div>
 </div>
 <div style="width:54px;height:54px;background:rgba(255,255,255,0.15);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.6em;"></div>
 </div>
 </div>
 </div>
 </div>
 <div class="col-6 col-xl-3">
 <div class="card h-100" style="background:linear-gradient(135deg,#b45309,#d97706);color:white;border:none;border-radius:16px;">
 <div class="card-body">
 <div class="d-flex align-items-center justify-content-between">
 <div>
 <div style="font-size:.78em;text-transform:uppercase;letter-spacing:.5px;opacity:.8;font-weight:600;">Total Panen</div>
 <div style="font-size:2em;font-weight:800;line-height:1.1;">{{ number_format($totalPanenKg, 0, ',', '.') }}</div>
 <div style="font-size:.75em;opacity:.7;">Kg hasil panen</div>
 </div>
 <div style="width:54px;height:54px;background:rgba(255,255,255,0.15);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.6em;"></div>
 </div>
 </div>
 </div>
 </div>
 </div>

 <div class="row g-4">
 <!-- Top Ikan -->
 <div class="col-md-6">
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-header" style="background:transparent;border-bottom:1px solid #f0f0f0;padding:20px 24px;">
 <h5 style="margin:0;font-weight:700;color:#1a1a2e;"> Top Jenis Ikan (Berdasarkan Panen)</h5>
 </div>
 <div class="card-body" style="padding:20px 24px;">
 @forelse($topIkan as $item)
 <div style="display:flex;align-items:center;gap:14px;margin-bottom:14px;">
 <div style="width:36px;height:36px;background:linear-gradient(135deg,#d1fae5,#a7f3d0);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1em;flex-shrink:0;"></div>
 <div style="flex:1;">
 <div style="font-weight:600;font-size:.9em;color:#1a1a2e;">{{ $item->jenisIkan->nama_ikan ?? '-' }}</div>
 <div style="font-size:.78em;color:#6b7280;">{{ number_format($item->total_kg, 0, ',', '.') }} kg • {{ $item->jumlah_panen }}x panen</div>
 </div>
 </div>
 @empty
 <p class="text-muted text-center">Belum ada data panen.</p>
 @endforelse
 </div>
 </div>
 </div>

 <!-- Recent Panen -->
 <div class="col-md-6">
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-header" style="background:transparent;border-bottom:1px solid #f0f0f0;padding:20px 24px;">
 <h5 style="margin:0;font-weight:700;color:#1a1a2e;"> Panen Terbaru</h5>
 </div>
 <div class="card-body" style="padding:20px 24px;">
 @forelse($recentPanen as $p)
 <div style="display:flex;align-items:center;gap:14px;margin-bottom:14px;padding-bottom:14px;border-bottom:1px solid #f8f8f8;">
 <div style="width:38px;height:38px;background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2em;flex-shrink:0;"></div>
 <div style="flex:1;">
 <div style="font-weight:600;font-size:.88em;color:#1a1a2e;">{{ $p->kolam->nama_kolam ?? '-' }}</div>
 <div style="font-size:.76em;color:#6b7280;">{{ $p->jenisIkan->nama_ikan ?? '-' }} • {{ $p->total_panen_kg }} kg</div>
 </div>
 <div style="font-size:.78em;color:#16a34a;font-weight:600;text-align:right;">
 {{ \Carbon\Carbon::parse($p->tanggal_panen)->format('d M Y') }}<br>
 <span style="color:#9ca3af;">{{ $p->kolam->pembudidaya->nama ?? '' }}</span>
 </div>
 </div>
 @empty
 <p class="text-muted text-center">Belum ada data panen.</p>
 @endforelse
 </div>
 </div>
 </div>
 </div>

 <!-- Quick Actions -->
 <div class="row g-3 mt-2">
 <div class="col-12">
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-body" style="padding:24px;">
 <h6 style="font-weight:700;margin-bottom:16px;color:#374151;"> Aksi Cepat</h6>
 <div style="display:flex;gap:12px;flex-wrap:wrap;">
 <a href="{{ route('pembudidaya.create') }}" style="display:flex;align-items:center;gap:8px;background:#f0fdf4;color:#15803d;padding:10px 18px;border-radius:10px;text-decoration:none;font-size:.88em;font-weight:600;border:1px solid #bbf7d0;transition:all .2s;"> Tambah Pembudidaya</a>
 <a href="{{ route('kolam.create') }}" style="display:flex;align-items:center;gap:8px;background:#eff6ff;color:#1d4ed8;padding:10px 18px;border-radius:10px;text-decoration:none;font-size:.88em;font-weight:600;border:1px solid #bfdbfe;transition:all .2s;"> Tambah Kolam</a>
 <a href="{{ route('hasil-panen.create') }}" style="display:flex;align-items:center;gap:8px;background:#fffbeb;color:#b45309;padding:10px 18px;border-radius:10px;text-decoration:none;font-size:.88em;font-weight:600;border:1px solid #fde68a;transition:all .2s;"> Input Hasil Panen</a>
 <a href="{{ route('public.peta') }}" target="_blank" style="display:flex;align-items:center;gap:8px;background:#faf5ff;color:#7c3aed;padding:10px 18px;border-radius:10px;text-decoration:none;font-size:.88em;font-weight:600;border:1px solid #e9d5ff;transition:all .2s;"> Buka Peta GIS</a>
 </div>
 </div>
 </div>
 </div>
 </div>
</div>
@endsection
