@extends('template-admin.layout')
@section('title', 'Laporan')

@section('content')
    <div class="pc-content">

        {{-- ===================== PRINT HEADER (hanya tampil saat cetak) ===================== --}}
        <div class="print-header" style="display:none;text-align:center;margin-bottom:20px;">
            <div
                style="display:flex;align-items:center;justify-content:center;gap:18px;border-bottom:4px double #14532d;padding-bottom:12px;margin-bottom:12px;">
                <img src="https://scontent-sin6-3.cdninstagram.com/v/t51.82787-19/758423459_18085964252649792_7877274442407450070_n.jpg?stp=dst-jpg_s150x150_tt6&_nc_cat=106&ccb=7-5&_nc_sid=f7ccc5&efg=eyJ2ZW5jb2RlX3RhZyI6InByb2ZpbGVfcGljLnd3dy4xMDgwLkMzIn0%3D&_nc_ohc=3ErEcDvfRsIQ7kNvwHbx-7z&_nc_oc=AdqkKrgnNREzncRYQuaCk15n1ytkIUlSwDYwzS_-PGQCMjeTNNnC3pj6HF1WHn6BrPY&_nc_zt=24&_nc_ht=scontent-sin6-3.cdninstagram.com&_nc_gid=3nEpFYpgO4hiO_3iX323vw&oh=00_AQFmh6gyk0e7Y7OqsF0_4KW0K5jzYIh1mIXK31idq51D5w&oe=6A94D8FA"
                    alt="Logo Dinas Perikanan" style="height:75px;width:75px;object-fit:cover;border-radius:50%;"
                    onerror="this.style.display='none'">
                <div style="text-align:center;">
                    <div
                        style="font-size:1.15em;font-weight:800;color:#14532d;letter-spacing:0.5px;text-transform:uppercase;line-height:1.2;">
                        PEMERINTAH KABUPATEN KUANTAN SINGINGI</div>
                    <div
                        style="font-size:1.35em;font-weight:900;color:#14532d;margin-top:2px;text-transform:uppercase;line-height:1.2;">
                        DINAS PERIKANAN</div>
                    <div style="font-size:.85em;color:#4b5563;font-weight:700;margin-top:3px;text-transform:uppercase;">
                        Sistem Informasi Resmi &bull; KUANTAN SINGINGI</div>
                    <div style="font-size:1em;color:#111827;font-weight:700;margin-top:3px;">Sistem Informasi Budidaya Ikan
                        Air Tawar (SIBUDI)</div>
                </div>
            </div>
            <div style="text-align:right;font-size:.78em;color:#6b7280;margin-bottom:15px;">
                Tanggal Cetak: {{ now()->translatedFormat('d F Y') }} &bull; {{ now()->format('H:i') }} WIB
            </div>
        </div>

        {{-- ===================== PAGE HEADER (layar saja) ===================== --}}
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
                        <div style="display:flex;align-items:center;gap:14px;">
                            <img src="https://scontent-sin6-3.cdninstagram.com/v/t51.82787-19/758423459_18085964252649792_7877274442407450070_n.jpg?stp=dst-jpg_s150x150_tt6&_nc_cat=106&ccb=7-5&_nc_sid=f7ccc5&efg=eyJ2ZW5jb2RlX3RhZyI6InByb2ZpbGVfcGljLnd3dy4xMDgwLkMzIn0%3D&_nc_ohc=3ErEcDvfRsIQ7kNvwHbx-7z&_nc_oc=AdqkKrgnNREzncRYQuaCk15n1ytkIUlSwDYwzS_-PGQCMjeTNNnC3pj6HF1WHn6BrPY&_nc_zt=24&_nc_ht=scontent-sin6-3.cdninstagram.com&_nc_gid=3nEpFYpgO4hiO_3iX323vw&oh=00_AQFmh6gyk0e7Y7OqsF0_4KW0K5jzYIh1mIXK31idq51D5w&oe=6A94D8FA"
                                alt="Logo Dinas Perikanan"
                                style="height:52px;width:52px;object-fit:cover;border-radius:50%;border:2px solid #14532d;box-shadow:0 2px 8px rgba(0,0,0,.15);"
                                onerror="this.style.display='none'">
                            <div>
                                <h2 class="mb-0" style="color:#14532d;font-weight:800;">Laporan Data</h2>
                                <p class="text-muted mb-0" style="font-size:.85em;">Rekap data budidaya ikan air tawar Dinas
                                    Perikanan Kuantan Singingi</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('laporan.print') }}" target="_blank" id="btn-cetak-laporan" class="btn"
                                style="background:linear-gradient(135deg,#0f766e,#0d9488);color:#fff;border:none;border-radius:10px;padding:10px 22px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                                <i class="ti ti-printer me-1"></i> Cetak / Export PDF (KOP)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== TABS NAV (layar saja) ===================== --}}
    <div class="card no-print"
        style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);margin-bottom:20px;">
        <div class="card-body p-2">
            <ul class="nav nav-pills gap-2" id="laporanTab" role="tablist" style="flex-wrap:wrap;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-kolam-btn" data-bs-toggle="tab" data-bs-target="#tab-kolam"
                        type="button" role="tab" style="border-radius:10px;font-weight:600;">
                        <i class="ti ti-droplet me-1"></i> Kolam
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-jenis-ikan-btn" data-bs-toggle="tab" data-bs-target="#tab-jenis-ikan"
                        type="button" role="tab" style="border-radius:10px;font-weight:600;">
                        <i class="ti ti-fish me-1"></i> Jenis Ikan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-hasil-panen-btn" data-bs-toggle="tab" data-bs-target="#tab-hasil-panen"
                        type="button" role="tab" style="border-radius:10px;font-weight:600;">
                        <i class="ti ti-basket me-1"></i> Hasil Panen
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-pembudidaya-btn" data-bs-toggle="tab" data-bs-target="#tab-pembudidaya"
                        type="button" role="tab" style="border-radius:10px;font-weight:600;">
                        <i class="ti ti-users me-1"></i> Pembudidaya
                    </button>
                </li>
            </ul>
        </div>
    </div>

    {{-- ===================== TAB CONTENT ===================== --}}
    <div class="tab-content" id="laporanTabContent">

        {{-- ================= TAB KOLAM ================= --}}
        <div class="tab-pane fade show active" id="tab-kolam" role="tabpanel">

            {{-- Print title --}}
            <div class="print-section-title" style="display:none;">
                <h4
                    style="font-weight:800;color:#1d4ed8;margin-bottom:12px;border-bottom:2px solid #1d4ed8;padding-bottom:8px;">
                    Laporan Data Kolam
                </h4>
            </div>

            <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
                <div class="card-header" style="background:linear-gradient(135deg,#1d4ed8,#2563eb);">
                    <h5 style="color:white;margin:0;font-weight:700;">
                        <i class="ti ti-droplet me-2"></i>Laporan Data Kolam
                        <span class="badge bg-light text-dark ms-2">{{ $kolam->count() }} kolam</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th class="ps-4" style="width:50px;">No</th>
                                    <th>Nama Kolam</th>
                                    <th>Pembudidaya</th>
                                    <th>Jenis Kolam</th>
                                    <th>Luas (m²)</th>
                                    <th>Kedalaman (m)</th>
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
                                        <td>{{ $k->jenisIkan->pluck('nama_ikan')->join(', ') ?: '-' }}</td>
                                        <td>{{ number_format($k->hasilPanen->sum('total_panen_kg'), 1) }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $k->status_kolam == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">{{ $k->status_label }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">Belum ada data kolam.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= TAB JENIS IKAN ================= --}}
        <div class="tab-pane fade" id="tab-jenis-ikan" role="tabpanel">

            {{-- Print title --}}
            <div class="print-section-title" style="display:none;">
                <h4
                    style="font-weight:800;color:#0891b2;margin-bottom:12px;border-bottom:2px solid #0891b2;padding-bottom:8px;">
                    Laporan Data Jenis Ikan
                </h4>
            </div>

            <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
                <div class="card-header" style="background:linear-gradient(135deg,#0891b2,#06b6d4);">
                    <h5 style="color:white;margin:0;font-weight:700;">
                        <i class="ti ti-fish me-2"></i>Laporan Data Jenis Ikan
                        <span class="badge bg-light text-dark ms-2">{{ $jenisIkan->count() }} jenis</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th class="ps-4" style="width:50px;">No</th>
                                    <th>Nama Ikan</th>
                                    <th>Nama Latin</th>
                                    <th>Umur Panen (hari)</th>
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
                                        <td>
                                            <span
                                                class="badge {{ $j->status == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">{{ ucfirst($j->status) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">Belum ada data jenis ikan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= TAB HASIL PANEN ================= --}}
        <div class="tab-pane fade" id="tab-hasil-panen" role="tabpanel">

            {{-- Print title --}}
            <div class="print-section-title" style="display:none;">
                <h4
                    style="font-weight:800;color:#b45309;margin-bottom:12px;border-bottom:2px solid #b45309;padding-bottom:8px;">
                    Laporan Data Hasil Panen
                </h4>
            </div>

            {{-- Filter (layar saja) --}}
            <div class="card no-print mb-3" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
                <div class="card-body p-3">
                    <form method="GET" class="row g-2 align-items-end">
                        <input type="hidden" name="tab" value="hasil-panen">
                        <div class="col-md-3">
                            <label class="form-label mb-1">Jenis Ikan</label>
                            <select name="jenis_ikan_id" class="form-select">
                                <option value="">Semua Ikan</option>
                                @foreach ($jenisIkanList as $ikan)
                                    <option value="{{ $ikan->id }}"
                                        {{ request('jenis_ikan_id') == $ikan->id ? 'selected' : '' }}>
                                        {{ $ikan->nama_ikan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label mb-1">Bulan</label>
                            <select name="bulan" class="form-select">
                                <option value="">Semua Bulan</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Tahun</label>
                            <select name="tahun" class="form-select">
                                <option value="">Semua Tahun</option>
                                @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                        {{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn"
                                style="background:#b45309;color:white;border-radius:10px;flex:1;">Filter</button>
                            <a href="{{ route('laporan.index') }}#hasil-panen" class="btn"
                                style="background:#f3f4f6;color:#374151;border-radius:10px;flex:1;">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Summary Card (layar saja) --}}
            <div class="row g-3 mb-3 no-print">
                <div class="col-md-6">
                    <div class="card h-100"
                        style="background:linear-gradient(135deg,#15803d,#16a34a);color:#fff;border:none;border-radius:14px;">
                        <div class="card-body">
                            <div style="font-size:.78em;opacity:.85;font-weight:600;">Total Panen (kg)</div>
                            <div style="font-size:1.6em;font-weight:800;">{{ number_format($totalBobotPanen, 1) }} kg
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100"
                        style="background:linear-gradient(135deg,#1d4ed8,#2563eb);color:#fff;border:none;border-radius:14px;">
                        <div class="card-body">
                            <div style="font-size:.78em;opacity:.85;font-weight:600;">Jumlah Data Panen</div>
                            <div style="font-size:1.6em;font-weight:800;">{{ $hasilPanen->count() }} data</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
                <div class="card-header" style="background:linear-gradient(135deg,#b45309,#d97706);">
                    <h5 style="color:white;margin:0;font-weight:700;">
                        <i class="ti ti-basket me-2"></i>Laporan Hasil Panen
                        <span class="badge bg-light text-dark ms-2">{{ $hasilPanen->count() }} data</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th class="ps-4" style="width:50px;">No</th>
                                    <th>Tanggal Panen</th>
                                    <th>Kolam</th>
                                    <th>Pembudidaya</th>
                                    <th>Jenis Ikan</th>
                                    <th>Total Panen (kg)</th>
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
                                        <td style="font-weight:700;color:#15803d;">
                                            {{ number_format($hp->total_panen_kg, 1) }} kg</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">Belum ada data hasil panen.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($hasilPanen->count())
                                <tfoot>
                                    <tr style="background:#fffbeb;font-weight:700;">
                                        <td colspan="5" class="ps-4 text-end">TOTAL</td>
                                        <td style="color:#15803d;">{{ number_format($totalBobotPanen, 1) }} kg</td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= TAB PEMBUDIDAYA ================= --}}
        <div class="tab-pane fade" id="tab-pembudidaya" role="tabpanel">

            {{-- Print title --}}
            <div class="print-section-title" style="display:none;">
                <h4
                    style="font-weight:800;color:#14532d;margin-bottom:12px;border-bottom:2px solid #14532d;padding-bottom:8px;">
                    Laporan Data Pembudidaya
                </h4>
            </div>

            <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
                <div class="card-header" style="background:linear-gradient(135deg,#14532d,#166534);">
                    <h5 style="color:white;margin:0;font-weight:700;">
                        <i class="ti ti-users me-2"></i>Laporan Data Pembudidaya
                        <span class="badge bg-light text-dark ms-2">{{ $pembudidaya->count() }} orang</span>
                    </h5>
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
                                            <span
                                                class="badge {{ $p->status == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">{{ ucfirst($p->status) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">Belum ada data pembudidaya.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- end tab-content --}}
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var printBtn = document.getElementById('btn-cetak-laporan');
            var basePrintUrl = "{{ route('laporan.print') }}";

            function updatePrintUrl(tabName) {
                if (printBtn) {
                    if (tabName && tabName !== 'all') {
                        printBtn.href = basePrintUrl + '?type=' + tabName;
                    } else {
                        printBtn.href = basePrintUrl;
                    }
                }
            }

            var params = new URLSearchParams(window.location.search);
            var tab = params.get('tab') || window.location.hash.replace('#', '');
            if (tab) {
                var btn = document.getElementById('tab-' + tab + '-btn');
                if (btn) {
                    new bootstrap.Tab(btn).show();
                    updatePrintUrl(tab);
                }
            }

            // Listen to tab changes
            var tabElements = document.querySelectorAll('#laporanTab button[data-bs-toggle="tab"]');
            tabElements.forEach(function(tabEl) {
                tabEl.addEventListener('shown.bs.tab', function(event) {
                    var targetId = event.target.getAttribute('data-bs-target').replace('#tab-', '');
                    updatePrintUrl(targetId);
                });
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        /* ===== Print Styles ===== */
        @media print {

            /* Sembunyikan elemen navigasi & kontrol */
            .no-print,
            .page-header,
            .pc-sidebar,
            .pc-header,
            .pc-footer,
            #tab-pembudidaya,
            #tab-pembudidaya.show {
                display: none !important;
            }

            /* Tampilkan header cetak */
            .print-header {
                display: block !important;
            }

            /* Tampilkan judul section per tabel */
            .print-section-title {
                display: block !important;
            }

            /* Tampilkan semua tab saat cetak */
            .tab-pane {
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
                page-break-inside: avoid;
                margin-bottom: 28px;
            }

            /* Reset card & shadow untuk print */
            .card {
                border: 1px solid #e5e7eb !important;
                box-shadow: none !important;
                border-radius: 6px !important;
                page-break-inside: avoid;
            }

            /* Card header warna ringan untuk print */
            .card-header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Table font kecil */
            table {
                font-size: .78em !important;
            }

            th,
            td {
                padding: 5px 8px !important;
            }

            /* Margin kertas */
            body {
                margin: 0;
            }

            .pc-content {
                padding: 10px !important;
            }

            /* Hapus background dan shadow tab nav */
            .tab-content {
                display: block !important;
            }

            /* Responsive tabel untuk print */
            .table-responsive {
                overflow: visible !important;
            }
        }
    </style>
@endsection
