<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan — SIBUDI Dinas Perikanan Kuantan Singingi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Tinos:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            line-height: 1.5;
            font-size: 12px;
        }

        /* ===== TOOLBAR (Layar saja, disembunyikan saat cetak) ===== */
        .no-print-toolbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .toolbar-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 15px;
            color: #0f172a;
        }

        .toolbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .btn-print {
            background: linear-gradient(135deg, #15803d, #16a34a);
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(22, 163, 74, 0.3);
        }

        .btn-print:hover {
            background: linear-gradient(135deg, #166534, #15803d);
        }

        .btn-back {
            background: #f8fafc;
            color: #475569;
            border-color: #cbd5e1;
        }

        .btn-back:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .filter-select {
            padding: 7px 12px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 13px;
            font-weight: 500;
            color: #334155;
            outline: none;
            background: #ffffff;
        }

        /* ===== CONTAINER KERTAS CETAK ===== */
        .print-container {
            max-width: 900px;
            margin: 24px auto;
            background: #ffffff;
            padding: 36px 44px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
        }

        /* ===== KOP SURAT RESMI ===== */
        .kop-surat {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            border-bottom: 3px double #0f172a;
            padding-bottom: 14px;
            margin-bottom: 20px;
            position: relative;
        }

        .kop-logo {
            width: 85px;
            height: 85px;
            object-fit: cover;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .kop-logo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #14532d;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            flex-shrink: 0;
        }

        .kop-text {
            text-align: center;
            flex: 1;
        }

        .kop-instansi {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.8px;
            color: #0f172a;
            text-transform: uppercase;
        }

        .kop-dinas {
            font-size: 19px;
            font-weight: 900;
            letter-spacing: 1px;
            color: #14532d;
            text-transform: uppercase;
            margin-top: 1px;
            line-height: 1.2;
        }

        .kop-sub {
            font-size: 11.5px;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            margin-top: 2px;
            letter-spacing: 0.5px;
        }

        .kop-aplikasi {
            font-size: 12.5px;
            font-weight: 700;
            color: #1e293b;
            margin-top: 2px;
        }

        .kop-alamat {
            font-size: 10.5px;
            color: #64748b;
            margin-top: 2px;
            font-style: italic;
        }

        /* ===== JUDUL LAPORAN ===== */
        .report-header {
            text-align: center;
            margin-bottom: 22px;
        }

        .report-title {
            font-size: 15px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        .report-meta {
            font-size: 11px;
            color: #64748b;
            margin-top: 6px;
        }

        /* ===== SECTION TITLE ===== */
        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: #14532d;
            border-left: 4px solid #14532d;
            padding-left: 8px;
            margin: 24px 0 10px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        /* ===== TABEL CETAK RESMI ===== */
        .table-cetak {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11px;
        }

        .table-cetak th {
            background-color: #f1f5f9;
            color: #0f172a;
            font-weight: 700;
            text-align: left;
            padding: 7px 9px;
            border: 1px solid #94a3b8;
            text-transform: uppercase;
            font-size: 10.5px;
        }

        .table-cetak td {
            padding: 6px 9px;
            border: 1px solid #cbd5e1;
            color: #1e293b;
            vertical-align: middle;
        }

        .table-cetak tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        .table-cetak tfoot td {
            background-color: #f1f5f9;
            font-weight: 700;
            border-top: 2px solid #64748b;
            border-bottom: 2px solid #64748b;
        }

        .text-center {
            text-align: center !important;
        }

        .text-end {
            text-align: right !important;
        }

        .text-muted {
            color: #64748b;
        }

        .fw-bold {
            font-weight: 700;
        }

        .badge-status {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-aktif {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #86efac;
        }

        .badge-nonaktif {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
        }

        /* ===== TANDA TANGAN ===== */
        .signature-section {
            margin-top: 36px;
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
            font-size: 11.5px;
        }

        .signature-box {
            width: 250px;
            text-align: center;
        }

        .signature-space {
            height: 65px;
        }

        .signature-name {
            font-weight: 700;
            text-decoration: underline;
            color: #0f172a;
        }

        .signature-nip {
            font-size: 10.5px;
            color: #475569;
            margin-top: 2px;
        }

        /* ===== PRINT MEDIA STYLES ===== */
        @media print {
            @page {
                size: A4 portrait;
                margin: 12mm 12mm 15mm 12mm;
            }

            body {
                background: #ffffff !important;
                color: #000000 !important;
                font-size: 10.5pt;
            }

            .no-print-toolbar {
                display: none !important;
            }

            .print-container {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }

            .kop-surat {
                border-bottom: 2.5pt double #000 !important;
            }

            .kop-dinas {
                color: #000 !important;
            }

            .section-title {
                color: #000 !important;
                border-left-color: #000 !important;
                page-break-after: avoid;
            }

            .table-cetak th {
                background-color: #e2e8f0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color: #000 !important;
                border-color: #000 !important;
            }

            .table-cetak td {
                border-color: #64748b !important;
                color: #000 !important;
            }

            .table-cetak tfoot td {
                background-color: #e2e8f0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                border-color: #000 !important;
            }

            .badge-status {
                border: 1px solid #94a3b8 !important;
                background: transparent !important;
                color: #000 !important;
            }

            .signature-section {
                page-break-inside: avoid;
            }

            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>

    <!-- ===== TOOLBAR (Disembunyikan saat cetak) ===== -->
    <div class="no-print-toolbar">
        <div class="toolbar-title">
            <i class="ti ti-printer" style="font-size:20px;color:#16a34a;"></i>
            <span>Pratinjau Cetak Laporan Resmi</span>
        </div>

        <div class="toolbar-actions">
            <!-- Filter Tipe Laporan -->
            <form method="GET" action="{{ route('laporan.print') }}"
                style="display:inline-flex;align-items:center;gap:6px;">
                <label for="type-select" style="font-size:12px;font-weight:600;color:#475569;">Pilih Laporan:</label>
                <select name="type" id="type-select" class="filter-select" onchange="this.form.submit()">
                    <option value="all" {{ ($type ?? 'all') == 'all' ? 'selected' : '' }}>Semua Laporan (Lengkap)
                    </option>
                    <option value="kolam" {{ ($type ?? '') == 'kolam' ? 'selected' : '' }}>Laporan Data Kolam</option>
                    <option value="jenis-ikan" {{ ($type ?? '') == 'jenis-ikan' ? 'selected' : '' }}>Laporan Data Jenis
                        Ikan</option>
                    <option value="hasil-panen" {{ ($type ?? '') == 'hasil-panen' ? 'selected' : '' }}>Laporan Data
                        Hasil Panen</option>
                    <option value="pembudidaya" {{ ($type ?? '') == 'pembudidaya' ? 'selected' : '' }}>Laporan Data
                        Pembudidaya</option>
                </select>
                @if (request('jenis_ikan_id'))
                    <input type="hidden" name="jenis_ikan_id" value="{{ request('jenis_ikan_id') }}">
                @endif
                @if (request('bulan'))
                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                @endif
                @if (request('tahun'))
                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                @endif
            </form>

            <button type="button" onclick="window.print()" class="btn-action btn-print">
                <i class="ti ti-printer"></i> Cetak / Simpan PDF
            </button>

            <a href="{{ route('laporan.index') }}" class="btn-action btn-back">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- ===== AREA DOKUMEN CETAK ===== -->
    <div class="print-container">

        <!-- KOP SURAT RESMI -->
        <div class="kop-surat">
            <img src="https://scontent-sin6-3.cdninstagram.com/v/t51.82787-19/758423459_18085964252649792_7877274442407450070_n.jpg?stp=dst-jpg_s150x150_tt6&_nc_cat=106&ccb=7-5&_nc_sid=f7ccc5&efg=eyJ2ZW5jb2RlX3RhZyI6InByb2ZpbGVfcGljLnd3dy4xMDgwLkMzIn0%3D&_nc_ohc=3ErEcDvfRsIQ7kNvwHbx-7z&_nc_oc=AdqkKrgnNREzncRYQuaCk15n1ytkIUlSwDYwzS_-PGQCMjeTNNnC3pj6HF1WHn6BrPY&_nc_zt=24&_nc_ht=scontent-sin6-3.cdninstagram.com&_nc_gid=95P4GdeLaNUsqcgU4IocFQ&_nc_ss=7ba8c&oh=00_AQGWI1Z7CjCu9ySeGy3PKXMZVAqLhWRqRyFJ5Ywb0SsgpQ&oe=6A94D8FA"
                alt="Logo Dinas Perikanan" class="kop-logo"
                onerror="this.style.display='none'; document.getElementById('kop-fallback-logo').style.display='flex';">

            <div id="kop-fallback-logo" class="kop-logo-placeholder" style="display:none;">
                <i class="ti ti-fish"></i>
            </div>

            <div class="kop-text">
                <div class="kop-instansi">PEMERINTAH KABUPATEN KUANTAN SINGINGI</div>
                <div class="kop-dinas">DINAS PERIKANAN</div>
                <div class="kop-sub">Sistem Informasi Resmi &bull; KUANTAN SINGINGI</div>
                <div class="kop-aplikasi">Sistem Informasi Budidaya Ikan Air Tawar (SIBUDI)</div>
                <div class="kop-alamat">Kabupaten Kuantan Singingi, Provinsi Riau &bull; Email: diskan@kuansing.go.id
                </div>
            </div>
        </div>

        <!-- JUDUL LAPORAN -->
        <div class="report-header">
            <div class="report-title">
                @if ($type == 'kolam')
                    LAPORAN DATA KOLAM BUDIDAYA
                @elseif($type == 'jenis-ikan')
                    LAPORAN DATA JENIS IKAN BUDIDAYA
                @elseif($type == 'hasil-panen')
                    LAPORAN DATA HASIL PANEN IKAN
                @elseif($type == 'pembudidaya')
                    LAPORAN DATA PEMBUDIDAYA IKAN
                @else
                    REKAPITULASI LAPORAN DATA BUDIDAYA IKAN AIR TAWAR
                @endif
            </div>
            <div class="report-meta">
                Tanggal Cetak: {{ now()->translatedFormat('d F Y') }} &bull; Pukul {{ now()->format('H:i') }} WIB
            </div>
        </div>

        {{-- ========================================================================= --}}
        {{-- 1. TABEL DATA KOLAM (Hapus Alamat) --}}
        {{-- ========================================================================= --}}
        @if ($type == 'all' || $type == 'kolam')
            <div class="section-title">I. Laporan Data Kolam</div>
            <table class="table-cetak">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 35px;">No</th>
                        <th>Nama Kolam</th>
                        <th>Pembudidaya</th>
                        <th>Jenis Kolam</th>
                        <th class="text-end">Luas (m²)</th>
                        <th class="text-end">Kedalaman (m)</th>
                        <th>Jenis Ikan</th>
                        <th class="text-end">Total Panen (kg)</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kolam as $i => $k)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="fw-bold">{{ $k->nama_kolam }}</td>
                            <td>{{ $k->pembudidaya->nama ?? '-' }}</td>
                            <td>{{ ucfirst($k->jenis_kolam) }}</td>
                            <td class="text-end">{{ number_format($k->luas_m2, 1) }}</td>
                            <td class="text-end">{{ number_format($k->kedalaman_m, 1) }}</td>
                            <td>{{ $k->jenisIkan->pluck('nama_ikan')->join(', ') ?: '-' }}</td>
                            <td class="text-end fw-bold">{{ number_format($k->hasilPanen->sum('total_panen_kg'), 1) }}
                            </td>
                            <td class="text-center">
                                <span
                                    class="badge-status {{ $k->status_kolam == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                                    {{ $k->status_label }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Belum ada data kolam.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif

        {{-- ========================================================================= --}}
        {{-- 2. TABEL DATA JENIS IKAN (Hapus Jumlah di Tebar dan Jumlah di Panen) --}}
        {{-- ========================================================================= --}}
        @if ($type == 'all' || $type == 'jenis-ikan')
            <div class="section-title">
                {{ $type == 'all' ? 'II. Laporan Data Jenis Ikan' : 'Laporan Data Jenis Ikan' }}
            </div>
            <table class="table-cetak">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 35px;">No</th>
                        <th>Nama Ikan</th>
                        <th>Nama Latin</th>
                        <th class="text-center">Umur Panen (Hari)</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisIkan as $i => $j)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="fw-bold">{{ $j->nama_ikan }}</td>
                            <td><i>{{ $j->nama_latin }}</i></td>
                            <td class="text-center">{{ $j->umur_panen_hari }}</td>
                            <td class="text-center">
                                <span
                                    class="badge-status {{ $j->status == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                                    {{ ucfirst($j->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data jenis ikan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif

        {{-- ========================================================================= --}}
        {{-- 3. TABEL DATA HASIL PANEN (Hapus Bobot, Harga, Total Pendapatan; Total Panen kg) --}}
        {{-- ========================================================================= --}}
        @if ($type == 'all' || $type == 'hasil-panen')
            <div class="section-title">
                {{ $type == 'all' ? 'III. Laporan Data Hasil Panen' : 'Laporan Data Hasil Panen' }}
            </div>
            <table class="table-cetak">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 35px;">No</th>
                        <th>Tanggal Panen</th>
                        <th>Nama Kolam</th>
                        <th>Pembudidaya</th>
                        <th>Jenis Ikan</th>
                        <th class="text-end">Total Panen (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hasilPanen as $i => $hp)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $hp->tanggal_panen->translatedFormat('d F Y') }}</td>
                            <td class="fw-bold">{{ $hp->kolam->nama_kolam ?? '-' }}</td>
                            <td>{{ $hp->kolam->pembudidaya->nama ?? '-' }}</td>
                            <td>{{ $hp->jenisIkan->nama_ikan ?? '-' }}</td>
                            <td class="text-end fw-bold" style="color:#15803d;">
                                {{ number_format($hp->total_panen_kg, 1) }} kg
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data hasil panen.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if ($hasilPanen->count() > 0)
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end fw-bold">TOTAL KESELURUHAN PANEN:</td>
                            <td class="text-end fw-bold" style="color:#15803d;">
                                {{ number_format($totalBobotPanen, 1) }} kg
                            </td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        @endif

        {{-- ========================================================================= --}}
        {{-- 4. TABEL DATA PEMBUDIDAYA --}}
        {{-- ========================================================================= --}}
        @if ($type == 'all' || $type == 'pembudidaya')
            <div class="section-title">
                {{ $type == 'all' ? 'IV. Laporan Data Pembudidaya' : 'Laporan Data Pembudidaya' }}
            </div>
            <table class="table-cetak">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 35px;">No</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th class="text-center">L/P</th>
                        <th class="text-center">Jml Kolam</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembudidaya as $i => $p)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $p->nik }}</td>
                            <td class="fw-bold">{{ $p->nama }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td class="text-center">{{ $p->jenis_kelamin }}</td>
                            <td class="text-center">{{ $p->kolam_count }}</td>
                            <td class="text-center">
                                <span
                                    class="badge-status {{ $p->status == 'aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data pembudidaya.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif

        <!-- ===== TANDA TANGAN RESMI ===== -->
        <div class="signature-section">
            <div class="signature-box">
                <div>Mengetahui,</div>
                <div>Petugas Pengelola Data</div>
                <div class="signature-space"></div>
                <div class="signature-name">ADMIN SIBUDI</div>
                <div class="signature-nip">Dinas Perikanan Kab. Kuansing</div>
            </div>

            <div class="signature-box">
                <div>Teluk Kuantan, {{ now()->translatedFormat('d F Y') }}</div>
                <div>Kepala Dinas Perikanan</div>
                <div class="signature-space"></div>
                <div class="signature-name">KEPALA DINAS PERIKANAN</div>
                <div class="signature-nip">NIP. ........................................</div>
            </div>
        </div>

    </div>

</body>

</html>
