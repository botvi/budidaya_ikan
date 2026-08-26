@extends('template-admin.layout')
@section('title', 'Detail Kolam')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item"><a href="{{ route('kolam.index') }}">Kolam</a></li>
 <li class="breadcrumb-item active">Detail</li>
 </ul>
 </div>
 <div class="col-md-12 d-flex align-items-center justify-content-between gap-2 flex-wrap">
 <h2 class="mb-0" style="color:#14532d;font-weight:800;"> {{ $kolam->nama_kolam }}</h2>
 <div class="d-flex gap-2">
 <a href="{{ route('kolam.edit', $kolam) }}" class="btn" style="background:#fef3c7;color:#b45309;border-radius:10px;padding:8px 20px;font-weight:600;"> Edit</a>
 <a href="{{ route('kolam.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;padding:8px 20px;">← Kembali</a>
 </div>
 </div>
 </div>
 </div>
 </div>

 <div class="row g-4">
 <!-- Info Kolam -->
 <div class="col-md-5">
 <div class="card" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:linear-gradient(135deg,#1d4ed8,#2563eb);border-radius:20px 20px 0 0;padding:24px;">
 <div style="font-size:3em;text-align:center;"></div>
 <h4 style="color:white;margin:8px 0 4px;font-weight:800;text-align:center;">{{ $kolam->nama_kolam }}</h4>
 <div style="text-align:center;">
 @php $sc = $kolam->status_kolam == 'aktif' ? '#dcfce7:#15803d' : ($kolam->status_kolam == 'perbaikan' ? '#fef3c7:#b45309' : '#fee2e2:#dc2626');
 [$sbg,$stx] = explode(':', $sc); @endphp
 <span style="background:{{ $sbg }};color:{{ $stx }};padding:4px 16px;border-radius:20px;font-size:.82em;font-weight:700;">{{ $kolam->status_label }}</span>
 </div>
 </div>
 <div class="card-body p-4">
 <table style="width:100%;font-size:.88em;">
 <tr><td style="color:#9ca3af;padding:7px 0;width:38%;">Pembudidaya</td><td style="font-weight:600;color:#374151;">{{ $kolam->pembudidaya->nama ?? '-' }}</td></tr>
 <tr><td style="color:#9ca3af;padding:7px 0;">Jenis Kolam</td><td style="font-weight:600;color:#374151;">{{ ucfirst($kolam->jenis_kolam) }}</td></tr>
 <tr><td style="color:#9ca3af;padding:7px 0;">Luas</td><td style="font-weight:600;color:#374151;">{{ $kolam->luas_m2 ? $kolam->luas_m2.' m²' : '-' }}</td></tr>
 <tr><td style="color:#9ca3af;padding:7px 0;">Kedalaman</td><td style="font-weight:600;color:#374151;">{{ $kolam->kedalaman_m ? $kolam->kedalaman_m.' m' : '-' }}</td></tr>
 <tr><td style="color:#9ca3af;padding:7px 0;">Alamat</td><td style="font-weight:500;color:#374151;">{{ $kolam->alamat_kolam }}</td></tr>
 <tr><td style="color:#9ca3af;padding:7px 0;">Koordinat</td><td style="font-family:monospace;font-size:.82em;color:#374151;">
 @if($kolam->hasCoordinates())
 {{ $kolam->latitude }}, {{ $kolam->longitude }}
 @else <span style="color:#dc2626;">Belum ada</span> @endif
 </td></tr>
 <tr><td style="color:#9ca3af;padding:7px 0;">Foto</td><td>
  @if($kolam->foto_kolam)
  <div style="margin-top:4px;">
   <a href="{{ asset($kolam->foto_kolam) }}" target="_blank" title="Lihat foto ukuran penuh">
    <img src="{{ asset($kolam->foto_kolam) }}" alt="Foto Kolam"
     style="max-width:100%;max-height:200px;border-radius:10px;border:2px solid #bfdbfe;object-fit:cover;cursor:pointer;transition:transform .2s;"
     onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
   </a>
   <div style="font-size:.72em;color:#9ca3af;margin-top:4px;">Klik foto untuk lihat ukuran penuh</div>
  </div>
  @else
  <div style="background:#f9fafb;border:1px dashed #d1d5db;border-radius:8px;padding:14px;text-align:center;color:#9ca3af;font-size:.8em;margin-top:4px;">
   <i class="ti ti-camera" style="font-size:1.5em;display:block;margin-bottom:4px;"></i>
   Belum ada foto
  </div>
  @endif
 </td></tr>
 </table>

 @if($kolam->hasCoordinates())
 <div id="detail_map" style="height:200px;border-radius:12px;margin-top:14px;border:2px solid #bfdbfe;"></div>
 @endif
 </div>
 </div>

 <!-- Stats -->
 <div class="row g-3 mt-1">
 <div class="col-12">
 <div class="card" style="border-radius:14px;border:none;background:linear-gradient(135deg,#d1fae5,#a7f3d0);text-align:center;padding:14px;">
 <div style="font-size:1.6em;font-weight:800;color:#15803d;">{{ number_format($kolam->total_panen_kg, 0) }}</div>
 <div style="font-size:.76em;color:#065f46;">kg Total Panen</div>
 </div>
 </div>
 </div>
 </div>

 <!-- Ikan & Panen -->
 <div class="col-md-7">
 <!-- Ikan Kolam -->
 <div class="card mb-4" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:transparent;border-bottom:1px solid #f0f0f0;padding:18px 24px;display:flex;align-items:center;justify-content-between;">
 <h5 style="margin:0;font-weight:700;color:#1a1a2e;"> Ikan di Kolam ini ({{ $kolam->ikanKolam->count() }})</h5>
 </div>
 <div class="card-body p-3">
 @forelse($kolam->ikanKolam as $ik)
 <div style="background:#f9fafb;border-radius:12px;padding:12px;margin-bottom:8px;display:flex;gap:12px;align-items:center;">
 <div style="width:36px;height:36px;background:#dbeafe;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1em;flex-shrink:0;"></div>
 <div style="flex:1;">
 <div style="font-weight:600;color:#1a1a2e;">{{ $ik->jenisIkan->nama_ikan ?? '-' }}</div>
 <div style="font-size:.78em;color:#6b7280;">{{ number_format($ik->jumlah_benih) }} ekor benih • Tebar: {{ $ik->tanggal_tebar?->format('d M Y') }}</div>
 </div>
 <span style="background:{{ $ik->status == 'aktif' ? '#dcfce7' : ($ik->status == 'panen' ? '#dbeafe' : '#fee2e2') }};color:{{ $ik->status == 'aktif' ? '#15803d' : ($ik->status == 'panen' ? '#1d4ed8' : '#dc2626') }};padding:3px 10px;border-radius:20px;font-size:.76em;font-weight:600;">{{ ucfirst($ik->status) }}</span>
 </div>
 @empty
 <div class="text-center py-3" style="color:#9ca3af;">Belum ada ikan di kolam ini.</div>
 @endforelse
 </div>
 </div>

 <!-- Hasil Panen -->
 <div class="card" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:transparent;border-bottom:1px solid #f0f0f0;padding:18px 24px;display:flex;align-items:center;justify-content-between;">
 <h5 style="margin:0;font-weight:700;color:#1a1a2e;"> Riwayat Panen ({{ $kolam->hasilPanen->count() }})</h5>
 <a href="{{ route('hasil-panen.create') }}" style="background:#fffbeb;color:#b45309;padding:6px 14px;border-radius:8px;font-size:.82em;font-weight:600;text-decoration:none;">+ Input Panen</a>
 </div>
 <div class="card-body p-3">
 @forelse($kolam->hasilPanen->sortByDesc('tanggal_panen') as $hp)
 <div style="background:#fffbeb;border-radius:12px;padding:12px;margin-bottom:8px;display:flex;gap:12px;align-items:center;">
 <div style="width:36px;height:36px;background:#fde68a;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1em;flex-shrink:0;"></div>
 <div style="flex:1;">
 <div style="font-weight:600;color:#1a1a2e;">{{ $hp->jenisIkan->nama_ikan ?? '-' }} — {{ number_format($hp->total_panen_kg) }} kg</div>
 <div style="font-size:.78em;color:#6b7280;">{{ $hp->tanggal_panen->format('d M Y') }}</div>
 </div>
 </div>
 @empty
 <div class="text-center py-3" style="color:#9ca3af;">Belum ada catatan panen.</div>
 @endforelse
 </div>
 </div>
 </div>
 </div>
</div>

@if($kolam->hasCoordinates())
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const m = L.map('detail_map').setView([{{ $kolam->latitude }}, {{ $kolam->longitude }}], 15);

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
 layerGoogleHybrid.addTo(m);
 L.control.layers({
     'Google Hybrid (Default)': layerGoogleHybrid,
     'Google Satelit'          : layerGoogleSatelit,
     'Google Jalan'            : layerGoogleJalan,
     'OpenStreetMap'           : layerOSM,
     'Esri Satelit'            : layerEsri,
 }, {}, { position: 'topright', collapsed: true }).addTo(m);

@if($kolam->hasGeometry())
// Render polygon batas kolam
const poly = L.geoJSON({type:'Feature',geometry:{!! json_encode($kolam->geometry) !!}}, {
    style: {color:'#2563eb',fillColor:'#3b82f6',fillOpacity:0.2,weight:2.5}
}).addTo(m);
m.fitBounds(poly.getBounds(), {padding:[30,30]});
@endif

L.marker([{{ $kolam->latitude }}, {{ $kolam->longitude }}])
 .addTo(m)
 .bindPopup('<b>{{ $kolam->nama_kolam }}</b><br>{{ $kolam->alamat_kolam }}')
 .openPopup();
</script>
@endif
@endsection
