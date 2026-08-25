<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $kolam->nama_kolam }} — SIBUDI Kuantan Singingi</title>
    <meta name="description" content="Detail kolam {{ $kolam->nama_kolam }} milik {{ $kolam->pembudidaya->nama ?? '' }} di Kuantan Singingi, Riau.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #0f1117; color: #e2e8f0; min-height: 100vh; }

        /* ===== HEADER (sama persis peta.blade) ===== */
        #header {
            position: sticky; top: 0; z-index: 100;
            background: linear-gradient(135deg, rgba(15,23,42,.97), rgba(20,83,45,.97));
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,.07);
            padding: 10px 20px;
            display: flex; align-items: center; gap: 14px;
            height: 56px;
        }
        .logo-wrap { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border-radius: 9px; display: flex; align-items: center; justify-content: center;
        }
        .logo-title { font-size: .82em; font-weight: 800; color: #86efac; letter-spacing: .3px; }
        .logo-sub   { font-size: .65em; color: rgba(255,255,255,.45); }
        .hdr-nav { margin-left: auto; display: flex; align-items: center; gap: 8px; }
        .hdr-btn {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 6px 14px; border-radius: 8px; text-decoration: none;
            font-size: .8em; font-weight: 500; color: #e2e8f0;
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.08);
            transition: background .2s;
        }
        .hdr-btn:hover { background: rgba(255,255,255,.14); color: #fff; }
        .hdr-btn-primary { background: linear-gradient(135deg,#16a34a,#15803d); color: white; border-color: transparent; }
        .hdr-btn-primary:hover { opacity: .9; }

        /* ===== LAYOUT ===== */
        .page-wrap { max-width: 1120px; margin: 0 auto; padding: 28px 20px 48px; }

        /* Breadcrumb */
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: .78em; color: #64748b; margin-bottom: 22px; flex-wrap: wrap; }
        .breadcrumb a { color: #22c55e; text-decoration: none; }
        .breadcrumb a:hover { color: #86efac; }
        .bc-sep { color: #334155; }

        /* ===== HERO CARD ===== */
        .hero-card {
            background: linear-gradient(135deg, #1e3a5f, #1d4ed8);
            border-radius: 18px; padding: 28px 32px; margin-bottom: 22px;
            display: flex; gap: 22px; align-items: flex-start; flex-wrap: wrap;
            border: 1px solid rgba(255,255,255,.07);
        }
        .hero-icon {
            width: 64px; height: 64px; flex-shrink: 0;
            background: rgba(255,255,255,.12); border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
        }
        .hero-title { font-size: 1.6em; font-weight: 800; color: white; margin-bottom: 4px; }
        .hero-addr  { color: rgba(255,255,255,.65); font-size: .86em; margin-bottom: 12px; }
        .badge-row  { display: flex; gap: 7px; flex-wrap: wrap; }
        .badge {
            padding: 4px 13px; border-radius: 20px; font-size: .78em; font-weight: 600;
            display: inline-flex; align-items: center; gap: 4px;
        }

        /* ===== STAT GRID ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 12px; margin-bottom: 22px;
        }
        .stat-card {
            background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);
            border-radius: 14px; padding: 16px; text-align: center;
        }
        .stat-val { font-size: 1.55em; font-weight: 800; margin-bottom: 4px; }
        .stat-lbl { font-size: .72em; color: #64748b; }

        /* ===== PETA KOLAM ===== */
        #detail-map-wrap {
            border-radius: 14px; overflow: hidden;
            border: 1px solid rgba(255,255,255,.08);
            margin-bottom: 22px;
            position: relative;
        }
        #detail-map-bar {
            background: rgba(15,23,42,.97); border-bottom: 1px solid rgba(255,255,255,.07);
            padding: 9px 16px; display: flex; align-items: center; gap: 10px;
            font-size: .78em; color: #94a3b8;
        }
        #detail-map { height: 320px; width: 100%; }

        /* Leaflet popup dark */
        .leaflet-popup-content-wrapper {
            background: #1e293b; color: #e2e8f0;
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,.4);
        }
        .leaflet-popup-tip { background: #1e293b; }
        .leaflet-popup-content { margin: 12px 14px; font-family: 'Inter'; font-size: 13px; line-height: 1.6; }
        .leaflet-popup-close-button { color: #64748b !important; }

        /* ===== INFO + IKAN GRID ===== */
        .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }
        @media (max-width: 720px) { .two-col { grid-template-columns: 1fr; } }

        .dark-card {
            background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);
            border-radius: 14px; padding: 20px;
        }
        .section-title {
            font-size: .82em; font-weight: 700; text-transform: uppercase;
            letter-spacing: .6px; color: #64748b; margin-bottom: 14px;
            display: flex; align-items: center; gap: 7px;
        }

        .info-row { display: flex; justify-content: space-between; gap: 12px;
            padding: 9px 0; border-bottom: 1px solid rgba(255,255,255,.05); font-size: .85em; }
        .info-row:last-child { border: none; }
        .info-lbl { color: #64748b; flex-shrink: 0; }
        .info-val { color: #e2e8f0; font-weight: 500; text-align: right; }

        /* Ikan list */
        .ikan-item {
            display: flex; align-items: center; gap: 12px;
            background: rgba(59,130,246,.07); border: 1px solid rgba(59,130,246,.12);
            border-radius: 10px; padding: 11px 13px; margin-bottom: 8px;
        }
        .ikan-icon {
            width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0;
            background: rgba(59,130,246,.2); display: flex; align-items: center; justify-content: center;
        }
        .ikan-name { font-weight: 600; font-size: .86em; color: #e2e8f0; }
        .ikan-meta { font-size: .74em; color: #64748b; margin-top: 2px; }

        /* ===== PANEN LIST ===== */
        .panen-item {
            display: flex; align-items: center; gap: 14px;
            background: rgba(245,158,11,.05); border: 1px solid rgba(245,158,11,.1);
            border-radius: 10px; padding: 13px 15px; margin-bottom: 9px;
        }
        .panen-icon {
            width: 36px; height: 36px; border-radius: 9px; flex-shrink: 0;
            background: rgba(245,158,11,.15); display: flex; align-items: center; justify-content: center;
        }
        .panen-name { font-weight: 600; font-size: .88em; color: #e2e8f0; }
        .panen-meta { font-size: .75em; color: #64748b; margin-top: 2px; }
        .panen-amount { text-align: right; flex-shrink: 0; }
        .panen-kg  { font-weight: 800; color: #22c55e; font-size: .95em; }
        .panen-rp  { font-size: .76em; color: #f59e0b; font-weight: 600; }

        /* ===== NEARBY ===== */
        .nearby-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px,1fr)); gap: 12px; }
        .nearby-card {
            background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);
            border-radius: 12px; padding: 14px; text-decoration: none; color: inherit;
            display: flex; flex-direction: column; gap: 6px;
            transition: border-color .2s, background .2s;
        }
        .nearby-card:hover { border-color: #22c55e; background: rgba(22,163,74,.06); }
        .nearby-name { font-weight: 600; font-size: .86em; color: #f1f5f9; }
        .nearby-owner { font-size: .74em; color: #64748b; }
        .nearby-type { font-size: .72em; color: #64748b; }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,.15); border-radius: 3px; }
    </style>
</head>
<body>

<!-- ===== HEADER (identik peta.blade) ===== -->
<div id="header">
    <a href="{{ route('landing') }}" class="logo-wrap">
        <div class="logo-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/></svg>
        </div>
        <div>
            <div class="logo-title">SIBUDI — GIS</div>
            <div class="logo-sub">Budidaya Ikan Air Tawar · Kuantan Singingi</div>
        </div>
    </a>
    <div class="hdr-nav">
        <a href="{{ route('public.peta') }}" class="hdr-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/></svg>
            Peta GIS
        </a>
        <a href="{{ route('public.cari') }}" class="hdr-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Cari
        </a>
        <a href="{{ route('login') }}" class="hdr-btn hdr-btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            Admin
        </a>
    </div>
</div>

<div class="page-wrap">

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('landing') }}">Beranda</a>
        <span class="bc-sep">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        </span>
        <a href="{{ route('public.peta') }}">Peta GIS</a>
        <span class="bc-sep">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        </span>
        <span style="color:#94a3b8;">{{ $kolam->nama_kolam }}</span>
    </div>

    <!-- Hero -->
    <div class="hero-card">
        <div class="hero-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" opacity=".85"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <div style="flex:1;">
            <div class="hero-title">{{ $kolam->nama_kolam }}</div>
            <div class="hero-addr">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                {{ $kolam->alamat_kolam }}
            </div>
            <div class="badge-row">
                @php
                    $statusCfg = [
                        'aktif'       => ['bg'=>'rgba(22,163,74,.15)',  'color'=>'#22c55e'],
                        'tidak_aktif' => ['bg'=>'rgba(239,68,68,.15)',  'color'=>'#f87171'],
                        'perbaikan'   => ['bg'=>'rgba(245,158,11,.15)', 'color'=>'#fbbf24'],
                    ][$kolam->status_kolam] ?? ['bg'=>'rgba(255,255,255,.1)', 'color'=>'#94a3b8'];
                @endphp
                <span class="badge" style="background:{{ $statusCfg['bg'] }};color:{{ $statusCfg['color'] }};">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
                    {{ $kolam->status_label }}
                </span>
                <span class="badge" style="background:rgba(255,255,255,.08);color:#94a3b8;">{{ ucfirst($kolam->jenis_kolam) }}</span>
                @if($kolam->luas_m2)
                <span class="badge" style="background:rgba(255,255,255,.08);color:#94a3b8;">{{ $kolam->luas_m2 }} m²</span>
                @endif
                @if($kolam->hasGeometry())
                <span class="badge" style="background:rgba(59,130,246,.15);color:#60a5fa;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/></svg>
                    Ada Batas Kolam
                </span>
                @endif
                @if($kolam->hasCoordinates())
                <span class="badge" style="background:rgba(16,185,129,.12);color:#34d399;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg>
                    Ada di Peta
                </span>
                @endif
            </div>
        </div>
        <a href="{{ route('public.peta') }}" class="hdr-btn" style="align-self:flex-start;">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/></svg>
            Lihat di Peta
        </a>
    </div>

    <!-- Statistik -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-val" style="color:#22c55e;">{{ number_format($kolam->hasilPanen->sum('bobot_kg'), 0, ',', '.') }}</div>
            <div class="stat-lbl">kg Total Panen</div>
        </div>
        <div class="stat-card">
            <div class="stat-val" style="color:#f59e0b;font-size:1.1em;">Rp {{ number_format($kolam->hasilPanen->sum('total_pendapatan'), 0, ',', '.') }}</div>
            <div class="stat-lbl">Total Pendapatan</div>
        </div>
        <div class="stat-card">
            <div class="stat-val" style="color:#3b82f6;">{{ $kolam->hasilPanen->count() }}</div>
            <div class="stat-lbl">Kali Panen</div>
        </div>
        <div class="stat-card">
            <div class="stat-val" style="color:#a78bfa;">{{ $kolam->ikanKolam->count() }}</div>
            <div class="stat-lbl">Jenis Ikan</div>
        </div>
    </div>

    <!-- ===== PETA DETAIL ===== -->
    @if($kolam->hasCoordinates() || $kolam->hasGeometry())
    <div id="detail-map-wrap">
        <div id="detail-map-bar">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/></svg>
            <span>Lokasi &amp; Batas Kolam</span>
            @if($kolam->hasGeometry())
            <span style="margin-left:auto;background:rgba(59,130,246,.15);color:#60a5fa;padding:2px 10px;border-radius:20px;font-size:.85em;font-weight:600;">
                Polygon tersedia
            </span>
            @elseif($kolam->hasCoordinates())
            <span style="margin-left:auto;color:#64748b;font-size:.85em;">Hanya titik koordinat</span>
            @endif
        </div>
        <div id="detail-map"></div>
    </div>
    @endif

    <!-- Info + Ikan -->
    <div class="two-col">
        <!-- Informasi Kolam -->
        <div class="dark-card">
            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Informasi Kolam
            </div>
            @if($kolam->foto_kolam)
            <div style="margin-bottom: 15px; text-align: center;">
                <img src="{{ asset($kolam->foto_kolam) }}" alt="Foto Kolam" style="max-width: 100%; border-radius: 10px;">
            </div>
            @endif
            <div class="info-row"><span class="info-lbl">Pembudidaya</span><span class="info-val">{{ $kolam->pembudidaya->nama ?? '-' }}</span></div>
            <div class="info-row"><span class="info-lbl">No. HP</span><span class="info-val">{{ $kolam->pembudidaya->no_hp ?? '-' }}</span></div>
            <div class="info-row"><span class="info-lbl">Jenis Kolam</span><span class="info-val">{{ ucfirst($kolam->jenis_kolam) }}</span></div>
            <div class="info-row"><span class="info-lbl">Luas</span><span class="info-val">{{ $kolam->luas_m2 ? $kolam->luas_m2.' m²' : '-' }}</span></div>
            <div class="info-row"><span class="info-lbl">Kedalaman</span><span class="info-val">{{ $kolam->kedalaman_m ? $kolam->kedalaman_m.' m' : '-' }}</span></div>
            <div class="info-row">
                <span class="info-lbl">Koordinat</span>
                <span class="info-val" style="font-family:monospace;font-size:.8em;">
                    @if($kolam->hasCoordinates()) {{ $kolam->latitude }}, {{ $kolam->longitude }} @else - @endif
                </span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Batas Polygon</span>
                <span class="info-val">{{ $kolam->hasGeometry() ? 'Ada' : 'Belum digambar' }}</span>
            </div>
            @if($kolam->keterangan)
            <div class="info-row"><span class="info-lbl">Keterangan</span><span class="info-val">{{ $kolam->keterangan }}</span></div>
            @endif
        </div>

        <!-- Ikan di Kolam -->
        <div class="dark-card">
            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                Ikan di Kolam Ini
            </div>
            @forelse($kolam->ikanKolam as $ik)
            <div class="ikan-item">
                <div class="ikan-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 7a6 6 0 0 1-6 11 6 6 0 0 1-6-11"/><path d="M12 22v-4"/><path d="M7.5 11.5 6 13"/><path d="M16.5 11.5 18 13"/></svg>
                </div>
                <div style="flex:1;">
                    <div class="ikan-name">{{ $ik->jenisIkan->nama_ikan ?? '-' }}</div>
                    <div class="ikan-meta">{{ number_format($ik->jumlah_benih) }} ekor &bull; Tebar: {{ $ik->tanggal_tebar?->format('d M Y') ?? '-' }}</div>
                </div>
                <span style="background:{{ $ik->status == 'aktif' ? 'rgba(22,163,74,.15)' : 'rgba(239,68,68,.15)' }};
                    color:{{ $ik->status == 'aktif' ? '#22c55e' : '#f87171' }};
                    padding:3px 10px;border-radius:20px;font-size:.73em;font-weight:600;flex-shrink:0;">
                    {{ ucfirst($ik->status) }}
                </span>
            </div>
            @empty
            <div style="text-align:center;padding:28px;color:#475569;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="display:block;margin:0 auto 10px;opacity:.4;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                Belum ada data ikan.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Hasil Panen -->
    <div class="dark-card" style="margin-bottom:20px;">
        <div class="section-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
            Riwayat Hasil Panen
        </div>
        @forelse($kolam->hasilPanen->sortByDesc('tanggal_panen') as $hp)
        <div class="panen-item">
            <div class="panen-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div style="flex:1;">
                <div class="panen-name">{{ $hp->jenisIkan->nama_ikan ?? '-' }}</div>
                <div class="panen-meta">
                    {{ $hp->tanggal_panen->format('d F Y') }}
                    &bull; {{ number_format($hp->jumlah_ekor) }} ekor
                    &bull; Rp {{ number_format($hp->harga_per_kg, 0, ',', '.') }}/kg
                </div>
            </div>
            <div class="panen-amount">
                <div class="panen-kg">{{ number_format($hp->bobot_kg, 1) }} kg</div>
                <div class="panen-rp">Rp {{ number_format($hp->total_pendapatan, 0, ',', '.') }}</div>
            </div>
        </div>
        @empty
        <div style="text-align:center;padding:32px;color:#475569;">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="display:block;margin:0 auto 12px;opacity:.35;"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
            Belum ada catatan panen.
        </div>
        @endforelse
    </div>

    <!-- Kolam Terdekat -->
    @if($nearbyKolam->isNotEmpty())
    <div class="section-title" style="margin-bottom:14px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        Kolam Terdekat
    </div>
    <div class="nearby-grid">
        @foreach($nearbyKolam as $nk)
        <a href="{{ route('public.kolam.show', $nk) }}" class="nearby-card">
            <div style="display:flex;align-items:center;gap:8px;">
                <div style="width:30px;height:30px;background:rgba(22,163,74,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div class="nearby-name">{{ $nk->nama_kolam }}</div>
            </div>
            <div class="nearby-owner">{{ $nk->pembudidaya->nama ?? '-' }}</div>
            <div class="nearby-type">{{ ucfirst($nk->jenis_kolam) }}</div>
        </a>
        @endforeach
    </div>
    @endif

</div>{{-- end page-wrap --}}

<!-- ===== LEAFLET MAP SCRIPT ===== -->
@if($kolam->hasCoordinates() || $kolam->hasGeometry())
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// =========================================================
// Inisialisasi peta detail kolam
// =========================================================
const HAS_COORDS   = {{ $kolam->hasCoordinates() ? 'true' : 'false' }};
const HAS_GEOMETRY = {{ $kolam->hasGeometry() ? 'true' : 'false' }};
const KOLAM_LAT    = {{ $kolam->latitude  ?? -0.302 }};
const KOLAM_LNG    = {{ $kolam->longitude ?? 101.468 }};
const GEOMETRY     = {!! $kolam->hasGeometry() ? json_encode($kolam->geometry) : 'null' !!};

@php
    $statusColor = match($kolam->status_kolam) {
        'aktif'       => '#22c55e',
        'tidak_aktif' => '#ef4444',
        'perbaikan'   => '#f59e0b',
        default       => '#6b7280',
    };
@endphp
const STATUS_COLOR = '{{ $statusColor }}';

const map = L.map('detail-map', { zoomControl: true });

// ============================================================
// TILE LAYERS — 5 Provider Selalu Update
// ============================================================
const G = ['0','1','2','3'];

const layerGoogleHybrid  = L.tileLayer('https://mt{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}',
    { attribution:'&copy; Google Hybrid',   subdomains:G, maxZoom:22, maxNativeZoom:21 });
const layerGoogleSatelit = L.tileLayer('https://mt{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',
    { attribution:'&copy; Google Satellite', subdomains:G, maxZoom:22, maxNativeZoom:21 });
const layerGoogleJalan   = L.tileLayer('https://mt{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
    { attribution:'&copy; Google Maps',      subdomains:G, maxZoom:22, maxNativeZoom:21 });
const layerOSM           = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    { attribution:'&copy; OpenStreetMap', subdomains:'abc', maxZoom:20, maxNativeZoom:19 });
const layerEsri          = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
    { attribution:'&copy; Esri', maxZoom:20, maxNativeZoom:18 });

layerGoogleHybrid.addTo(map);
L.control.layers({
    'Google Hybrid (Default)' : layerGoogleHybrid,
    'Google Satelit'           : layerGoogleSatelit,
    'Google Jalan'             : layerGoogleJalan,
    'OpenStreetMap'            : layerOSM,
    'Esri Satelit'             : layerEsri,
}, {}, { position: 'bottomright', collapsed: true }).addTo(map);


const boundsToFit = [];

// -- Render polygon batas kolam --
if (HAS_GEOMETRY && GEOMETRY) {
    const polyLayer = L.geoJSON({
        type: 'Feature',
        geometry: GEOMETRY,
    }, {
        style: {
            color: STATUS_COLOR,
            fillColor: STATUS_COLOR,
            fillOpacity: 0.2,
            weight: 2.5,
            dashArray: null,
        }
    }).addTo(map);

    // Fit bounds ke polygon
    map.fitBounds(polyLayer.getBounds(), { padding: [40, 40] });
    boundsToFit.push(polyLayer.getBounds());
}

// -- Render marker pin --
if (HAS_COORDS) {
    const markerIcon = L.divIcon({
        className: '',
        html: `<div style="width:30px;height:30px;background:${STATUS_COLOR};border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid rgba(255,255,255,.9);box-shadow:0 3px 12px rgba(0,0,0,.5);">
                   <div style="transform:rotate(45deg);width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                       <svg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'><rect x='3' y='11' width='18' height='11' rx='2'/><path d='M7 11V7a5 5 0 0 1 10 0v4'/></svg>
                   </div>
               </div>`,
        iconSize: [30, 30], iconAnchor: [15, 30], popupAnchor: [0, -32],
    });

    const marker = L.marker([KOLAM_LAT, KOLAM_LNG], { icon: markerIcon })
        .addTo(map)
        .bindPopup(`
            <div style="min-width:180px;">
                <div style="font-weight:700;font-size:.92em;margin-bottom:4px;color:#f1f5f9;">{{ $kolam->nama_kolam }}</div>
                <div style="font-size:.78em;color:#94a3b8;margin-bottom:6px;">{{ $kolam->alamat_kolam }}</div>
                <div style="font-size:.78em;color:#64748b;">Pembudidaya: <span style="color:#e2e8f0;font-weight:600;">{{ $kolam->pembudidaya->nama ?? '-' }}</span></div>
                <div style="font-size:.78em;color:#64748b;">Jenis: <span style="color:#e2e8f0;">{{ ucfirst($kolam->jenis_kolam) }}</span></div>
            </div>
        `);

    if (!HAS_GEOMETRY) {
        // Tidak ada polygon — zoom ke marker
        map.setView([KOLAM_LAT, KOLAM_LNG], 16);
        marker.openPopup();
    } else {
        marker.openPopup();
    }
}

// Jika tidak ada keduanya (fallback)
if (!HAS_COORDS && !HAS_GEOMETRY) {
    map.setView([-0.302, 101.468], 11);
}
</script>
@endif

</body>
</html>
