<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>SIBUDI — Sistem Informasi Budidaya Ikan Air Tawar</title>
 <meta name="description" content="Sistem Informasi Budidaya Ikan Air Tawar (SIBUDI) — Platform digital pengelolaan data pembudidaya, kolam, dan hasil panen ikan air tawar di Riau dengan peta GIS interaktif.">
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
 <style>
 *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
 html { scroll-behavior: smooth; }
 body { font-family: 'Inter', sans-serif; background: #0f1117; color: #e2e8f0; overflow-x: hidden; }

 /* ===== NAVBAR ===== */
 nav {
 position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
 padding: 16px 5%;
 display: flex; align-items: center;
 background: rgba(15,17,23,0.92); backdrop-filter: blur(20px);
 border-bottom: 1px solid rgba(255,255,255,.06);
 transition: all .3s;
 }
 .nav-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
 .nav-logo .icon { width: 42px; height: 42px; background: linear-gradient(135deg, #16a34a, #22c55e); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4em; box-shadow: 0 4px 14px rgba(34,197,94,.3); }
 .nav-logo .brand { font-size: .9em; font-weight: 800; color: #86efac; letter-spacing: .5px; }
 .nav-logo .sub { font-size: .65em; color: rgba(255,255,255,.45); }
 .nav-links { display: flex; align-items: center; gap: 6px; margin-left: auto; }
 .nav-links a { color: rgba(255,255,255,.65); text-decoration: none; padding: 8px 16px; border-radius: 10px; font-size: .85em; font-weight: 500; transition: all .2s; }
 .nav-links a:hover { background: rgba(255,255,255,.08); color: white; }
 .nav-cta { background: linear-gradient(135deg, #16a34a, #15803d) !important; color: white !important; font-weight: 700 !important; box-shadow: 0 4px 14px rgba(34,197,94,.3); }

 /* ===== HERO ===== */
 .hero {
 min-height: 100vh;
 background: radial-gradient(ellipse at 20% 50%, rgba(22,163,74,.12) 0%, transparent 50%),
 radial-gradient(ellipse at 80% 20%, rgba(29,78,216,.12) 0%, transparent 50%),
 linear-gradient(180deg, #0f1117 0%, #0a0e18 100%);
 display: flex; align-items: center; justify-content: center;
 padding: 120px 5% 80px;
 position: relative; overflow: hidden;
 }

 /* Animated particles */
 .hero::before {
 content: ''; position: absolute; inset: 0;
 background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 400 400'%3E%3Ccircle cx='200' cy='200' r='1' fill='%2322c55e' fill-opacity='.15'/%3E%3C/svg%3E") repeat;
 animation: particles 30s linear infinite;
 opacity: .6;
 }
 @keyframes particles { 0% { background-position: 0 0; } 100% { background-position: 400px 400px; } }

 .hero-content { text-align: center; max-width: 860px; position: relative; z-index: 1; }

 .hero-badge {
 display: inline-flex; align-items: center; gap: 8px;
 background: rgba(22,163,74,.12); border: 1px solid rgba(22,163,74,.25);
 color: #86efac; padding: 6px 18px; border-radius: 20px; font-size: .8em; font-weight: 600;
 margin-bottom: 24px; letter-spacing: .5px;
 }

 .hero h1 {
 font-size: clamp(2.4em, 6vw, 4.2em); font-weight: 900; line-height: 1.08; margin-bottom: 16px;
 background: linear-gradient(135deg, #ffffff 0%, #86efac 50%, #60a5fa 100%);
 -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
 }

 .hero p {
 font-size: clamp(.92em, 1.5vw, 1.1em); color: rgba(255,255,255,.55); margin-bottom: 40px; line-height: 1.75; max-width: 620px; margin-left: auto; margin-right: auto;
 }

 .hero-ctas { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; margin-bottom: 56px; }
 .btn-primary {
 background: linear-gradient(135deg, #16a34a, #15803d); color: white;
 padding: 16px 36px; border-radius: 14px; text-decoration: none; font-weight: 700; font-size: 1em;
 box-shadow: 0 8px 24px rgba(22,163,74,.35); transition: all .2s; display: flex; align-items: center; gap: 8px;
 }
 .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(22,163,74,.45); }
 .btn-secondary {
 background: rgba(255,255,255,.08); color: white; border: 1px solid rgba(255,255,255,.12);
 padding: 16px 36px; border-radius: 14px; text-decoration: none; font-weight: 600; font-size: 1em;
 transition: all .2s; display: flex; align-items: center; gap: 8px; backdrop-filter: blur(8px);
 }
 .btn-secondary:hover { background: rgba(255,255,255,.12); transform: translateY(-2px); }

 /* Stats Row */
 .hero-stats {
 display: flex; gap: 40px; justify-content: center; flex-wrap: wrap;
 }
 .stat { text-align: center; }
 .stat .val { font-size: 2.2em; font-weight: 900; background: linear-gradient(135deg, #22c55e, #86efac); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
 .stat .lbl { font-size: .78em; color: rgba(255,255,255,.45); margin-top: 2px; }
 .stat-divider { width: 1px; background: rgba(255,255,255,.08); }

 /* ===== FEATURES ===== */
 .section { padding: 90px 5%; }
 .section-label { font-size: .78em; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #22c55e; margin-bottom: 12px; text-align: center; }
 .section-title { font-size: clamp(1.6em, 3.5vw, 2.4em); font-weight: 800; text-align: center; color: white; margin-bottom: 14px; }
 .section-sub { text-align: center; color: rgba(255,255,255,.45); font-size: .9em; max-width: 560px; margin: 0 auto 52px; line-height: 1.7; }

 .features-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; max-width: 1100px; margin: 0 auto; }
 .feature-card {
 background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.07);
 border-radius: 20px; padding: 28px; transition: all .3s;
 }
 .feature-card:hover { background: rgba(255,255,255,.07); border-color: rgba(22,163,74,.25); transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,.3); }
 .feature-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5em; margin-bottom: 16px; }
 .feature-title { font-size: 1em; font-weight: 700; color: white; margin-bottom: 8px; }
 .feature-desc { font-size: .84em; color: rgba(255,255,255,.45); line-height: 1.65; }

 /* ===== GIS PREVIEW ===== */
 .gis-section {
 background: rgba(255,255,255,.02);
 border-top: 1px solid rgba(255,255,255,.05);
 border-bottom: 1px solid rgba(255,255,255,.05);
 }
 .gis-inner { max-width: 1100px; margin: 0 auto; display: flex; gap: 52px; align-items: center; flex-wrap: wrap; }
 .gis-text { flex: 1; min-width: 300px; }
 .gis-map-preview { flex: 1; min-width: 300px; border-radius: 20px; overflow: hidden; border: 1px solid rgba(255,255,255,.1); box-shadow: 0 20px 60px rgba(0,0,0,.5); height: 350px; }

 /* ===== RECENT PANEN ===== */
 .panen-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px,1fr)); gap: 16px; max-width: 1100px; margin: 0 auto; }
 .panen-card {
 background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.07);
 border-radius: 16px; padding: 20px; transition: all .2s;
 }
 .panen-card:hover { background: rgba(255,255,255,.07); }

 /* ===== PEMBUDIDAYA ===== */
 .pb-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px,1fr)); gap: 16px; max-width: 1100px; margin: 0 auto; }
 .pb-card {
 background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.07);
 border-radius: 16px; padding: 18px; display: flex; gap: 14px; align-items: center; transition: all .2s;
 }
 .pb-card:hover { background: rgba(255,255,255,.07); border-color: rgba(22,163,74,.2); }
 .pb-avatar { width: 48px; height: 48px; background: linear-gradient(135deg, #14532d, #16a34a); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4em; flex-shrink: 0; }

 /* ===== CTA SECTION ===== */
 .cta-section {
 padding: 90px 5%; text-align: center;
 background: radial-gradient(ellipse at 50% 50%, rgba(22,163,74,.08) 0%, transparent 70%);
 }

 /* ===== FOOTER ===== */
 footer {
 padding: 32px 5%; text-align: center;
 border-top: 1px solid rgba(255,255,255,.06);
 color: rgba(255,255,255,.3); font-size: .82em;
 }

 /* ===== RESPONSIVE ===== */
 @media (max-width: 768px) {
 .hero-stats { gap: 24px; }
 .stat-divider { display: none; }
 .gis-inner { flex-direction: column; }
 }
 </style>
</head>
<body>

<!-- Navbar -->
<nav>
 <a href="{{ route('landing') }}" class="nav-logo">
 <div class="icon"></div>
 <div>
 <div class="brand">SIBUDI</div>
 <div class="sub">Budidaya Ikan Air Tawar</div>
 </div>
 </a>
 <div class="nav-links">
 <a href="{{ route('public.peta') }}"> Peta GIS</a>
 <a href="{{ route('public.cari') }}"> Pencarian</a>
 <a href="{{ route('login') }}" class="nav-cta"> Login Admin</a>
 </div>
</nav>

<!-- Hero -->
<section class="hero">
 <div class="hero-content">
 <div class="hero-badge"> Sistem Informasi Resmi · Provinsi Riau</div>
 <h1>Sistem Informasi<br>Budidaya Ikan Air Tawar</h1>
 <p>Platform digital terpadu untuk pengelolaan data pembudidaya, kolam, jenis ikan, dan hasil panen — dilengkapi <strong style="color:#86efac;">Peta GIS Interaktif</strong> untuk visualisasi sebaran kolam di seluruh wilayah Riau.</p>

 <div class="hero-ctas">
 <a href="{{ route('public.peta') }}" class="btn-primary"> Buka Peta GIS Interaktif</a>
 <a href="{{ route('public.cari') }}" class="btn-secondary"> Cari Data</a>
 </div>

 <div class="hero-stats">
 <div class="stat">
 <div class="val">{{ $totalPembudidaya }}</div>
 <div class="lbl">Pembudidaya Aktif</div>
 </div>
 <div class="stat-divider"></div>
 <div class="stat">
 <div class="val">{{ $totalKolam }}</div>
 <div class="lbl">Kolam Terdaftar</div>
 </div>
 <div class="stat-divider"></div>
 <div class="stat">
 <div class="val">{{ $totalJenisIkan }}</div>
 <div class="lbl">Jenis Ikan</div>
 </div>
 <div class="stat-divider"></div>
 <div class="stat">
 <div class="val">{{ number_format($totalPanenKg/1000, 1) }}t</div>
 <div class="lbl">Ton Total Panen</div>
 </div>
 </div>
 </div>
</section>

<!-- Features -->
<section class="section">
 <div class="section-label"> Fitur Utama</div>
 <h2 class="section-title">Semua yang Anda Butuhkan</h2>
 <p class="section-sub">Platform lengkap untuk memantau dan mengelola data budidaya ikan air tawar secara digital dan akurat.</p>

 <div class="features-grid">
 <div class="feature-card">
 <div class="feature-icon" style="background: linear-gradient(135deg,#14532d,#16a34a);"></div>
 <div class="feature-title">Data Pembudidaya</div>
 <div class="feature-desc">Kelola data lengkap pembudidaya ikan: NIK, alamat, nomor HP, dan kolam yang dimiliki.</div>
 </div>
 <div class="feature-card">
 <div class="feature-icon" style="background: linear-gradient(135deg,#1d4ed8,#2563eb);"></div>
 <div class="feature-title">Data Kolam</div>
 <div class="feature-desc">Catat data kolam: jenis, luas, kedalaman, dan koordinat GPS untuk peta GIS.</div>
 </div>
 <div class="feature-card">
 <div class="feature-icon" style="background: linear-gradient(135deg,#0891b2,#06b6d4);"></div>
 <div class="feature-title">Data Jenis Ikan</div>
 <div class="feature-desc">Katalog jenis ikan budidaya: lele, nila, patin, baung, gurame, dan lainnya.</div>
 </div>
 <div class="feature-card">
 <div class="feature-icon" style="background: linear-gradient(135deg,#b45309,#d97706);"></div>
 <div class="feature-title">Data Hasil Panen</div>
 <div class="feature-desc">Rekam dan pantau hasil panen: bobot, jumlah ekor, harga, dan total pendapatan.</div>
 </div>
 <div class="feature-card">
 <div class="feature-icon" style="background: linear-gradient(135deg,#7c3aed,#8b5cf6);"></div>
 <div class="feature-title">Peta GIS Interaktif</div>
 <div class="feature-desc">Visualisasi sebaran kolam di peta OpenStreetMap dengan marker berwarna dan informasi lengkap.</div>
 </div>
 <div class="feature-card">
 <div class="feature-icon" style="background: linear-gradient(135deg,#dc2626,#ef4444);"></div>
 <div class="feature-title">Pencarian Data</div>
 <div class="feature-desc">Cari data pembudidaya, kolam, atau jenis ikan dengan cepat dan akurat.</div>
 </div>
 </div>
</section>

<!-- GIS Preview -->
<section class="section gis-section">
 <div class="gis-inner">
 <div class="gis-text">
 <div class="section-label" style="text-align:left;"> Peta GIS</div>
 <h2 style="font-size:clamp(1.6em,3vw,2.2em);font-weight:800;color:white;margin-bottom:14px;">Lihat Sebaran Kolam<br>di Seluruh Riau</h2>
 <p style="color:rgba(255,255,255,.5);font-size:.88em;line-height:1.75;margin-bottom:24px;">Peta interaktif berbasis <strong style="color:#86efac;">Leaflet.js & OpenStreetMap</strong> menampilkan lokasi semua kolam budidaya. Klik marker untuk melihat detail kolam, pembudidaya, dan data produksi ikan.</p>
 <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:28px;">
 @foreach([' Marker berwarna sesuai status kolam (aktif/perbaikan/tidak aktif)',' Filter berdasarkan jenis kolam atau jenis ikan',' Informasi lengkap saat marker diklik',' Tampilan satelit dan peta jalan'] as $feat)
 <div style="display:flex;align-items:center;gap:10px;font-size:.85em;color:rgba(255,255,255,.7);">
 <div style="width:8px;height:8px;background:#22c55e;border-radius:50%;flex-shrink:0;"></div>
 {{ $feat }}
 </div>
 @endforeach
 </div>
 <a href="{{ route('public.peta') }}" class="btn-primary" style="display:inline-flex;"> Buka Peta GIS →</a>
 </div>

 <div class="gis-map-preview">
 <iframe
 src="{{ route('public.peta') }}"
 style="width:100%;height:100%;border:none;"
 loading="lazy"
 title="Preview Peta GIS Kolam">
 </iframe>
 </div>
 </div>
</section>

<!-- Recent Panen -->
@if($recentPanen->isNotEmpty())
<section class="section">
 <div class="section-label"> Terbaru</div>
 <h2 class="section-title">Panen Terkini</h2>
 <p class="section-sub">Data hasil panen ikan terbaru dari para pembudidaya di Riau.</p>

 <div class="panen-grid">
 @foreach($recentPanen as $hp)
 <div class="panen-card">
 <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
 <div style="width:38px;height:38px;background:linear-gradient(135deg,#b45309,#d97706);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1em;flex-shrink:0;"></div>
 <div>
 <div style="font-weight:700;font-size:.9em;color:white;">{{ $hp->jenisIkan->nama_ikan ?? '-' }}</div>
 <div style="font-size:.74em;color:rgba(255,255,255,.4);">{{ $hp->kolam->nama_kolam ?? '-' }}</div>
 </div>
 </div>
  <div style="display:flex;justify-content:space-between;align-items:center;">
  <div>
  <div style="font-size:1.2em;font-weight:800;color:#22c55e;">{{ number_format($hp->total_panen_kg, 1) }} kg</div>
  <div style="font-size:.74em;color:rgba(255,255,255,.4);">{{ $hp->tanggal_panen->format('d M Y') }}</div>
  </div>
  <div style="text-align:right;">
  <div style="font-size:.74em;color:rgba(255,255,255,.6);">{{ $hp->kolam->pembudidaya->nama ?? '' }}</div>
  </div>
  </div>
 </div>
 @endforeach
 </div>
</section>
@endif

<!-- Top Pembudidaya -->
@if($topPembudidaya->isNotEmpty())
<section class="section" style="padding-top:0;">
 <div class="section-label"> Pembudidaya</div>
 <h2 class="section-title">Pembudidaya Aktif</h2>

 <div class="pb-grid">
 @foreach($topPembudidaya as $pb)
 <div class="pb-card">
 <div class="pb-avatar">{{ $pb->jenis_kelamin == 'L' ? '' : '' }}</div>
 <div>
 <div style="font-weight:700;font-size:.9em;color:white;">{{ $pb->nama }}</div>
 <div style="font-size:.76em;color:rgba(255,255,255,.4);">{{ Str::limit($pb->alamat, 40) }}</div>
 <div style="margin-top:5px;"><span style="background:rgba(34,197,94,.15);color:#86efac;padding:2px 10px;border-radius:20px;font-size:.74em;font-weight:600;"> {{ $pb->kolam_count }} kolam</span></div>
 </div>
 </div>
 @endforeach
 </div>
</section>
@endif

<!-- CTA -->
<section class="cta-section">
 <div class="hero-badge" style="margin-bottom:24px;"> Mulai Sekarang</div>
 <h2 style="font-size:clamp(1.8em,4vw,3em);font-weight:900;color:white;margin-bottom:16px;">Jelajahi Data Budidaya Ikan<br>di Riau Sekarang</h2>
 <p style="color:rgba(255,255,255,.45);margin-bottom:36px;font-size:.9em;">Akses peta GIS interaktif, cari data pembudidaya dan kolam, atau login sebagai admin untuk mengelola data.</p>
 <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
 <a href="{{ route('public.peta') }}" class="btn-primary"> Peta GIS Interaktif</a>
 <a href="{{ route('public.cari') }}" class="btn-secondary"> Cari Data</a>
 <a href="{{ route('login') }}" class="btn-secondary" style="border-color:rgba(22,163,74,.3);"> Login Admin</a>
 </div>
</section>

<!-- Footer -->
<footer>
 <div style="margin-bottom:8px;font-size:1.1em;"></div>
 <strong style="color:rgba(255,255,255,.5);">SIBUDI</strong> — Sistem Informasi Budidaya Ikan Air Tawar · Riau<br>
 <span style="font-size:.9em;">Data bersumber dari Dinas Perikanan dan Kelautan Provinsi Riau</span>
</footer>

</body>
</html>
