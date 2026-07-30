@extends('template-admin.layout')
@section('title', 'Laporan')

@section('content')
<div class="pc-content">
 <!-- Page Header -->
 <div class="page-header no-print">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item active">Laporan</li>
 </ul>
 </div>
 <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
 <div>
 <h2 class="mb-0" style="color:#14532d;font-weight:800;"> Laporan Data</h2>
 <p class="text-muted mb-0">Rekap seluruh data budidaya ikan air tawar</p>
 </div>
 <button type="button" onclick="window.print()" class="btn" style="background:linear-gradient(135deg,#0f766e,#0d9488);color:#fff;border:none;border-radius:10px;padding:10px 22px;font-weight:600;"> Cetak / Export PDF</button>
 </div>
 </div>
 </div>
 </div>

 <!-- Tabs Nav -->
 <div class="card no-print" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);margin-bottom:20px;">
 <div class="card-body p-2">
 <ul class="nav nav-pills gap-2" id="laporanTab" role="tablist" style="flex-wrap:wrap;">
 <li class="nav-item" role="presentation">
 <button class="nav-link active" id="tab-pembudidaya-btn" data-bs-toggle="tab" data-bs-target="#tab-pembudidaya" type="button" role="tab" style="border-radius:10px;font-weight:600;">
  Pembudidaya
 </button>
 </li>
 <li class="nav-item" role="presentation">
 <button class="nav-link" id="tab-kolam-btn" data-bs-toggle="tab" data-bs-target="#tab-kolam" type="button" role="tab" style="border-radius:10px;font-weight:600;">
  Kolam
 </button>
 </li>
 <li class="nav-item" role="presentation">
 <button class="nav-link" id="tab-jenis-ikan-btn" data-bs-toggle="tab" data-bs-target="#tab-jenis-ikan" type="button" role="tab" style="border-radius:10px;font-weight:600;">
  Jenis Ikan
 </button>
 </li>
 <li class="nav-item" role="presentation">
 <button class="nav-link" id="tab-hasil-panen-btn" data-bs-toggle="tab" data-bs-target="#tab-hasil-panen" type="button" role="tab" style="border-radius:10px;font-weight:600;">
  Hasil Panen
 </button>
 </li>
 </ul>
 </div>
 </div>

 <div class="tab-content" id="laporanTabContent">

 <!-- ================= TAB PEMBUDIDAYA ================= -->
 <div class="tab-pane fade show active" id="tab-pembudidaya" role="tabpanel">
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-header" style="background:linear-gradient(135deg,#14532d,#166534);">
 <h5><i class="ti ti-users me-2"></i>Laporan Data Pembudidaya <span class="badge bg-light text-dark ms-2">{{ $pembudidaya->count() }} orang</span></h5>
 </div>
 <div class="card-body p-0">
 <div class="table-responsive">
 <table class="table table-hover mb-0" style="font-size:.88em;">
 <thead>
 <tr>
 <th class="ps-4">No</th>
 <th>NIK</th>
 <th>Nama</th>
 <th>Alamat</th>
 <th>No HP</th>
 <th>Jenis Kelamin</th>
 <th>Tanggal Daftar</th>
 <th>Jumlah Kolam</th>
 <th>Status</th>
 </tr>
 </thead>
 <tbody>
 @forelse($pembudidaya as $i => $p)
 <tr>
 <td class="ps-4">{{ $i + 1 }}</td>
 <td>{{ $p->nik }}</td>
 <td style="font-weight:600;">{{ $p->nama }}</td>
 <td>{{ $p->alamat }}</td>
 <td>{{ $p->no_hp }}</td>
 <td>{{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
 <td>{{ $p->tanggal_daftar?->format('d M Y') }}</td>
 <td class="text-center">{{ $p->kolam_count }}</td>
 <td>
 <span class="badge {{ $p->status == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">{{ ucfirst($p->status) }}</span>
 </td>
 </tr>
 @empty
 <tr><td colspan="9" class="text-center py-5 text-muted">Belum ada data pembudidaya.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>

 <!-- ================= TAB KOLAM ================= -->
 <div class="tab-pane fade" id="tab-kolam" role="tabpanel">
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-header" style="background:linear-gradient(135deg,#1d4ed8,#2563eb);">
 <h5><i class="ti ti-droplet me-2"></i>Laporan Data Kolam <span class="badge bg-light text-dark ms-2">{{ $kolam->count() }} kolam</span></h5>
 </div>
 <div class="card-body p-0">
 <div class="table-responsive">
 <table class="table table-hover mb-0" style="font-size:.88em;">
 <thead>
 <tr>
 <th class="ps-4">No</th>
 <th>Nama Kolam</th>
 <th>Pembudidaya</th>
 <th>Jenis Kolam</th>
 <th>Luas (m²)</th>
 <th>Kedalaman (m)</th>
 <th>Alamat</th>
 <th>Jenis Ikan</th>
 <th>Total Panen (kg)</th>
 <th>Status</th>
 </tr>
 </thead>
 <tbody>
 @forelse($kolam as $i => $k)
 <tr>
 <td class="ps-4">{{ $i + 1 }}</td>
 <td style="font-weight:600;">{{ $k->nama_kolam }}</td>
 <td>{{ $k->pembudidaya->nama ?? '-' }}</td>
 <td>{{ ucfirst($k->jenis_kolam) }}</td>
 <td>{{ number_format($k->luas_m2, 1) }}</td>
 <td>{{ number_format($k->kedalaman_m, 1) }}</td>
 <td>{{ $k->alamat_kolam }}</td>
 <td>{{ $k->jenisIkan->pluck('nama_ikan')->join(', ') ?: '-' }}</td>
 <td>{{ number_format($k->hasilPanen->sum('bobot_kg'), 1) }}</td>
 <td>
 <span class="badge {{ $k->status_kolam == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">{{ $k->status_label }}</span>
 </td>
 </tr>
 @empty
 <tr><td colspan="10" class="text-center py-5 text-muted">Belum ada data kolam.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>

 <!-- ================= TAB JENIS IKAN ================= -->
 <div class="tab-pane fade" id="tab-jenis-ikan" role="tabpanel">
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-header" style="background:linear-gradient(135deg,#0891b2,#06b6d4);">
 <h5><i class="ti ti-fish me-2"></i>Laporan Data Jenis Ikan <span class="badge bg-light text-dark ms-2">{{ $jenisIkan->count() }} jenis</span></h5>
 </div>
 <div class="card-body p-0">
 <div class="table-responsive">
 <table class="table table-hover mb-0" style="font-size:.88em;">
 <thead>
 <tr>
 <th class="ps-4">No</th>
 <th>Nama Ikan</th>
 <th>Nama Latin</th>
 <th>Umur Panen (hari)</th>
 <th>Jumlah Ditebar</th>
 <th>Jumlah Dipanen</th>
 <th>Status</th>
 </tr>
 </thead>
 <tbody>
 @forelse($jenisIkan as $i => $j)
 <tr>
 <td class="ps-4">{{ $i + 1 }}</td>
 <td style="font-weight:600;">{{ $j->nama_ikan }}</td>
 <td><i>{{ $j->nama_latin }}</i></td>
 <td>{{ $j->umur_panen_hari }}</td>
 <td class="text-center">{{ $j->ikan_kolam_count }}</td>
 <td class="text-center">{{ $j->hasil_panen_count }}</td>
 <td>
 <span class="badge {{ $j->status == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">{{ ucfirst($j->status) }}</span>
 </td>
 </tr>
 @empty
 <tr><td colspan="7" class="text-center py-5 text-muted">Belum ada data jenis ikan.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>

 <!-- ================= TAB HASIL PANEN ================= -->
 <div class="tab-pane fade" id="tab-hasil-panen" role="tabpanel">

 <!-- Filter -->
 <div class="card no-print mb-3" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-body p-3">
 <form method="GET" class="row g-2 align-items-end">
 <input type="hidden" name="tab" value="hasil-panen">
 <div class="col-md-3">
 <label class="form-label mb-1">Jenis Ikan</label>
 <select name="jenis_ikan_id" class="form-select">
 <option value="">Semua Ikan</option>
 @foreach($jenisIkanList as $ikan)
 <option value="{{ $ikan->id }}" {{ request('jenis_ikan_id') == $ikan->id ? 'selected' : '' }}>{{ $ikan->nama_ikan }}</option>
 @endforeach
 </select>
 </div>
 <div class="col-md-3">
 <label class="form-label mb-1">Bulan</label>
 <select name="bulan" class="form-select">
 <option value="">Semua Bulan</option>
 @for($m=1;$m<=12;$m++)
 <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
 @endfor
 </select>
 </div>
 <div class="col-md-2">
 <label class="form-label mb-1">Tahun</label>
 <select name="tahun" class="form-select">
 <option value="">Semua Tahun</option>
 @for($y=date('Y');$y>=date('Y')-5;$y--)
 <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
 @endfor
 </select>
 </div>
 <div class="col-md-4 d-flex gap-2">
 <button type="submit" class="btn" style="background:#b45309;color:white;border-radius:10px;flex:1;">Filter</button>
 <a href="{{ route('laporan.index') }}#hasil-panen" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;flex:1;">Reset</a>
 </div>
 </form>
 </div>
 </div>

 <!-- Summary -->
 <div class="row g-3 mb-3 no-print">
 <div class="col-md-4">
 <div class="card h-100" style="background:linear-gradient(135deg,#15803d,#16a34a);color:#fff;border:none;border-radius:14px;">
 <div class="card-body">
 <div style="font-size:.78em;opacity:.85;font-weight:600;">Total Bobot Panen</div>
 <div style="font-size:1.6em;font-weight:800;">{{ number_format($totalBobotPanen, 1) }} kg</div>
 </div>
 </div>
 </div>
 <div class="col-md-4">
 <div class="card h-100" style="background:linear-gradient(135deg,#1d4ed8,#2563eb);color:#fff;border:none;border-radius:14px;">
 <div class="card-body">
 <div style="font-size:.78em;opacity:.85;font-weight:600;">Total Ekor Panen</div>
 <div style="font-size:1.6em;font-weight:800;">{{ number_format($totalEkorPanen) }} ekor</div>
 </div>
 </div>
 </div>
 <div class="col-md-4">
 <div class="card h-100" style="background:linear-gradient(135deg,#b45309,#d97706);color:#fff;border:none;border-radius:14px;">
 <div class="card-body">
 <div style="font-size:.78em;opacity:.85;font-weight:600;">Total Pendapatan</div>
 <div style="font-size:1.6em;font-weight:800;">Rp {{ number_format($totalPendapatanPanen, 0, ',', '.') }}</div>
 </div>
 </div>
 </div>
 </div>

 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-header" style="background:linear-gradient(135deg,#b45309,#d97706);">
 <h5><i class="ti ti-basket me-2"></i>Laporan Hasil Panen <span class="badge bg-light text-dark ms-2">{{ $hasilPanen->count() }} data</span></h5>
 </div>
 <div class="card-body p-0">
 <div class="table-responsive">
 <table class="table table-hover mb-0" style="font-size:.88em;">
 <thead>
 <tr>
 <th class="ps-4">No</th>
 <th>Tanggal Panen</th>
 <th>Kolam</th>
 <th>Pembudidaya</th>
 <th>Jenis Ikan</th>
 <th>Bobot (kg)</th>
 <th>Jumlah (ekor)</th>
 <th>Harga/kg</th>
 <th>Total Pendapatan</th>
 </tr>
 </thead>
 <tbody>
 @forelse($hasilPanen as $i => $hp)
 <tr>
 <td class="ps-4">{{ $i + 1 }}</td>
 <td style="font-weight:600;">{{ $hp->tanggal_panen->format('d M Y') }}</td>
 <td>{{ $hp->kolam->nama_kolam ?? '-' }}</td>
 <td>{{ $hp->kolam->pembudidaya->nama ?? '-' }}</td>
 <td>{{ $hp->jenisIkan->nama_ikan ?? '-' }}</td>
 <td style="font-weight:700;color:#15803d;">{{ number_format($hp->bobot_kg, 1) }}</td>
 <td>{{ number_format($hp->jumlah_ekor) }}</td>
 <td>Rp {{ number_format($hp->harga_per_kg, 0, ',', '.') }}</td>
 <td style="font-weight:700;color:#b45309;">Rp {{ number_format($hp->total_pendapatan, 0, ',', '.') }}</td>
 </tr>
 @empty
 <tr><td colspan="9" class="text-center py-5 text-muted">Belum ada data hasil panen.</td></tr>
 @endforelse
 </tbody>
 @if($hasilPanen->count())
 <tfoot>
 <tr style="background:#fffbeb;font-weight:700;">
 <td colspan="5" class="ps-4 text-end">TOTAL</td>
 <td style="color:#15803d;">{{ number_format($totalBobotPanen, 1) }}</td>
 <td>{{ number_format($totalEkorPanen) }}</td>
 <td></td>
 <td style="color:#b45309;">Rp {{ number_format($totalPendapatanPanen, 0, ',', '.') }}</td>
 </tr>
 </tfoot>
 @endif
 </table>
 </div>
 </div>
 </div>
 </div>

 </div>
</div>

@endsection

@section('script')
<script>
 document.addEventListener('DOMContentLoaded', function () {
 var params = new URLSearchParams(window.location.search);
 var tab = params.get('tab') || window.location.hash.replace('#', '');
 if (tab) {
 var btn = document.getElementById('tab-' + tab + '-btn');
 if (btn) {
 new bootstrap.Tab(btn).show();
 }
 }
 });
</script>
@endsection
