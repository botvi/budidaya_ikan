<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peta GIS Kolam — SIBUDI Kuantan Singingi</title>
    <meta name="description" content="Peta interaktif sebaran kolam budidaya ikan air tawar di Kuantan Singingi, Riau.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css"/>

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #0f1117; color: #e2e8f0; height: 100vh; overflow: hidden; }

        /* ===== HEADER ===== */
        #header {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            background: linear-gradient(135deg, rgba(15,23,42,.97), rgba(20,83,45,.97));
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,.07);
            padding: 10px 18px;
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
            cursor: pointer; font-family: 'Inter';
            transition: background .2s;
        }
        .hdr-btn:hover { background: rgba(255,255,255,.14); color: #fff; }
        .hdr-btn-primary {
            background: linear-gradient(135deg,#16a34a,#15803d); color: white;
            border-color: transparent;
        }
        .hdr-btn-primary:hover { opacity: .9; }

        /* ===== FILTER PANEL (kiri) ===== */
        #filter-panel {
            position: fixed; top: 66px; left: 10px; z-index: 900; width: 290px;
            background: rgba(15,23,42,.97); backdrop-filter: blur(16px);
            border-radius: 14px; border: 1px solid rgba(255,255,255,.08);
            padding: 14px; max-height: calc(100vh - 82px); overflow-y: auto;
        }
        .fp-section { font-size: .72em; font-weight: 700; text-transform: uppercase;
            letter-spacing: .6px; color: #64748b; margin: 12px 0 8px; }
        .fp-section:first-child { margin-top: 0; }

        .stat-card {
            background: rgba(255,255,255,.05); border-radius: 10px;
            padding: 10px 12px; display: flex; align-items: center; gap: 10px; margin-bottom: 7px;
            border: 1px solid rgba(255,255,255,.06);
        }
        .stat-icon { width: 34px; height: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-val { font-weight: 700; font-size: .95em; color: #f1f5f9; }
        .stat-lbl { font-size: .7em; color: #64748b; }

        #filter-panel select, #filter-panel input[type=text] {
            width: 100%; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);
            color: #e2e8f0; border-radius: 8px; padding: 8px 10px; font-size: .82em; font-family: 'Inter';
            margin-bottom: 7px; outline: none;
        }
        #filter-panel select option { background: #1e293b; }

        .fp-btn {
            width: 100%; padding: 9px; border-radius: 8px; font-size: .82em; font-weight: 600;
            cursor: pointer; border: none; font-family: 'Inter';
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        .fp-btn-primary { background: linear-gradient(135deg,#16a34a,#15803d); color: white; }
        .fp-btn-reset { background: rgba(255,255,255,.07); color: #94a3b8; margin-top: 6px; }

        /* tombol geolokasi */
        #btn-my-loc {
            width: 100%; padding: 9px; border-radius: 8px; font-size: .82em; font-weight: 600;
            cursor: pointer; border: 1px solid rgba(14,165,233,.4); font-family: 'Inter';
            background: rgba(14,165,233,.12); color: #38bdf8; margin-bottom: 7px;
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        #btn-my-loc:hover { background: rgba(14,165,233,.22); }

        /* ===== MAP ===== */
        #map {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            width: 100%; height: 100%;
        }

        /* ===== INFO SIDEBAR (kanan) ===== */
        #info-sidebar {
            position: fixed; top: 66px; right: 10px; z-index: 900; width: 310px;
            background: rgba(15,23,42,.97); backdrop-filter: blur(16px);
            border-radius: 14px; border: 1px solid rgba(255,255,255,.08);
            padding: 16px; max-height: calc(100vh - 82px); overflow-y: auto;
            display: none;
        }
        .info-close {
            position: absolute; top: 10px; right: 10px;
            background: rgba(255,255,255,.07); border: none; color: #94a3b8;
            border-radius: 7px; width: 26px; height: 26px;
            cursor: pointer; font-size: .9em; display: flex; align-items: center; justify-content: center;
        }
        .info-header-card {
            background: linear-gradient(135deg,#1d4ed8,#2563eb);
            border-radius: 11px; padding: 14px; margin-bottom: 14px; text-align: center;
        }
        .info-row { display: flex; gap: 10px; margin-bottom: 7px; font-size: .82em; align-items: flex-start; }
        .info-lbl { color: #64748b; width: 95px; flex-shrink: 0; padding-top: 1px; }
        .info-val { color: #e2e8f0; font-weight: 500; flex: 1; }

        /* ===== LEGEND ===== */
        #legend {
            position: fixed; bottom: 18px; left: 10px; z-index: 900;
            background: rgba(15,23,42,.97); backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.08); border-radius: 11px; padding: 11px 14px;
            font-size: .77em;
        }
        .leg-title { font-weight: 700; color: #64748b; margin-bottom: 7px;
            text-transform: uppercase; font-size: .7em; letter-spacing: .5px; }
        .leg-item { display: flex; align-items: center; gap: 7px; margin-bottom: 4px; color: #cbd5e1; }
        .leg-dot { width: 11px; height: 11px; border-radius: 50%; flex-shrink: 0; border: 2px solid rgba(255,255,255,.25); }
        .leg-poly { width: 14px; height: 10px; border-radius: 3px; flex-shrink: 0; opacity: .8; }

        /* ===== Leaflet popup ===== */
        .leaflet-popup-content-wrapper {
            background: #1e293b; color: #e2e8f0;
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,.4);
        }
        .leaflet-popup-tip { background: #1e293b; }
        .leaflet-popup-content { margin: 12px 14px; font-family: 'Inter'; font-size: 13px; line-height: 1.6; }
        .leaflet-popup-close-button { color: #64748b !important; }

        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,.15); border-radius: 2px; }

        @media (max-width: 768px) {
            #filter-panel { width: calc(100vw - 20px); max-height: 190px; }
            #info-sidebar  { width: calc(100vw - 20px); right: 10px; top: unset; bottom: 10px; max-height: 44vh; }
        }

        @keyframes spin { to { transform: rotate(360deg); } }
        .spin { animation: spin 1s linear infinite; }
    </style>
</head>
<body>

<!-- ===== HEADER ===== -->
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

    <!-- Tombol toggle filter panel (mobile) -->
    <button class="hdr-btn" onclick="toggleFilterPanel()" title="Filter">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
        Filter
    </button>

    <div class="hdr-nav">
        <a href="{{ route('public.cari') }}" class="hdr-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Cari
        </a>
        <a href="{{ route('landing') }}" class="hdr-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Beranda
        </a>
        <a href="{{ route('login') }}" class="hdr-btn hdr-btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            Admin
        </a>
    </div>
</div>

<!-- ===== FILTER PANEL ===== -->
<div id="filter-panel">

    <div class="fp-section">Statistik Peta</div>

    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(22,163,74,.15);">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <div><div class="stat-val" id="stat-kolam">{{ $totalKolam }}</div><div class="stat-lbl">Total Kolam</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(59,130,246,.15);">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        </div>
        <div><div class="stat-val" id="stat-visible">-</div><div class="stat-lbl">Ditampilkan</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(245,158,11,.15);">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
        </div>
        <div><div class="stat-val" id="stat-polygon">-</div><div class="stat-lbl">Ada Batas Kolam</div></div>
    </div>

    <!-- Tombol lokasi saya -->
    <div class="fp-section">Lokasi</div>
    <button id="btn-my-loc" onclick="getMyLocation()">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/><circle cx="12" cy="12" r="8" opacity=".2"/></svg>
        <span id="loc-btn-text">Lokasi Saya</span>
    </button>

    <div class="fp-section">Filter Kolam</div>
    <select id="filter-jenis-kolam">
        <option value="">Semua Jenis Kolam</option>
        @foreach($jenisKolam as $jk)
        <option value="{{ $jk }}">{{ ucfirst($jk) }}</option>
        @endforeach
    </select>

    <select id="filter-status">
        <option value="">Semua Status</option>
        <option value="aktif">Aktif</option>
        <option value="tidak_aktif">Tidak Aktif</option>
        <option value="perbaikan">Perbaikan</option>
    </select>

    <select id="filter-ikan">
        <option value="">Semua Jenis Ikan</option>
        @foreach($jenisIkanList as $ikan)
        <option value="{{ $ikan->id }}">{{ $ikan->nama_ikan }}</option>
        @endforeach
    </select>

    <button class="fp-btn fp-btn-primary" onclick="applyFilters()">
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/></svg>
        Terapkan Filter
    </button>
    <button class="fp-btn fp-btn-reset" onclick="resetFilters()">
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.3"/></svg>
        Reset Filter
    </button>
</div>

<!-- MAP -->
<div id="map"></div>

<!-- INFO SIDEBAR -->
<div id="info-sidebar">
    <button class="info-close" onclick="closeInfoSidebar()" title="Tutup">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div id="info-content"></div>
</div>

<!-- LEGEND -->
<div id="legend">
    <div class="leg-title">Keterangan</div>
    <div class="leg-item"><div class="leg-dot" style="background:#22c55e;"></div>Kolam Aktif</div>
    <div class="leg-item"><div class="leg-dot" style="background:#f59e0b;"></div>Sedang Perbaikan</div>
    <div class="leg-item"><div class="leg-dot" style="background:#ef4444;"></div>Tidak Aktif</div>
    <div class="leg-item" style="margin-top:6px;">
        <div class="leg-poly" style="background:#3b82f6;border:2px solid #2563eb;"></div>
        Batas Kolam
    </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<script>
// ============================================================
// CONFIG — Fokus Kuantan Singingi, Riau
// ============================================================
const KUANSING_LAT  = -0.302;
const KUANSING_LNG  = 101.468;
const KUANSING_ZOOM = 11;

// Bounding box Kuantan Singingi (approx)
const KUANSING_BOUNDS = [[-1.2, 100.7], [0.5, 102.3]];

// ============================================================
// MAP INIT
// ============================================================
const map = L.map('map', {
    center: [KUANSING_LAT, KUANSING_LNG],
    zoom: KUANSING_ZOOM,
    zoomControl: true,
});

// ============================================================
// TILE LAYERS — Selalu Update (pilih dari layer control kanan bawah)
// ============================================================
const G = ['0','1','2','3']; // Google load balancer

// Google Maps Jalan — diupdate Google real-time
const layerGoogleJalan = L.tileLayer(
    'https://mt{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
    { attribution:'&copy; Google Maps', subdomains:G, maxZoom:22, maxNativeZoom:21 }
);
// Google Satelit — update paling sering, coverage terbaik Indonesia
const layerGoogleSatelit = L.tileLayer(
    'https://mt{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',
    { attribution:'&copy; Google Satellite', subdomains:G, maxZoom:22, maxNativeZoom:21 }
);
// Google Hybrid = Satelit + Label Jalan (REKOMENDASI untuk GIS kolam)
const layerGoogleHybrid = L.tileLayer(
    'https://mt{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}',
    { attribution:'&copy; Google Hybrid', subdomains:G, maxZoom:22, maxNativeZoom:21 }
);
// OpenStreetMap — komunitas update harian, detail desa terbaik
const layerOSM = L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    { attribution:'&copy; <a href="https://openstreetmap.org">OpenStreetMap</a>', subdomains:'abc', maxZoom:20, maxNativeZoom:19 }
);
// Esri Satellite — backup resolusi tinggi
const layerEsri = L.tileLayer(
    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
    { attribution:'&copy; Esri', maxZoom:20, maxNativeZoom:18 }
);

// Default: Google Hybrid (terbaik lihat kolam di lahan)
layerGoogleHybrid.addTo(map);

L.control.layers({
    'Google Hybrid (Default)' : layerGoogleHybrid,
    'Google Satelit'           : layerGoogleSatelit,
    'Google Jalan'             : layerGoogleJalan,
    'OpenStreetMap'            : layerOSM,
    'Esri Satelit'             : layerEsri,
}, {}, { position: 'bottomright', collapsed: true }).addTo(map);

// ============================================================
// LAYER GROUPS
// ============================================================
const clusterGroup = L.markerClusterGroup({
    maxClusterRadius: 60,
    spiderfyOnMaxZoom: true,
    showCoverageOnHover: false,
    zoomToBoundsOnClick: true,
    iconCreateFunction: function(cluster) {
        const n = cluster.getChildCount();
        const size = n < 10 ? 36 : n < 50 ? 44 : 52;
        return L.divIcon({
            html: `<div style="width:${size}px;height:${size}px;background:linear-gradient(135deg,#16a34a,#15803d);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:800;font-size:${Math.round(size/3)}px;box-shadow:0 4px 14px rgba(22,163,74,.5);border:3px solid rgba(255,255,255,.3);">${n}</div>`,
            className: '', iconSize: [size, size], iconAnchor: [size/2, size/2],
        });
    }
});
map.addLayer(clusterGroup);

// Layer khusus polygon batas kolam
const polygonLayer = L.layerGroup().addTo(map);

let myLocCircle = null;
let myLocMarker = null;

// ============================================================
// MARKER ICON
// ============================================================
function createMarkerIcon(color) {
    return L.divIcon({
        html: `<div style="width:28px;height:28px;background:${color};border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid rgba(255,255,255,.85);box-shadow:0 3px 10px rgba(0,0,0,.4);">
                   <div style="transform:rotate(45deg);width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                       <svg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'><path d='M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z'/></svg>
                   </div>
               </div>`,
        className: '', iconSize: [28, 28], iconAnchor: [14, 28], popupAnchor: [0, -30],
    });
}

// ============================================================
// LOAD DATA GIS
// ============================================================
function loadMarkers(params = {}) {
    const url = new URL('{{ route("api.kolam.gis") }}', window.location.origin);
    Object.entries(params).forEach(([k, v]) => { if (v) url.searchParams.set(k, v); });

    fetch(url)
        .then(res => {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        })
        .then(data => {
            clusterGroup.clearLayers();
            polygonLayer.clearLayers();

            const features = data.features || [];
            let polyCount = 0;

            features.forEach(feature => {
                const prop  = feature.properties;
                const geom  = feature.geometry; // Point geometry
                const color = prop.status_color || '#22c55e';

                // -- Render polygon batas kolam jika ada --
                if (prop.polygon && prop.polygon.coordinates) {
                    polyCount++;
                    const polyLayer = L.geoJSON({
                        type: 'Feature',
                        geometry: prop.polygon,
                    }, {
                        style: {
                            color: color,
                            fillColor: color,
                            fillOpacity: 0.18,
                            weight: 2,
                            dashArray: '4 4',
                        }
                    });
                    polyLayer.bindTooltip(`<strong>${prop.nama_kolam}</strong>`, {
                        permanent: false, direction: 'top',
                        className: 'custom-tooltip',
                    });
                    polyLayer.on('click', () => showInfoSidebar(prop));
                    polygonLayer.addLayer(polyLayer);
                }

                // -- Render marker pin (hanya jika ada koordinat) --
                if (!geom || !geom.coordinates || geom.coordinates[0] == null) return;
                const [lng, lat] = geom.coordinates;
                if (isNaN(lat) || isNaN(lng)) return;

                const icon   = createMarkerIcon(color);
                const marker = L.marker([lat, lng], { icon });

                // Popup
                marker.bindPopup(buildPopupHtml(prop, color));
                marker.on('click', () => showInfoSidebar(prop));

                clusterGroup.addLayer(marker);
            });

            document.getElementById('stat-visible').textContent = features.length;
            document.getElementById('stat-polygon').textContent = polyCount;
        })
        .catch(err => {
            console.error('GIS load error:', err);
            document.getElementById('stat-visible').textContent = 'Error';
        });
}

function buildPopupHtml(prop, color) {
    return `<div style="min-width:200px;">
        <div style="font-weight:700;font-size:.95em;margin-bottom:4px;color:#f1f5f9;">${prop.nama_kolam}</div>
        <div style="font-size:.78em;color:#64748b;margin-bottom:8px;">${prop.alamat_kolam || ''}</div>
        <table style="width:100%;font-size:.78em;border-collapse:collapse;">
            <tr><td style="color:#64748b;padding:3px 0;">Pembudidaya</td><td style="color:#e2e8f0;font-weight:600;">${prop.pembudidaya || '-'}</td></tr>
            <tr><td style="color:#64748b;padding:3px 0;">Jenis Kolam</td><td style="color:#e2e8f0;">${prop.jenis_kolam}</td></tr>
            <tr><td style="color:#64748b;padding:3px 0;">Jenis Ikan</td><td style="color:#e2e8f0;">${prop.jenis_ikan}</td></tr>
            <tr><td style="color:#64748b;padding:3px 0;">Luas</td><td style="color:#e2e8f0;">${prop.luas_m2 ? prop.luas_m2 + ' m²' : '-'}</td></tr>
            <tr><td style="color:#64748b;padding:3px 0;">Status</td><td><span style="background:${color}22;color:${color};padding:2px 8px;border-radius:20px;font-weight:600;font-size:.88em;">${prop.status_label}</span></td></tr>
            <tr><td style="color:#64748b;padding:3px 0;">Total Panen</td><td style="color:#22c55e;font-weight:700;">${prop.total_panen_kg ? parseFloat(prop.total_panen_kg).toLocaleString('id') + ' kg' : '-'}</td></tr>
        </table>
        ${prop.detail_url ? `<a href="${prop.detail_url}" style="display:block;margin-top:10px;background:linear-gradient(135deg,#16a34a,#15803d);color:white;padding:7px;border-radius:8px;text-align:center;text-decoration:none;font-size:.8em;font-weight:600;">Lihat Detail</a>` : ''}
    </div>`;
}

// ============================================================
// INFO SIDEBAR
// ============================================================
function showInfoSidebar(prop) {
    const color = prop.status_color || '#22c55e';
    document.getElementById('info-content').innerHTML = `
        <div class="info-header-card">
            <div style="margin-bottom:8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" opacity=".8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            <div style="font-weight:800;font-size:.95em;color:white;">${prop.nama_kolam}</div>
            <div style="font-size:.72em;color:rgba(255,255,255,.6);margin-top:3px;">${prop.alamat_kolam || ''}</div>
        </div>

        <div class="info-row"><span class="info-lbl">Pembudidaya</span><span class="info-val">${prop.pembudidaya || '-'}</span></div>
        <div class="info-row"><span class="info-lbl">Kontak</span><span class="info-val">${prop.pembudidaya_hp || '-'}</span></div>
        <div class="info-row"><span class="info-lbl">Jenis Kolam</span><span class="info-val">${prop.jenis_kolam}</span></div>
        <div class="info-row"><span class="info-lbl">Jenis Ikan</span><span class="info-val">${prop.jenis_ikan}</span></div>
        <div class="info-row"><span class="info-lbl">Luas</span><span class="info-val">${prop.luas_m2 ? prop.luas_m2 + ' m²' : '-'}</span></div>
        <div class="info-row"><span class="info-lbl">Kedalaman</span><span class="info-val">${prop.kedalaman_m ? prop.kedalaman_m + ' m' : '-'}</span></div>
        <div class="info-row"><span class="info-lbl">Status</span><span class="info-val"><span style="background:${color}22;color:${color};padding:2px 10px;border-radius:20px;font-weight:600;font-size:.9em;">${prop.status_label}</span></span></div>

        <div style="background:rgba(34,197,94,.08);border-radius:10px;padding:12px;margin:12px 0;border:1px solid rgba(34,197,94,.12);">
            <div style="font-size:.7em;text-transform:uppercase;letter-spacing:.5px;color:#64748b;margin-bottom:7px;font-weight:700;">Data Produksi</div>
            <div style="display:flex;gap:14px;flex-wrap:wrap;">
                <div>
                    <div style="font-weight:800;color:#22c55e;font-size:1em;">${prop.total_panen_kg ? parseFloat(prop.total_panen_kg).toLocaleString('id') + ' kg' : '0 kg'}</div>
                    <div style="font-size:.7em;color:#64748b;">Total Panen</div>
                </div>
                <div>
                    <div style="font-weight:800;color:#f59e0b;font-size:.9em;">Rp ${prop.total_pendapatan ? parseFloat(prop.total_pendapatan).toLocaleString('id') : '0'}</div>
                    <div style="font-size:.7em;color:#64748b;">Pendapatan</div>
                </div>
            </div>
        </div>

        ${prop.detail_url ? `<a href="${prop.detail_url}" style="display:flex;align-items:center;justify-content:center;gap:6px;background:linear-gradient(135deg,#16a34a,#15803d);color:white;padding:10px;border-radius:10px;text-decoration:none;font-size:.83em;font-weight:600;">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            Lihat Detail Lengkap
        </a>` : ''}
    `;
    document.getElementById('info-sidebar').style.display = 'block';
}

function closeInfoSidebar() {
    document.getElementById('info-sidebar').style.display = 'none';
}

// ============================================================
// GEOLOKASI
// ============================================================
function getMyLocation() {
    const btn     = document.getElementById('btn-my-loc');
    const btnText = document.getElementById('loc-btn-text');

    if (!navigator.geolocation) {
        alert('Browser tidak mendukung geolokasi.');
        return;
    }

    btn.disabled = true;
    btnText.innerHTML = '<svg class="spin" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Memuat...';

    navigator.geolocation.getCurrentPosition(function(pos) {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;
        const acc = pos.coords.accuracy;

        map.setView([lat, lng], 16);

        if (myLocCircle) map.removeLayer(myLocCircle);
        if (myLocMarker) map.removeLayer(myLocMarker);

        myLocCircle = L.circle([lat, lng], {
            radius: acc, color: '#0ea5e9', fillOpacity: 0.08, weight: 1.5
        }).addTo(map);

        myLocMarker = L.marker([lat, lng], {
            icon: L.divIcon({
                className: '',
                html: `<div style="width:16px;height:16px;background:#0ea5e9;border-radius:50%;border:3px solid white;box-shadow:0 0 0 3px rgba(14,165,233,.3);"></div>`,
                iconSize: [16,16], iconAnchor: [8,8]
            })
        }).addTo(map).bindPopup(`<strong>Lokasi Anda</strong><br><small>Akurasi ~${Math.round(acc)} m</small>`).openPopup();

        btn.disabled = false;
        btnText.textContent = 'Lokasi Saya';
    }, function(err) {
        btn.disabled = false;
        btnText.textContent = 'Lokasi Saya';
        let msg = 'Gagal mendapat lokasi';
        if (err.code === 1) msg = 'Izin lokasi ditolak. Aktifkan di pengaturan browser.';
        if (err.code === 2) msg = 'Lokasi tidak tersedia.';
        alert(msg);
    }, { enableHighAccuracy: true, timeout: 12000 });
}

// ============================================================
// FILTER
// ============================================================
function applyFilters() {
    loadMarkers({
        jenis_kolam:  document.getElementById('filter-jenis-kolam').value,
        status_kolam: document.getElementById('filter-status').value,
        jenis_ikan_id: document.getElementById('filter-ikan').value,
    });
}

function resetFilters() {
    document.getElementById('filter-jenis-kolam').value = '';
    document.getElementById('filter-status').value       = '';
    document.getElementById('filter-ikan').value         = '';
    loadMarkers();
}

function toggleFilterPanel() {
    const p = document.getElementById('filter-panel');
    p.style.display = p.style.display === 'none' ? 'block' : 'none';
}

// ============================================================
// INIT
// ============================================================
loadMarkers();
</script>
</body>
</html>
