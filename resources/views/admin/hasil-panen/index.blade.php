@extends('template-admin.layout')
@section('title', 'Data Hasil Panen')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item active">Hasil Panen</li>
 </ul>
 </div>
 <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
 <h2 class="mb-0" style="color:#14532d;font-weight:800;"> Data Hasil Panen</h2>
 <a href="{{ route('hasil-panen.create') }}" class="btn" style="background:linear-gradient(135deg,#b45309,#d97706);color:white;border:none;border-radius:10px;padding:10px 22px;font-weight:600;">+ Input Panen</a>
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
 <div class="col-md-3">
 <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder=" Cari kolam, ikan, pembudidaya..." style="border-radius:10px;">
 </div>
 <div class="col-md-2">
 <select name="jenis_ikan_id" class="form-select" style="border-radius:10px;">
 <option value="">Semua Ikan</option>
 @foreach($jenisIkanList as $ikan)
 <option value="{{ $ikan->id }}" {{ request('jenis_ikan_id') == $ikan->id ? 'selected' : '' }}>{{ $ikan->nama_ikan }}</option>
 @endforeach
 </select>
 </div>
 <div class="col-md-2">
 <select name="bulan" class="form-select" style="border-radius:10px;">
 <option value="">Semua Bulan</option>
 @for($m=1;$m<=12;$m++)
 <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
 @endfor
 </select>
 </div>
 <div class="col-md-2">
 <select name="tahun" class="form-select" style="border-radius:10px;">
 <option value="">Semua Tahun</option>
 @for($y=date('Y');$y>=date('Y')-5;$y--)
 <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
 @endfor
 </select>
 </div>
 <div class="col-md-3 d-flex gap-2">
 <button type="submit" class="btn" style="background:#b45309;color:white;border-radius:10px;flex:1;">Filter</button>
 <a href="{{ route('hasil-panen.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;flex:1;">Reset</a>
 </div>
 </form>
 </div>
 </div>

 <!-- Table -->
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-body p-0">
 <div class="table-responsive">
 <table class="table table-hover mb-0" style="font-size:.88em;">
 <thead style="background:#fffbeb;">
 <tr>
 <th class="ps-4" style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">No</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Tanggal Panen</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Kolam</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Pembudidaya</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Jenis Ikan</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Bobot (kg)</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Jumlah (ekor)</th>
 <!-- <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Total Pendapatan</th> -->
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Aksi</th>
 </tr>
 </thead>
 <tbody>
 @forelse($hasilPanen as $i => $hp)
 <tr style="border-bottom:1px solid #f8f8f8;">
 <td class="ps-4" style="padding:14px 12px;color:#9ca3af;">{{ $hasilPanen->firstItem() + $i }}</td>
 <td style="padding:14px 12px;font-weight:600;color:#374151;">{{ $hp->tanggal_panen->format('d M Y') }}</td>
 <td style="padding:14px 12px;color:#374151;">{{ $hp->kolam->nama_kolam ?? '-' }}</td>
 <td style="padding:14px 12px;color:#374151;">{{ $hp->kolam->pembudidaya->nama ?? '-' }}</td>
 <td style="padding:14px 12px;">
 <span style="background:#dbeafe;color:#1d4ed8;padding:3px 10px;border-radius:20px;font-size:.82em;font-weight:600;"> {{ $hp->jenisIkan->nama_ikan ?? '-' }}</span>
 </td>
 <td style="padding:14px 12px;font-weight:700;color:#15803d;">{{ number_format($hp->bobot_kg, 1) }} kg</td>
 <td style="padding:14px 12px;color:#374151;">{{ number_format($hp->jumlah_ekor) }} ekor</td>
 <!-- <td style="padding:14px 12px;font-weight:700;color:#b45309;">Rp {{ number_format($hp->total_pendapatan, 0, ',', '.') }}</td> -->
 <td style="padding:14px 12px;">
 <div class="d-flex gap-1">
 <a href="{{ route('hasil-panen.edit', $hp) }}" class="btn btn-sm" style="background:#fef3c7;color:#b45309;border-radius:8px;padding:5px 10px;"></a>
 <form action="{{ route('hasil-panen.destroy', $hp) }}" method="POST" onsubmit="return confirm('Hapus data panen ini?')">
 @csrf @method('DELETE')
 <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:5px 10px;border:none;"></button>
 </form>
 </div>
 </td>
 </tr>
 @empty
 <tr><td colspan="9" class="text-center py-5" style="color:#9ca3af;">Belum ada data hasil panen.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 @if($hasilPanen->hasPages())
 <div class="card-footer bg-transparent border-0 p-3">{{ $hasilPanen->links() }}</div>
 @endif
 </div>
</div>
@endsection
