@extends('template-admin.layout')
@section('title', 'Tambah Kolam')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item"><a href="{{ route('kolam.index') }}">Kolam</a></li>
 <li class="breadcrumb-item active">Tambah</li>
 </ul>
 </div>
 <div class="col-md-12">
 <h2 class="mb-0" style="color:#14532d;font-weight:800;">
 <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-4px;margin-right:8px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
 Tambah Data Kolam
 </h2>
 </div>
 </div>
 </div>
 </div>

 <div class="row">
 {{-- FORM --}}
 <div class="col-lg-7">
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:linear-gradient(135deg,#1d4ed8,#2563eb);border-radius:16px 16px 0 0;padding:18px 24px;">
 <h5 style="color:white;margin:0;font-weight:700;font-size:1rem;">
 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-3px;margin-right:6px;"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6M9 15h6"/></svg>
 Form Data Kolam
 </h5>
 </div>
 <div class="card-body p-4">
 @if($errors->any())
 <div class="alert alert-danger" style="border-radius:10px;">
 <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
 </div>
 @endif

 <form action="{{ route('kolam.store') }}" method="POST" id="formKolam" enctype="multipart/form-data">
 @csrf
 {{-- Hidden input geometry polygon --}}
 <input type="hidden" id="geometry_input" name="geometry" value="">

 <div class="row g-3">
 <div class="col-md-6">
 <label class="form-label fw-600">Pembudidaya <span class="text-danger">*</span></label>
 <select name="pembudidaya_id" class="form-select @error('pembudidaya_id') is-invalid @enderror" style="border-radius:10px;">
 <option value="">-- Pilih Pembudidaya --</option>
 @foreach($pembudidayaList as $pb)
 <option value="{{ $pb->id }}" {{ old('pembudidaya_id') == $pb->id ? 'selected' : '' }}>{{ $pb->nama }}</option>
 @endforeach
 </select>
 @error('pembudidaya_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-md-6">
 <label class="form-label fw-600">Nama Kolam <span class="text-danger">*</span></label>
 <input type="text" name="nama_kolam" value="{{ old('nama_kolam') }}" class="form-control @error('nama_kolam') is-invalid @enderror" placeholder="Contoh: Kolam Lele A1" style="border-radius:10px;">
 @error('nama_kolam')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-md-4">
 <label class="form-label fw-600">Jenis Kolam <span class="text-danger">*</span></label>
 <select name="jenis_kolam" class="form-select" style="border-radius:10px;">
 @foreach(['terpal'=>'Terpal','beton'=>'Beton','tanah'=>'Tanah','keramba'=>'Keramba','lainnya'=>'Lainnya'] as $val => $label)
 <option value="{{ $val }}" {{ old('jenis_kolam') == $val ? 'selected' : '' }}>{{ $label }}</option>
 @endforeach
 </select>
 </div>
 <div class="col-md-4">
 <label class="form-label fw-600">Luas (m²)</label>
 <input type="number" step="0.01" name="luas_m2" id="luas_input" value="{{ old('luas_m2') }}" class="form-control" placeholder="Hitung otomatis dari peta" min="0" style="border-radius:10px;">
 </div>
 <div class="col-md-4">
 <label class="form-label fw-600">Kedalaman (m)</label>
 <input type="number" step="0.01" name="kedalaman_m" value="{{ old('kedalaman_m') }}" class="form-control" placeholder="Meter" min="0" style="border-radius:10px;">
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Alamat Kolam <span class="text-danger">*</span></label>
 <textarea name="alamat_kolam" rows="2" class="form-control @error('alamat_kolam') is-invalid @enderror" placeholder="Alamat/lokasi kolam" style="border-radius:10px;">{{ old('alamat_kolam') }}</textarea>
 @error('alamat_kolam')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>

 {{-- Koordinat GPS --}}
 <div class="col-12">
 <div style="background:#f0fdf4;border-radius:12px;padding:14px;border:1px solid #bbf7d0;">
 <div style="font-size:.82em;font-weight:700;color:#15803d;margin-bottom:8px;">
 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
 Koordinat GPS (isi manual atau gambar di peta)
 </div>
 <div class="row g-2">
 <div class="col-md-5">
 <label class="form-label" style="font-size:.8em;font-weight:600;">Latitude</label>
 <input type="number" step="0.000001" id="lat_input" name="latitude" value="{{ old('latitude') }}" class="form-control form-control-sm" placeholder="-0.302 (Kuantan Singingi)" style="border-radius:8px;" min="-90" max="90">
 </div>
 <div class="col-md-5">
 <label class="form-label" style="font-size:.8em;font-weight:600;">Longitude</label>
 <input type="number" step="0.000001" id="lng_input" name="longitude" value="{{ old('longitude') }}" class="form-control form-control-sm" placeholder="101.468 (Kuantan Singingi)" style="border-radius:8px;" min="-180" max="180">
 </div>
 <div class="col-md-2 d-flex align-items-end">
 <button type="button" id="btn_my_loc" class="btn btn-sm w-100" style="background:#0ea5e9;color:white;border-radius:8px;font-size:.8em;" title="Lokasi saya sekarang">
 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/><circle cx="12" cy="12" r="8" opacity=".3"/></svg>
 Saya
 </button>
 </div>
 </div>
 </div>
 </div>

 <div class="col-md-6">
 <label class="form-label fw-600">Status Kolam <span class="text-danger">*</span></label>
 <select name="status_kolam" class="form-select" style="border-radius:10px;">
 <option value="aktif" selected>Aktif</option>
 <option value="tidak_aktif">Tidak Aktif</option>
 <option value="perbaikan">Perbaikan</option>
 </select>
 </div>
 <div class="col-md-6">
 <label class="form-label fw-600">Jenis Ikan Awal</label>
 <select name="jenis_ikan_id" class="form-select" style="border-radius:10px;">
 <option value="">-- Tidak ada / Isi nanti --</option>
 @foreach($jenisIkanList as $ikan)
 <option value="{{ $ikan->id }}" {{ old('jenis_ikan_id') == $ikan->id ? 'selected' : '' }}>{{ $ikan->nama_ikan }}</option>
 @endforeach
 </select>
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Keterangan</label>
 <textarea name="keterangan" rows="2" class="form-control" style="border-radius:10px;">{{ old('keterangan') }}</textarea>
 </div>
 <div class="col-md-12">
  <label class="form-label fw-600">Foto Kolam</label>
  <div style="border:2px dashed #d1d5db;border-radius:12px;padding:16px;background:#fafafa;">
   <input type="file" id="foto_kolam_input" name="foto_kolam" class="form-control @error('foto_kolam') is-invalid @enderror"
    style="border-radius:8px;" accept=".jpg,.jpeg,.png" onchange="previewFotoKolam(this)">
   @error('foto_kolam')<div class="invalid-feedback">{{ $message }}</div>@enderror
   <div style="font-size:.75em;color:#9ca3af;margin-top:6px;">
    <i class="ti ti-info-circle me-1"></i>Format: JPG, JPEG, PNG &bull; Ukuran maks: 2 MB
   </div>
   {{-- Preview --}}
   <div id="foto_preview_wrap" style="display:none;margin-top:12px;">
    <div style="font-size:.78em;font-weight:600;color:#374151;margin-bottom:6px;">Preview Foto:</div>
    <div style="position:relative;display:inline-block;">
     <img id="foto_preview" src="" alt="Preview" style="max-width:100%;max-height:220px;border-radius:10px;border:2px solid #e5e7eb;object-fit:cover;">
     <button type="button" onclick="hapusPreviuFoto()" title="Hapus pilihan"
      style="position:absolute;top:-8px;right:-8px;width:24px;height:24px;background:#ef4444;color:white;border:none;border-radius:50%;font-size:.85em;cursor:pointer;display:flex;align-items:center;justify-content:center;">
      &times;
     </button>
    </div>
   </div>
   {{-- Belum ada foto --}}
   <div id="foto_placeholder" style="margin-top:10px;text-align:center;color:#9ca3af;font-size:.8em;padding:10px;">
    <i class="ti ti-camera" style="font-size:1.6em;display:block;margin-bottom:4px;"></i>
    Belum ada foto — klik untuk memilih gambar
   </div>
  </div>
  </div>
 </div>

 <div class="d-flex gap-2 mt-4">
 <button type="submit" class="btn" style="background:linear-gradient(135deg,#1d4ed8,#2563eb);color:white;border:none;border-radius:10px;padding:10px 28px;font-weight:600;">
 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:5px;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
 Simpan Kolam
 </button>
 <a href="{{ route('kolam.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;padding:10px 28px;">Batal</a>
 </div>
 </form>
 </div>
 </div>
 </div>

 {{-- GIS MAP PANEL --}}
 <div class="col-lg-5">
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);position:sticky;top:80px;">
 <div class="card-header" style="background:linear-gradient(135deg,#065f46,#059669);border-radius:16px 16px 0 0;padding:14px 20px;">
 <div class="d-flex align-items-center justify-content-between">
 <h6 style="color:white;margin:0;font-weight:700;font-size:.95rem;">
 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:6px;"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/></svg>
 Peta GIS — Kuantan Singingi
 </h6>
 <div class="d-flex gap-1">
 <button type="button" id="btn_draw_polygon" class="btn btn-sm" title="Gambar Polygon Kolam" style="background:rgba(255,255,255,.2);color:white;border:1px solid rgba(255,255,255,.4);border-radius:8px;font-size:.78em;padding:5px 10px;">
 <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:3px;"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
 Gambar
 </button>
 <button type="button" id="btn_clear_draw" class="btn btn-sm" title="Hapus gambar" style="background:rgba(255,255,255,.15);color:white;border:1px solid rgba(255,255,255,.3);border-radius:8px;font-size:.78em;padding:5px 10px;" disabled>
 <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:3px;"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
 Hapus
 </button>
 </div>
 </div>
 </div>

 {{-- Status bar --}}
 <div id="gis_statusbar" style="background:#f0fdf4;border-bottom:1px solid #d1fae5;padding:8px 16px;font-size:.78em;color:#065f46;display:flex;align-items:center;gap:8px;">
 <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
 <span id="status_text">Klik <strong>Gambar</strong> untuk membuat batas kolam, atau klik peta untuk pin lokasi</span>
 </div>

 {{-- Main Map --}}
 <div id="gis_map" style="height:460px;width:100%;border-radius:0;"></div>

 {{-- Info area --}}
 <div id="gis_info" style="background:#fff;border-top:1px solid #e5e7eb;padding:10px 16px;border-radius:0 0 16px 16px;display:none;">
 <div class="row g-2" style="font-size:.8em;">
 <div class="col-6">
 <div style="color:#6b7280;font-weight:600;">Luas Terukur</div>
 <div id="info_luas" style="color:#065f46;font-weight:700;font-size:1.05em;">—</div>
 </div>
 <div class="col-6">
 <div style="color:#6b7280;font-weight:600;">Titik Koordinat</div>
 <div id="info_coords" style="color:#065f46;font-weight:700;font-size:1.05em;">—</div>
 </div>
 </div>
 </div>
 </div>

 {{-- Panduan --}}
 <div class="card mt-3" style="border-radius:14px;border:1px solid #e5e7eb;background:#fffbeb;">
 <div class="card-body p-3">
 <div style="font-size:.8em;font-weight:700;color:#92400e;margin-bottom:8px;">
 <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
 Panduan Peta GIS
 </div>
 <ol style="font-size:.78em;color:#78350f;margin:0;padding-left:16px;line-height:1.8;">
 <li>Klik <strong>Lokasi Saya</strong> untuk zoom ke posisi Anda sekarang</li>
 <li>Klik <strong>Gambar</strong> lalu klik di peta untuk membentuk batas kolam</li>
 <li>Klik titik pertama untuk menutup/selesai menggambar</li>
 <li>Luas kolam akan dihitung otomatis dari gambar</li>
 <li>Area default: Kuantan Singingi, Riau</li>
 </ol>
 </div>
 </div>
 </div>
 </div>
</div>

{{-- Leaflet CSS + Leaflet.Draw --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

<style>
.leaflet-draw-toolbar a { border-radius: 6px !important; }
#gis_map .leaflet-control-zoom { border-radius: 10px; }
</style>

<script>
// ============================================================
// GIS MAP — Kuantan Singingi, Riau
// Koordinat pusat: -0.302, 101.468
// ============================================================
const KUANSING_LAT = -0.302;
const KUANSING_LNG = 101.468;
const KUANSING_ZOOM = 11;

let gisMap, markerPin, drawnLayer, drawControl;
let isDrawingMode = false;
let drawnPolygon = null;
const drawnItems = new L.FeatureGroup();

// -- Inisialisasi peta --
window.addEventListener('DOMContentLoaded', function () {
 gisMap = L.map('gis_map', { zoomControl: true }).setView([KUANSING_LAT, KUANSING_LNG], KUANSING_ZOOM);

 // Layer tiles
 // ============================================================
// TILE LAYERS — 5 Provider Selalu Update
// ============================================================
 const G = ['0','1','2','3'];
 const layerGoogleHybrid  = L.tileLayer('https://mt{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}',
     { attribution:'© Google Hybrid',    subdomains:G, maxZoom:22, maxNativeZoom:21 });
 const layerGoogleSatelit = L.tileLayer('https://mt{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',
     { attribution:'© Google Satellite', subdomains:G, maxZoom:22, maxNativeZoom:21 });
 const layerGoogleJalan   = L.tileLayer('https://mt{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
     { attribution:'© Google Maps',      subdomains:G, maxZoom:22, maxNativeZoom:21 });
 const layerOSM           = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
     { attribution:'© OpenStreetMap', subdomains:'abc', maxZoom:20, maxNativeZoom:19 });
 const layerEsri          = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
     { attribution:'© Esri', maxZoom:20, maxNativeZoom:18 });
 layerGoogleHybrid.addTo(gisMap);
 L.control.layers({
     'Google Hybrid (Default)': layerGoogleHybrid,
     'Google Satelit'          : layerGoogleSatelit,
     'Google Jalan'            : layerGoogleJalan,
     'OpenStreetMap'           : layerOSM,
     'Esri Satelit'            : layerEsri,
 }, {}, { position: 'topright', collapsed: true }).addTo(gisMap);

 gisMap.addLayer(drawnItems);

 // -- Klik peta untuk pin lokasi (mode normal) --
 gisMap.on('click', function (e) {
 if (isDrawingMode) return;
 setPin(e.latlng.lat, e.latlng.lng);
 });

 // -- Jika sudah ada koordinat lama (old values) --
 const oldLat = parseFloat(document.getElementById('lat_input').value);
 const oldLng = parseFloat(document.getElementById('lng_input').value);
 if (!isNaN(oldLat) && !isNaN(oldLng)) {
 setPin(oldLat, oldLng);
 gisMap.setView([oldLat, oldLng], 15);
 }

 // -- Event: polygon selesai digambar --
 gisMap.on(L.Draw.Event.CREATED, function (e) {
 if (drawnPolygon) drawnItems.removeLayer(drawnPolygon);
 drawnPolygon = e.layer;
 drawnItems.addLayer(drawnPolygon);

 const geojson = drawnPolygon.toGeoJSON().geometry;
 document.getElementById('geometry_input').value = JSON.stringify(geojson);

 // Hitung luas dalam m²
 const luas = turf_area(geojson);
 document.getElementById('luas_input').value = luas.toFixed(2);
 document.getElementById('info_luas').textContent = luas >= 10000
 ? (luas / 10000).toFixed(4) + ' ha (' + Math.round(luas) + ' m²)'
 : Math.round(luas) + ' m²';

 // Set centroid sebagai koordinat pin
 const centroid = getCentroid(geojson.coordinates[0]);
 setPin(centroid.lat, centroid.lng);

 document.getElementById('gis_info').style.display = 'block';
 document.getElementById('info_coords').textContent =
 centroid.lat.toFixed(6) + ', ' + centroid.lng.toFixed(6);

 setStatus('Polygon berhasil dibuat. Luas: ' + Math.round(luas) + ' m²', 'success');
 stopDrawMode();
 document.getElementById('btn_clear_draw').disabled = false;
 });

 gisMap.on(L.Draw.Event.DRAWSTART, function () {
 setStatus('Klik titik-titik batas kolam di peta. Klik titik awal untuk selesai.', 'drawing');
 });

 gisMap.on(L.Draw.Event.DRAWSTOP, function () {
 isDrawingMode = false;
 document.getElementById('btn_draw_polygon').style.background = 'rgba(255,255,255,.2)';
 });

 // Invalidate size setelah render
 setTimeout(() => gisMap.invalidateSize(), 300);
});

// -- Tombol Gambar Polygon --
document.getElementById('btn_draw_polygon').addEventListener('click', function () {
 if (isDrawingMode) {
 stopDrawMode();
 return;
 }
 startDrawMode();
});

// -- Tombol Hapus Gambar --
document.getElementById('btn_clear_draw').addEventListener('click', function () {
 clearDrawing();
});

// -- Tombol Lokasi Saya --
document.getElementById('btn_my_loc').addEventListener('click', function () {
 const btn = this;
 btn.disabled = true;
 btn.innerHTML = '<svg class="spin-anim" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> ...';

 if (!navigator.geolocation) {
 setStatus('Browser tidak mendukung geolokasi.', 'error');
 btn.disabled = false;
 btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg> Saya';
 return;
 }

 navigator.geolocation.getCurrentPosition(function (pos) {
 const lat = pos.coords.latitude;
 const lng = pos.coords.longitude;
 const acc = pos.coords.accuracy;

 gisMap.setView([lat, lng], 16);
 setPin(lat, lng);

 // Lingkaran akurasi
 L.circle([lat, lng], { radius: acc, color: '#0ea5e9', fillOpacity: 0.08, weight: 1.5 }).addTo(gisMap);

 setStatus('Lokasi Anda ditemukan (akurasi ~' + Math.round(acc) + ' m). Klik Gambar untuk buat batas kolam.', 'success');
 btn.disabled = false;
 btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg> Saya';
 }, function (err) {
 let msg = 'Gagal mendapatkan lokasi';
 if (err.code === 1) msg = 'Izin lokasi ditolak. Aktifkan di browser.';
 if (err.code === 2) msg = 'Lokasi tidak tersedia.';
 setStatus(msg, 'error');
 btn.disabled = false;
 btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg> Saya';
 }, { enableHighAccuracy: true, timeout: 10000 });
});

// -- Sinkron input lat/lng manual -> update pin --
['lat_input','lng_input'].forEach(id => {
 document.getElementById(id).addEventListener('change', function() {
 const lat = parseFloat(document.getElementById('lat_input').value);
 const lng = parseFloat(document.getElementById('lng_input').value);
 if (!isNaN(lat) && !isNaN(lng)) {
 setPin(lat, lng);
 gisMap.setView([lat, lng], 16);
 }
 });
});

// ============================================================
// HELPERS
// ============================================================
function setPin(lat, lng) {
 if (markerPin) gisMap.removeLayer(markerPin);
 markerPin = L.marker([lat, lng], {
 draggable: true,
 icon: L.divIcon({
 className: '',
 html: '<div style="width:28px;height:28px;background:#2563eb;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,.4);"></div>',
 iconSize: [28, 28],
 iconAnchor: [14, 28],
 })
 }).addTo(gisMap);
 document.getElementById('lat_input').value = lat.toFixed(6);
 document.getElementById('lng_input').value = lng.toFixed(6);

 markerPin.on('dragend', function (e) {
 const pos = e.target.getLatLng();
 document.getElementById('lat_input').value = pos.lat.toFixed(6);
 document.getElementById('lng_input').value = pos.lng.toFixed(6);
 setStatus('Pin dipindah ke ' + pos.lat.toFixed(5) + ', ' + pos.lng.toFixed(5), 'info');
 });
}

function startDrawMode() {
 isDrawingMode = true;
 document.getElementById('btn_draw_polygon').style.background = '#fbbf24';
 document.getElementById('btn_draw_polygon').style.color = '#1e1e1e';

 if (!drawControl) {
 drawControl = new L.Draw.Polygon(gisMap, {
 shapeOptions: {
 color: '#2563eb',
 fillColor: '#3b82f6',
 fillOpacity: 0.25,
 weight: 2.5,
 },
 showArea: true,
 metric: true,
 repeatMode: false,
 });
 }
 drawControl.enable();
}

function stopDrawMode() {
 isDrawingMode = false;
 document.getElementById('btn_draw_polygon').style.background = 'rgba(255,255,255,.2)';
 document.getElementById('btn_draw_polygon').style.color = 'white';
 if (drawControl) drawControl.disable();
}

function clearDrawing() {
 drawnItems.clearLayers();
 drawnPolygon = null;
 document.getElementById('geometry_input').value = '';
 document.getElementById('luas_input').value = '';
 document.getElementById('gis_info').style.display = 'none';
 document.getElementById('btn_clear_draw').disabled = true;
 setStatus('Gambar dihapus. Klik Gambar untuk membuat batas kolam baru.', 'info');
}

function setStatus(msg, type) {
 const bar = document.getElementById('gis_statusbar');
 const txt = document.getElementById('status_text');
 txt.innerHTML = msg;
 bar.style.background = type === 'error' ? '#fef2f2' : type === 'success' ? '#f0fdf4' : type === 'drawing' ? '#eff6ff' : '#f0fdf4';
 bar.style.color = type === 'error' ? '#b91c1c' : type === 'success' ? '#065f46' : type === 'drawing' ? '#1d4ed8' : '#065f46';
}

function getCentroid(coords) {
 let latSum = 0, lngSum = 0;
 const n = coords.length;
 coords.forEach(c => { lngSum += c[0]; latSum += c[1]; });
 return { lat: latSum / n, lng: lngSum / n };
}

// Hitung luas polygon dalam m² (Shoelace formula + spherical correction)
function turf_area(geojson) {
 const coords = geojson.coordinates[0];
 const R = 6371000; // m
 let area = 0;
 const n = coords.length;
 for (let i = 0; i < n - 1; i++) {
 const p1 = coords[i], p2 = coords[i + 1];
 area += (p2[0] - p1[0]) * Math.PI / 180 *
 (2 + Math.sin(p1[1] * Math.PI / 180) + Math.sin(p2[1] * Math.PI / 180));
 }
 return Math.abs(area * R * R / 2);
}
</script>

<style>
@keyframes spin { to { transform: rotate(360deg); } }
.spin-anim { animation: spin 1s linear infinite; }
</style>
<script>
// ============================================================
// FOTO KOLAM — Preview & Validasi
// ============================================================
function previewFotoKolam(input) {
 const maxSize = 2 * 1024 * 1024; // 2 MB
 const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
 const file = input.files[0];

 if (!file) {
  resetFotoPreview();
  return;
 }

 // Validasi format
 if (!allowedTypes.includes(file.type)) {
  alert('Format file tidak didukung. Gunakan JPG, JPEG, atau PNG.');
  input.value = '';
  resetFotoPreview();
  return;
 }

 // Validasi ukuran
 if (file.size > maxSize) {
  alert('Ukuran file terlalu besar. Maksimal 2 MB.');
  input.value = '';
  resetFotoPreview();
  return;
 }

 // Tampilkan preview
 const reader = new FileReader();
 reader.onload = function(e) {
  document.getElementById('foto_preview').src = e.target.result;
  document.getElementById('foto_preview_wrap').style.display = 'block';
  document.getElementById('foto_placeholder').style.display = 'none';
 };
 reader.readAsDataURL(file);
}

function hapusPreviuFoto() {
 document.getElementById('foto_kolam_input').value = '';
 resetFotoPreview();
}

function resetFotoPreview() {
 document.getElementById('foto_preview').src = '';
 document.getElementById('foto_preview_wrap').style.display = 'none';
 document.getElementById('foto_placeholder').style.display = 'block';
}
</script>
@endsection
