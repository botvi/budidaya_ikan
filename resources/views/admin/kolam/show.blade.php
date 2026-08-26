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
                <div class="card-header" style="background:transparent;border-bottom:1px solid #f0f0f0;padding:18px 24px;display:flex;align-items:center;justify-content:space-between;">
                    <h5 style="margin:0;font-weight:700;color:#1a1a2e;">🐟 Ikan di Kolam ini ({{ $kolam->ikanKolam->count() }})</h5>
                    <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahIkan" style="background:#dbeafe;color:#1d4ed8;padding:6px 14px;border-radius:8px;font-size:.82em;font-weight:600;border:none;">
                        + Tebar Ikan
                    </button>
                </div>
                <div class="card-body p-3">
                    @forelse($kolam->ikanKolam as $ik)
                    <div style="background:#f9fafb;border-radius:12px;padding:12px;margin-bottom:8px;display:flex;gap:12px;align-items:center;">
                        <div style="width:40px;height:40px;background:#dbeafe;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2em;flex-shrink:0;">🐟</div>
                        <div style="flex:1;">
                            <div class="d-flex align-items-center gap-2">
                                <span style="font-weight:700;color:#1a1a2e;font-size:.95em;">{{ $ik->jenisIkan->nama_ikan ?? '-' }}</span>
                                <span style="background:{{ $ik->status == 'aktif' ? '#dcfce7' : ($ik->status == 'panen' ? '#dbeafe' : '#fee2e2') }};color:{{ $ik->status == 'aktif' ? '#15803d' : ($ik->status == 'panen' ? '#1d4ed8' : '#dc2626') }};padding:2px 10px;border-radius:20px;font-size:.72em;font-weight:700;text-transform:uppercase;">
                                    {{ $ik->status == 'panen' ? 'Panen' : ($ik->status == 'aktif' ? 'Aktif' : 'Gagal') }}
                                </span>
                            </div>
                            <div style="font-size:.78em;color:#6b7280;margin-top:2px;">
                                <strong>{{ number_format($ik->jumlah_benih) }}</strong> ekor benih &bull; Tebar: {{ $ik->tanggal_tebar?->format('d M Y') ?? '-' }}
                            </div>
                            @if($ik->catatan)
                            <div style="font-size:.74em;color:#4b5563;margin-top:3px;background:#f3f4f6;padding:3px 8px;border-radius:6px;display:inline-block;">
                                💬 {{ $ik->catatan }}
                            </div>
                            @endif
                        </div>
                        <div class="d-flex gap-1">
                            <button type="button" class="btn btn-sm" onclick="editIkan(this)"
                                data-id="{{ $ik->id }}"
                                data-jenis="{{ $ik->jenis_ikan_id }}"
                                data-jumlah="{{ $ik->jumlah_benih }}"
                                data-tanggal="{{ $ik->tanggal_tebar?->format('Y-m-d') ?? '' }}"
                                data-status="{{ $ik->status }}"
                                data-catatan="{{ $ik->catatan }}"
                                style="background:#fef3c7;color:#b45309;border-radius:8px;padding:4px 9px;" title="Edit Data Ikan">
                                ✏️
                            </button>
                            <form action="{{ route('ikan-kolam.destroy', $ik) }}" method="POST" onsubmit="return confirm('Hapus data ikan ini dari kolam?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:4px 9px;border:none;" title="Hapus Data Ikan">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4" style="color:#9ca3af;">
                        <div style="font-size:2em;margin-bottom:6px;">🐟</div>
                        Belum ada data ikan di kolam ini.<br>
                        <button type="button" class="btn btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#modalTambahIkan" style="background:#2563eb;color:white;border-radius:8px;font-size:.8em;">
                            + Tebar Benih Ikan
                        </button>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Hasil Panen -->
            <div class="card" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
                <div class="card-header" style="background:transparent;border-bottom:1px solid #f0f0f0;padding:18px 24px;display:flex;align-items:center;justify-content:space-between;">
                    <h5 style="margin:0;font-weight:700;color:#1a1a2e;"> Riwayat Panen ({{ $kolam->hasilPanen->count() }})</h5>
                    <a href="{{ route('hasil-panen.create') }}" style="background:#fffbeb;color:#b45309;padding:6px 14px;border-radius:8px;font-size:.82em;font-weight:600;text-decoration:none;">+ Input Panen</a>
                </div>
                <div class="card-body p-3">
                    @forelse($kolam->hasilPanen->sortByDesc('tanggal_panen') as $hp)
                    <div style="background:#fffbeb;border-radius:12px;padding:12px;margin-bottom:8px;display:flex;gap:12px;align-items:center;">
                        <div style="width:36px;height:36px;background:#fde68a;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1em;flex-shrink:0;">🌾</div>
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

<!-- Modal Tambah Ikan Kolam -->
<div class="modal fade" id="modalTambahIkan" tabindex="-1" aria-labelledby="modalTambahIkanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;box-shadow:0 10px 30px rgba(0,0,0,0.15);">
            <form action="{{ route('ikan-kolam.store') }}" method="POST">
                @csrf
                <input type="hidden" name="kolam_id" value="{{ $kolam->id }}">
                <div class="modal-header" style="border-bottom:1px solid #f1f5f9;padding:16px 20px;">
                    <h5 class="modal-title fw-bold" id="modalTambahIkanLabel" style="color:#1e293b;font-size:1.05em;">
                        🐟 Tambah / Tebar Ikan ke Kolam
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:.85em;">Jenis Ikan <span class="text-danger">*</span></label>
                        <select name="jenis_ikan_id" class="form-select" style="border-radius:8px;" required>
                            <option value="">-- Pilih Jenis Ikan --</option>
                            @foreach($jenisIkanList ?? [] as $ikan)
                                <option value="{{ $ikan->id }}">{{ $ikan->nama_ikan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.85em;">Jumlah Benih (Ekor) <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_benih" class="form-control" placeholder="Contoh: 1000" min="1" required style="border-radius:8px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.85em;">Tanggal Tebar <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_tebar" value="{{ date('Y-m-d') }}" class="form-control" required style="border-radius:8px;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:.85em;">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" style="border-radius:8px;" required>
                            <option value="aktif" selected>Aktif (Sedang dibudidaya)</option>
                            <option value="panen">Panen (Sudah dipanen)</option>
                            <option value="gagal">Gagal (Mati / Penyakit / Cuaca)</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-semibold" style="font-size:.85em;">Catatan (Opsional)</label>
                        <textarea name="catatan" rows="2" class="form-control" placeholder="Contoh: Benih ukuran 6 cm, kondisi sehat" style="border-radius:8px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #f1f5f9;padding:12px 20px;">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="border-radius:8px;">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm" style="border-radius:8px;background:#2563eb;">Simpan Data Ikan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Ikan Kolam -->
<div class="modal fade" id="modalEditIkan" tabindex="-1" aria-labelledby="modalEditIkanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;box-shadow:0 10px 30px rgba(0,0,0,0.15);">
            <form id="formEditIkan" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header" style="border-bottom:1px solid #f1f5f9;padding:16px 20px;">
                    <h5 class="modal-title fw-bold" id="modalEditIkanLabel" style="color:#1e293b;font-size:1.05em;">
                        ✏️ Edit Data Ikan Kolam
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:.85em;">Jenis Ikan <span class="text-danger">*</span></label>
                        <select name="jenis_ikan_id" id="edit_jenis_ikan_id" class="form-select" style="border-radius:8px;" required>
                            <option value="">-- Pilih Jenis Ikan --</option>
                            @foreach($jenisIkanList ?? [] as $ikan)
                                <option value="{{ $ikan->id }}">{{ $ikan->nama_ikan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.85em;">Jumlah Benih (Ekor) <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_benih" id="edit_jumlah_benih" class="form-control" min="0" required style="border-radius:8px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:.85em;">Tanggal Tebar <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_tebar" id="edit_tanggal_tebar" class="form-control" required style="border-radius:8px;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:.85em;">Status <span class="text-danger">*</span></label>
                        <select name="status" id="edit_status" class="form-select" style="border-radius:8px;" required>
                            <option value="aktif">Aktif (Sedang dibudidaya)</option>
                            <option value="panen">Panen (Sudah dipanen)</option>
                            <option value="gagal">Gagal (Mati / Penyakit / Cuaca)</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-semibold" style="font-size:.85em;">Catatan (Opsional)</label>
                        <textarea name="catatan" id="edit_catatan" rows="2" class="form-control" style="border-radius:8px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #f1f5f9;padding:12px 20px;">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="border-radius:8px;">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm" style="border-radius:8px;background:#2563eb;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editIkan(btn) {
    const id = btn.getAttribute('data-id');
    const jenis = btn.getAttribute('data-jenis');
    const jumlah = btn.getAttribute('data-jumlah');
    const tanggal = btn.getAttribute('data-tanggal');
    const status = btn.getAttribute('data-status');
    const catatan = btn.getAttribute('data-catatan') || '';

    const form = document.getElementById('formEditIkan');
    form.action = "{{ url('ikan-kolam') }}/" + id;

    document.getElementById('edit_jenis_ikan_id').value = jenis;
    document.getElementById('edit_jumlah_benih').value = jumlah;
    document.getElementById('edit_tanggal_tebar').value = tanggal;
    document.getElementById('edit_status').value = status;
    document.getElementById('edit_catatan').value = catatan;

    const modal = new bootstrap.Modal(document.getElementById('modalEditIkan'));
    modal.show();
}
</script>

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
