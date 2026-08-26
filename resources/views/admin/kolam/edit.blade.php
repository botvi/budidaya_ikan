@extends('template-admin.layout')
@section('title', 'Edit Kolam')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item"><a href="{{ route('kolam.index') }}">Kolam</a></li>
 <li class="breadcrumb-item active">Edit</li>
 </ul>
 </div>
 <div class="col-md-12">
 <h2 class="mb-0" style="color:#92400e;font-weight:800;">
 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-4px;margin-right:8px;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
 Edit: {{ $kolam->nama_kolam }}
 </h2>
 </div>
 </div>
 </div>
 </div>

 <div class="row">
 {{-- FORM --}}
 <div class="col-lg-7">
 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:linear-gradient(135deg,#b45309,#d97706);border-radius:16px 16px 0 0;padding:18px 24px;">
 <h5 style="color:white;margin:0;font-weight:700;font-size:1rem;">
 <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-3px;margin-right:6px;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
 Edit: {{ $kolam->nama_kolam }}
 </h5>
 </div>
 <div class="card-body p-4">
 @if($errors->any())
 <div class="alert alert-danger" style="border-radius:10px;">
 <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
 </div>
 @endif

 <form action="{{ route('kolam.update', $kolam->id) }}" method="POST" id="formKolam" enctype="multipart/form-data">
 @csrf @method('PUT')
 {{-- Hidden fields --}}
 <input type="hidden" id="geometry_input" name="geometry" value="">
 <input type="hidden" id="clear_geometry" name="clear_geometry" value="">

 <div class="row g-3">
 <div class="col-md-6">
 <label class="form-label fw-600">Pembudidaya <span class="text-danger">*</span></label>
 <select name="pembudidaya_id" class="form-select" style="border-radius:10px;">
 @foreach($pembudidayaList as $pb)
 <option value="{{ $pb->id }}" {{ old('pembudidaya_id', $kolam->pembudidaya_id) == $pb->id ? 'selected' : '' }}>{{ $pb->nama }}</option>
 @endforeach
 </select>
 </div>
 <div class="col-md-6">
 <label class="form-label fw-600">Nama Kolam <span class="text-danger">*</span></label>
 <input type="text" name="nama_kolam" value="{{ old('nama_kolam', $kolam->nama_kolam) }}" class="form-control" style="border-radius:10px;">
 </div>
 <div class="col-md-4">
 <label class="form-label fw-600">Jenis Kolam <span class="text-danger">*</span></label>
 <select name="jenis_kolam" class="form-select" style="border-radius:10px;">
 @foreach(['terpal'=>'Terpal','beton'=>'Beton','tanah'=>'Tanah','keramba'=>'Keramba','lainnya'=>'Lainnya'] as $val => $label)
 <option value="{{ $val }}" {{ old('jenis_kolam', $kolam->jenis_kolam) == $val ? 'selected' : '' }}>{{ $label }}</option>
 @endforeach
 </select>
 </div>
 <div class="col-md-4">
 <label class="form-label fw-600">Luas (m²)</label>
 <input type="number" step="0.01" name="luas_m2" id="luas_input" value="{{ old('luas_m2', $kolam->luas_m2) }}" class="form-control" min="0" style="border-radius:10px;">
 </div>
 <div class="col-md-4">
 <label class="form-label fw-600">Kedalaman (m)</label>
 <input type="number" step="0.01" name="kedalaman_m" value="{{ old('kedalaman_m', $kolam->kedalaman_m) }}" class="form-control" min="0" style="border-radius:10px;">
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Alamat Kolam <span class="text-danger">*</span></label>
 <textarea name="alamat_kolam" rows="2" class="form-control" style="border-radius:10px;">{{ old('alamat_kolam', $kolam->alamat_kolam) }}</textarea>
 </div>

 {{-- Koordinat GPS --}}
 <div class="col-12">
 <div style="background:#f0fdf4;border-radius:12px;padding:14px;border:1px solid #bbf7d0;">
 <div style="font-size:.82em;font-weight:700;color:#15803d;margin-bottom:8px;">
 <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
 Koordinat GPS
 </div>
 <div class="row g-2">
 <div class="col-md-5">
 <label class="form-label" style="font-size:.8em;font-weight:600;">Latitude</label>
 <input type="number" step="0.000001" id="lat_input" name="latitude" value="{{ old('latitude', $kolam->latitude) }}" class="form-control form-control-sm" style="border-radius:8px;" min="-90" max="90">
 </div>
 <div class="col-md-5">
 <label class="form-label" style="font-size:.8em;font-weight:600;">Longitude</label>
 <input type="number" step="0.000001" id="lng_input" name="longitude" value="{{ old('longitude', $kolam->longitude) }}" class="form-control form-control-sm" style="border-radius:8px;" min="-180" max="180">
 </div>
 <div class="col-md-2 d-flex align-items-end">
 <button type="button" id="btn_my_loc" class="btn btn-sm w-100" title="Lokasi saya sekarang" style="background:#0ea5e9;color:white;border-radius:8px;font-size:.8em;padding:6px 4px;">
 <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg>
 Saya
 </button>
 </div>
 </div>
 </div>
 </div>

 <div class="col-md-6">
 <label class="form-label fw-600">Status Kolam <span class="text-danger">*</span></label>
 <select name="status_kolam" class="form-select" style="border-radius:10px;">
 <option value="aktif" {{ old('status_kolam', $kolam->status_kolam) == 'aktif' ? 'selected' : '' }}>Aktif</option>
 <option value="tidak_aktif" {{ old('status_kolam', $kolam->status_kolam) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
 <option value="perbaikan" {{ old('status_kolam', $kolam->status_kolam) == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
 </select>
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Keterangan</label>
 <textarea name="keterangan" rows="2" class="form-control" style="border-radius:10px;">{{ old('keterangan', $kolam->keterangan) }}</textarea>
 </div>
 <div class="col-md-12">
  <label class="form-label fw-600">Foto Kolam</label>
  <div style="border:2px dashed #d1d5db;border-radius:12px;padding:16px;background:#fafafa;">

   {{-- Foto Lama --}}
   @if($kolam->foto_kolam)
   <div id="foto_lama_wrap" style="margin-bottom:12px;">
    <div style="font-size:.78em;font-weight:600;color:#374151;margin-bottom:6px;">Foto saat ini:</div>
    <div style="position:relative;display:inline-block;">
     <img id="foto_lama_img" src="{{ asset($kolam->foto_kolam) }}" alt="Foto Kolam"
      style="max-width:100%;max-height:200px;border-radius:10px;border:2px solid #e5e7eb;object-fit:cover;">
    </div>
    <div style="margin-top:8px;">
     <label style="display:flex;align-items:center;gap:8px;font-size:.82em;color:#dc2626;cursor:pointer;user-select:none;">
      <input type="checkbox" id="chk_hapus_foto" name="hapus_foto" value="1"
       onchange="toggleHapusFoto(this)" style="width:16px;height:16px;cursor:pointer;">
      <span>Hapus foto ini</span>
     </label>
    </div>
   </div>
   @else
   <div id="foto_placeholder_edit" style="text-align:center;color:#9ca3af;font-size:.8em;padding:8px 0 12px;">
    <i class="ti ti-camera" style="font-size:1.6em;display:block;margin-bottom:4px;"></i>
    Belum ada foto — klik untuk memilih gambar
   </div>
   @endif

   {{-- Input file baru --}}
   <input type="file" id="foto_kolam_input" name="foto_kolam"
    class="form-control @error('foto_kolam') is-invalid @enderror"
    style="border-radius:8px;" accept=".jpg,.jpeg,.png"
    onchange="previewFotoKolam(this)">
   @error('foto_kolam')<div class="invalid-feedback">{{ $message }}</div>@enderror
   <div style="font-size:.75em;color:#9ca3af;margin-top:6px;">
    <i class="ti ti-info-circle me-1"></i>Format: JPG, JPEG, PNG &bull; Ukuran maks: 2 MB
    @if($kolam->foto_kolam)
     &bull; Upload baru akan menggantikan foto lama.
    @endif
   </div>

   {{-- Preview foto baru --}}
   <div id="foto_preview_wrap" style="display:none;margin-top:12px;">
    <div style="font-size:.78em;font-weight:600;color:#374151;margin-bottom:6px;">Preview Foto Baru:</div>
    <div style="position:relative;display:inline-block;">
     <img id="foto_preview" src="" alt="Preview"
      style="max-width:100%;max-height:220px;border-radius:10px;border:2px solid #3b82f6;object-fit:cover;">
     <button type="button" onclick="hapusPreviuFoto()" title="Batalkan pilihan"
      style="position:absolute;top:-8px;right:-8px;width:24px;height:24px;background:#ef4444;color:white;border:none;border-radius:50%;font-size:.85em;cursor:pointer;display:flex;align-items:center;justify-content:center;">
      &times;
     </button>
    </div>
   </div>
  </div>
 </div>
 </div>

 <div class="d-flex gap-2 mt-4">
 <button type="submit" class="btn" style="background:linear-gradient(135deg,#d97706,#b45309);color:white;border:none;border-radius:10px;padding:10px 28px;font-weight:600;">
 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:5px;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
 Perbarui
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
 <button type="button" id="btn_draw_polygon" class="btn btn-sm" title="Gambar ulang batas kolam" style="background:rgba(255,255,255,.2);color:white;border:1px solid rgba(255,255,255,.4);border-radius:8px;font-size:.78em;padding:5px 10px;">
 <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:3px;"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
 Gambar Ulang
 </button>
 <button type="button" id="btn_clear_draw" class="btn btn-sm" title="Hapus gambar" style="background:rgba(239,68,68,.4);color:white;border:1px solid rgba(239,68,68,.5);border-radius:8px;font-size:.78em;padding:5px 10px;" @if(!$kolam->hasGeometry()) disabled @endif>
 <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:3px;"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
 Hapus
 </button>
 </div>
 </div>
 </div>

 {{-- Status bar --}}
 <div id="gis_statusbar" style="background:#f0fdf4;border-bottom:1px solid #d1fae5;padding:8px 16px;font-size:.78em;color:#065f46;display:flex;align-items:center;gap:8px;">
 <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
 <span id="status_text">
 @if($kolam->hasGeometry())
 Polygon kolam dimuat dari data tersimpan.
 @elseif($kolam->hasCoordinates())
 Koordinat kolam ada. Klik <strong>Gambar Ulang</strong> untuk buat batas kolam.
 @else
 Klik peta untuk pin lokasi, atau klik <strong>Gambar Ulang</strong> untuk buat batas kolam.
 @endif
 </span>
 </div>

 <div id="gis_map" style="height:460px;width:100%;"></div>

 <div id="gis_info" style="background:#fff;border-top:1px solid #e5e7eb;padding:10px 16px;border-radius:0 0 16px 16px;@if(!$kolam->hasGeometry()) display:none; @endif">
 <div class="row g-2" style="font-size:.8em;">
 <div class="col-6">
 <div style="color:#6b7280;font-weight:600;">Luas Terukur</div>
 <div id="info_luas" style="color:#065f46;font-weight:700;font-size:1.05em;">
 @if($kolam->luas_m2) {{ number_format($kolam->luas_m2, 2) }} m² @else — @endif
 </div>
 </div>
 <div class="col-6">
 <div style="color:#6b7280;font-weight:600;">Titik Koordinat</div>
 <div id="info_coords" style="color:#065f46;font-weight:700;font-size:1.05em;">
 @if($kolam->hasCoordinates()) {{ $kolam->latitude }}, {{ $kolam->longitude }} @else — @endif
 </div>
 </div>
 </div>
 </div>
 </div>

 {{-- Panduan --}}
 <div class="card mt-3" style="border-radius:14px;border:1px solid #e5e7eb;background:#fffbeb;">
 <div class="card-body p-3">
 <div style="font-size:.8em;font-weight:700;color:#92400e;margin-bottom:8px;">
 <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:-2px;margin-right:4px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
 Panduan Edit GIS
 </div>
 <ol style="font-size:.78em;color:#78350f;margin:0;padding-left:16px;line-height:1.8;">
 <li>Polygon kolam yang ada akan tampil otomatis</li>
 <li>Klik <strong>Lokasi Saya</strong> untuk zoom ke posisi Anda</li>
 <li>Klik <strong>Gambar Ulang</strong> untuk ganti batas kolam</li>
 <li>Klik <strong>Hapus</strong> untuk menghapus polygon dari database</li>
 <li>Klik peta (tanpa mode gambar) untuk pindahkan pin lokasi</li>
 </ol>
 </div>
 </div>
 </div>
 </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

<style>
@keyframes spin { to { transform: rotate(360deg); } }
.spin-anim { animation: spin 1s linear infinite; }
</style>

<script>
// ============================================================
// Data kolam dari server
// ============================================================
const KOLAM_LAT = {{ $kolam->latitude ?? -0.302 }};
const KOLAM_LNG = {{ $kolam->longitude ?? 101.468 }};
const HAS_COORDS = {{ $kolam->hasCoordinates() ? 'true' : 'false' }};
const HAS_GEOMETRY = {{ $kolam->hasGeometry() ? 'true' : 'false' }};
const EXISTING_GEOMETRY = {!! $kolam->hasGeometry() ? json_encode($kolam->geometry) : 'null' !!};

const KUANSING_LAT = -0.302;
const KUANSING_LNG = 101.468;

let gisMap, markerPin, drawnLayer, drawControl;
let isDrawingMode = false;
let drawnPolygon = null;
const drawnItems = new L.FeatureGroup();

window.addEventListener('DOMContentLoaded', function () {
 // Tentukan view awal
 const initLat = HAS_COORDS ? KOLAM_LAT : KUANSING_LAT;
 const initLng = HAS_COORDS ? KOLAM_LNG : KUANSING_LNG;
 const initZoom = HAS_COORDS ? 15 : 11;

 gisMap = L.map('gis_map', { zoomControl: true }).setView([initLat, initLng], initZoom);

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

 // Load polygon existing
 if (HAS_GEOMETRY && EXISTING_GEOMETRY) {
 const geoLayer = L.geoJSON({ type: 'Feature', geometry: EXISTING_GEOMETRY }, {
 style: {
 color: '#d97706',
 fillColor: '#f59e0b',
 fillOpacity: 0.25,
 weight: 2.5,
 }
 });
 geoLayer.eachLayer(function(l) {
 drawnPolygon = l;
 drawnItems.addLayer(l);
 });
 gisMap.fitBounds(drawnItems.getBounds(), { padding: [30, 30] });
 // Isi hidden input dengan data existing
 document.getElementById('geometry_input').value = JSON.stringify(EXISTING_GEOMETRY);
 }

 // Load pin koordinat jika ada
 if (HAS_COORDS) {
 setPin(KOLAM_LAT, KOLAM_LNG);
 }

 // Klik peta untuk pin (mode normal)
 gisMap.on('click', function (e) {
 if (isDrawingMode) return;
 setPin(e.latlng.lat, e.latlng.lng);
 });

 // Event polygon selesai digambar
 gisMap.on(L.Draw.Event.CREATED, function (e) {
 if (drawnPolygon) drawnItems.removeLayer(drawnPolygon);
 drawnPolygon = e.layer;
 drawnItems.addLayer(drawnPolygon);

 const geojson = drawnPolygon.toGeoJSON().geometry;
 document.getElementById('geometry_input').value = JSON.stringify(geojson);
 document.getElementById('clear_geometry').value = '';

 const luas = turf_area(geojson);
 document.getElementById('luas_input').value = luas.toFixed(2);
 document.getElementById('info_luas').textContent = luas >= 10000
 ? (luas / 10000).toFixed(4) + ' ha (' + Math.round(luas) + ' m²)'
 : Math.round(luas) + ' m²';

 const centroid = getCentroid(geojson.coordinates[0]);
 setPin(centroid.lat, centroid.lng);

 document.getElementById('gis_info').style.display = 'block';
 document.getElementById('info_coords').textContent =
 centroid.lat.toFixed(6) + ', ' + centroid.lng.toFixed(6);

 setStatus('Polygon diperbarui. Luas: ' + Math.round(luas) + ' m²', 'success');
 stopDrawMode();
 document.getElementById('btn_clear_draw').disabled = false;
 });

 gisMap.on(L.Draw.Event.DRAWSTART, function () {
 setStatus('Klik titik-titik batas kolam. Klik titik awal untuk menutup polygon.', 'drawing');
 });

 gisMap.on(L.Draw.Event.DRAWSTOP, function () {
 isDrawingMode = false;
 document.getElementById('btn_draw_polygon').style.background = 'rgba(255,255,255,.2)';
 document.getElementById('btn_draw_polygon').style.color = 'white';
 });

 setTimeout(() => gisMap.invalidateSize(), 300);
});

// -- Tombol Gambar Ulang --
document.getElementById('btn_draw_polygon').addEventListener('click', function () {
 if (isDrawingMode) { stopDrawMode(); return; }
 startDrawMode();
});

// -- Tombol Hapus Gambar --
document.getElementById('btn_clear_draw').addEventListener('click', function () {
 if (!confirm('Hapus polygon batas kolam ini dari database?')) return;
 clearDrawing();
});

// -- Tombol Lokasi Saya --
document.getElementById('btn_my_loc').addEventListener('click', function () {
 const btn = this;
 btn.disabled = true;
 btn.innerHTML = '<svg class="spin-anim" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> ...';

 if (!navigator.geolocation) {
 setStatus('Browser tidak mendukung geolokasi.', 'error');
 resetLocBtn(btn); return;
 }

 navigator.geolocation.getCurrentPosition(function (pos) {
 const lat = pos.coords.latitude;
 const lng = pos.coords.longitude;
 const acc = pos.coords.accuracy;
 gisMap.setView([lat, lng], 17);
 setPin(lat, lng);
 L.circle([lat, lng], { radius: acc, color: '#0ea5e9', fillOpacity: 0.08, weight: 1.5 }).addTo(gisMap);
 setStatus('Lokasi Anda: ' + lat.toFixed(5) + ', ' + lng.toFixed(5) + ' (akurasi ~' + Math.round(acc) + ' m)', 'success');
 resetLocBtn(btn);
 }, function (err) {
 let msg = 'Gagal mendapatkan lokasi';
 if (err.code === 1) msg = 'Izin lokasi ditolak di browser.';
 if (err.code === 2) msg = 'Lokasi tidak tersedia.';
 setStatus(msg, 'error');
 resetLocBtn(btn);
 }, { enableHighAccuracy: true, timeout: 10000 });
});

// Sinkron input lat/lng manual
['lat_input','lng_input'].forEach(id => {
 document.getElementById(id).addEventListener('change', function () {
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
 html: '<div style="width:28px;height:28px;background:#d97706;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,.4);"></div>',
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
 color: '#d97706',
 fillColor: '#fbbf24',
 fillOpacity: 0.25,
 weight: 2.5,
 },
 showArea: true,
 metric: true,
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
 document.getElementById('clear_geometry').value = '1';
 document.getElementById('gis_info').style.display = 'none';
 document.getElementById('btn_clear_draw').disabled = true;
 setStatus('Polygon dihapus. Simpan form untuk menghapus dari database.', 'info');
}

function setStatus(msg, type) {
 const bar = document.getElementById('gis_statusbar');
 const txt = document.getElementById('status_text');
 txt.innerHTML = msg;
 bar.style.background = type === 'error' ? '#fef2f2' : type === 'success' ? '#f0fdf4' : type === 'drawing' ? '#eff6ff' : '#f0fdf4';
 bar.style.color = type === 'error' ? '#b91c1c' : type === 'success' ? '#065f46' : type === 'drawing' ? '#1d4ed8' : '#065f46';
}

function resetLocBtn(btn) {
 btn.disabled = false;
 btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg> Saya';
}

function getCentroid(coords) {
 let latSum = 0, lngSum = 0;
 const n = coords.length;
 coords.forEach(c => { lngSum += c[0]; latSum += c[1]; });
 return { lat: latSum / n, lng: lngSum / n };
}

function turf_area(geojson) {
 const coords = geojson.coordinates[0];
 const R = 6371000;
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

<script>
// ============================================================
// FOTO KOLAM — Preview, Validasi & Toggle Hapus
// ============================================================
function previewFotoKolam(input) {
 const maxSize = 2 * 1024 * 1024;
 const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
 const file = input.files[0];

 if (!file) { resetFotoPreview(); return; }

 if (!allowedTypes.includes(file.type)) {
  alert('Format file tidak didukung. Gunakan JPG, JPEG, atau PNG.');
  input.value = '';
  resetFotoPreview();
  return;
 }

 if (file.size > maxSize) {
  alert('Ukuran file terlalu besar. Maksimal 2 MB.');
  input.value = '';
  resetFotoPreview();
  return;
 }

 const reader = new FileReader();
 reader.onload = function(e) {
  document.getElementById('foto_preview').src = e.target.result;
  document.getElementById('foto_preview_wrap').style.display = 'block';
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
}

function toggleHapusFoto(chk) {
 const wrap = document.getElementById('foto_lama_wrap');
 if (!wrap) return;
 const img = document.getElementById('foto_lama_img');
 if (chk.checked) {
  img.style.opacity = '0.3';
  img.style.filter = 'grayscale(100%)';
 } else {
  img.style.opacity = '1';
  img.style.filter = 'none';
 }
}
</script>
@endsection
