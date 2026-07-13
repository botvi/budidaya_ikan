<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Pencarian Data — SIBUDI Budidaya Ikan Air Tawar</title>
 <meta name="description" content="Cari data pembudidaya ikan, kolam budidaya, dan jenis ikan air tawar di Riau.">
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
 <style>
 *, *::before, *::after { box-sizing: border-box; }
 body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #1a1a2e; min-height: 100vh; }

 /* Navbar */
 nav {
 background: linear-gradient(135deg, #0f172a, #14532d);
 padding: 14px 32px;
 display: flex; align-items: center; gap: 16px;
 position: sticky; top: 0; z-index: 100;
 box-shadow: 0 4px 20px rgba(0,0,0,.3);
 }
 nav .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
 nav .logo .icon { width: 38px; height: 38px; background: linear-gradient(135deg, #16a34a, #22c55e); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2em; }
 nav .logo .title { font-size: .85em; font-weight: 800; color: #86efac; }
 nav .nav-links { display: flex; gap: 8px; margin-left: auto; }
 nav .nav-links a { color: rgba(255,255,255,.7); text-decoration: none; padding: 7px 14px; border-radius: 8px; font-size: .82em; font-weight: 500; transition: all .2s; }
 nav .nav-links a:hover { background: rgba(255,255,255,.1); color: white; }
 nav .nav-links a.active { background: rgba(255,255,255,.12); color: white; }

 /* Search Hero */
 .search-hero {
 background: linear-gradient(135deg, #0f172a 0%, #14532d 50%, #0f172a 100%);
 padding: 52px 32px;
 text-align: center;
 }
 .search-hero h1 { font-size: 2.2em; font-weight: 800; color: white; margin-bottom: 8px; }
 .search-hero p { color: rgba(255,255,255,.6); font-size: .9em; margin-bottom: 28px; }

 .search-box {
 max-width: 620px; margin: 0 auto;
 background: rgba(255,255,255,.08); backdrop-filter: blur(12px);
 border: 1px solid rgba(255,255,255,.15); border-radius: 16px;
 padding: 6px 6px 6px 20px;
 display: flex; gap: 8px; align-items: center;
 }
 .search-box input {
 flex: 1; background: transparent; border: none; outline: none;
 color: white; font-size: .95em; font-family: 'Inter';
 padding: 8px 0;
 }
 .search-box input::placeholder { color: rgba(255,255,255,.4); }
 .search-box button {
 background: linear-gradient(135deg, #16a34a, #15803d);
 color: white; border: none; padding: 10px 24px; border-radius: 12px;
 font-weight: 700; font-size: .9em; cursor: pointer; font-family: 'Inter';
 }

 .type-tabs {
 display: flex; gap: 8px; justify-content: center; margin-top: 14px;
 }
 .type-tab {
 background: rgba(255,255,255,.08); color: rgba(255,255,255,.7);
 border: 1px solid rgba(255,255,255,.1); border-radius: 20px;
 padding: 5px 16px; font-size: .8em; cursor: pointer; font-family: 'Inter';
 text-decoration: none; transition: all .2s;
 }
 .type-tab:hover, .type-tab.active { background: #16a34a; color: white; border-color: #16a34a; }

 /* Results */
 .container { max-width: 1100px; margin: 0 auto; padding: 32px 20px; }

 .section-title {
 font-size: 1em; font-weight: 800; color: #1a1a2e; margin-bottom: 16px;
 display: flex; align-items: center; gap: 8px;
 }
 .section-title .count { background: #dcfce7; color: #15803d; padding: 2px 10px; border-radius: 20px; font-size: .78em; }

 /* Cards */
 .results-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 14px; margin-bottom: 40px; }

 .result-card {
 background: white; border-radius: 16px; padding: 18px;
 box-shadow: 0 4px 20px rgba(0,0,0,.06); border: 1px solid #f0f0f0;
 transition: all .2s; text-decoration: none; color: inherit; display: block;
 }
 .result-card:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,.1); border-color: #bbf7d0; }

 .card-icon { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3em; margin-bottom: 12px; }
 .card-title { font-weight: 700; font-size: .92em; color: #1a1a2e; margin-bottom: 4px; }
 .card-sub { font-size: .78em; color: #6b7280; margin-bottom: 10px; }
 .card-tags { display: flex; gap: 6px; flex-wrap: wrap; }
 .tag { background: #f1f5f9; color: #475569; padding: 3px 10px; border-radius: 20px; font-size: .75em; font-weight: 500; }

 /* Empty state */
 .empty-state { text-align: center; padding: 60px 20px; }
 .empty-state .emoji { font-size: 3.5em; margin-bottom: 16px; }
 .empty-state h3 { font-size: 1.1em; color: #374151; margin-bottom: 8px; }
 .empty-state p { color: #9ca3af; font-size: .88em; }
 </style>
</head>
<body>

<nav>
 <a href="{{ route('landing') }}" class="logo">
 <div class="icon"></div>
 <div>
 <div class="title">SIBUDI</div>
 </div>
 </a>
 <div class="nav-links">
 <a href="{{ route('public.peta') }}"> Peta GIS</a>
 <a href="{{ route('public.cari') }}" class="active"> Pencarian</a>
 <a href="{{ route('login') }}" style="background:linear-gradient(135deg,#16a34a,#15803d);color:white;font-weight:600;"> Admin</a>
 </div>
</nav>

<!-- Search Hero -->
<div class="search-hero">
 <h1> Pencarian Data</h1>
 <p>Temukan data pembudidaya, kolam, dan jenis ikan budidaya air tawar di Riau</p>

 <form method="GET" action="{{ route('public.cari') }}">
 <div class="search-box">
 <span style="font-size:1.1em;"></span>
 <input type="text" name="q" value="{{ $q }}" placeholder="Ketik nama pembudidaya, nama kolam, atau jenis ikan..." autofocus>
 <button type="submit">Cari</button>
 </div>
 <div class="type-tabs">
 <a href="?q={{ $q }}&type=all" class="type-tab {{ $type == 'all' ? 'active' : '' }}"> Semua</a>
 <a href="?q={{ $q }}&type=pembudidaya" class="type-tab {{ $type == 'pembudidaya' ? 'active' : '' }}"> Pembudidaya</a>
 <a href="?q={{ $q }}&type=kolam" class="type-tab {{ $type == 'kolam' ? 'active' : '' }}"> Kolam</a>
 <a href="?q={{ $q }}&type=ikan" class="type-tab {{ $type == 'ikan' ? 'active' : '' }}"> Jenis Ikan</a>
 </div>
 </form>
</div>

<div class="container">
 @if(!$q || strlen($q) < 2)
 <div class="empty-state">
 <div class="emoji"></div>
 <h3>Mulai Pencarian</h3>
 <p>Masukkan kata kunci minimal 2 karakter untuk mencari data pembudidaya, kolam, atau jenis ikan.</p>
 </div>
 @else

 @php $hasResult = $pembudidaya->isNotEmpty() || $kolam->isNotEmpty() || $jenisIkan->isNotEmpty(); @endphp

 @if(!$hasResult)
 <div class="empty-state">
 <div class="emoji"></div>
 <h3>Tidak Ada Hasil untuk "{{ $q }}"</h3>
 <p>Coba kata kunci yang berbeda atau ubah kategori pencarian.</p>
 </div>
 @endif

 {{-- Pembudidaya --}}
 @if($pembudidaya->isNotEmpty())
 <div class="section-title"> Pembudidaya <span class="count">{{ $pembudidaya->count() }} hasil</span></div>
 <div class="results-grid">
 @foreach($pembudidaya as $p)
 <a href="{{ route('public.kolam.show', $p->kolam->first()->id ?? '#') }}" class="result-card" @if(!$p->kolam->first()) style="cursor:default;" @endif onclick="{{ !$p->kolam->first() ? 'return false' : '' }}">
 <div class="card-icon" style="background:#d1fae5;">{{ $p->jenis_kelamin == 'L' ? '' : '' }}</div>
 <div class="card-title">{{ $p->nama }}</div>
 <div class="card-sub">NIK: {{ $p->nik }}</div>
 <div class="card-sub"> {{ Str::limit($p->alamat, 60) }}</div>
 <div class="card-tags">
 <span class="tag"> {{ $p->no_hp ?? 'Tidak ada' }}</span>
 <span class="tag" style="background:#dcfce7;color:#15803d;"> {{ $p->kolam_count }} kolam</span>
 </div>
 </a>
 @endforeach
 </div>
 @endif

 {{-- Kolam --}}
 @if($kolam->isNotEmpty())
 <div class="section-title"> Kolam <span class="count">{{ $kolam->count() }} hasil</span></div>
 <div class="results-grid">
 @foreach($kolam as $k)
 <a href="{{ route('public.kolam.show', $k) }}" class="result-card">
 <div class="card-icon" style="background:#dbeafe;"></div>
 <div class="card-title">{{ $k->nama_kolam }}</div>
 <div class="card-sub"> {{ $k->pembudidaya->nama ?? '-' }}</div>
 <div class="card-sub"> {{ Str::limit($k->alamat_kolam, 60) }}</div>
 <div class="card-tags">
 <span class="tag">{{ ucfirst($k->jenis_kolam) }}</span>
 @if($k->luas_m2)<span class="tag">{{ $k->luas_m2 }} m²</span>@endif
 <span class="tag" style="background:{{ $k->status_kolam == 'aktif' ? '#dcfce7' : '#fee2e2' }};color:{{ $k->status_kolam == 'aktif' ? '#15803d' : '#dc2626' }};">{{ $k->status_label }}</span>
 @if($k->hasCoordinates())<span class="tag" style="background:#f0fdf4;color:#15803d;"> Peta</span>@endif
 </div>
 </a>
 @endforeach
 </div>
 @endif

 {{-- Jenis Ikan --}}
 @if($jenisIkan->isNotEmpty())
 <div class="section-title"> Jenis Ikan <span class="count">{{ $jenisIkan->count() }} hasil</span></div>
 <div class="results-grid">
 @foreach($jenisIkan as $ikan)
 <div class="result-card" style="cursor:default;">
 <div class="card-icon" style="background:#e0f2fe;"></div>
 <div class="card-title">{{ $ikan->nama_ikan }}</div>
 <div class="card-sub" style="font-style:italic;">{{ $ikan->nama_latin ?? 'Nama latin belum tersedia' }}</div>
 @if($ikan->deskripsi)<div class="card-sub">{{ Str::limit($ikan->deskripsi, 80) }}</div>@endif
 <div class="card-tags">
 @if($ikan->umur_panen_hari)<span class="tag"> Panen {{ $ikan->umur_panen_hari }} hari</span>@endif
 <span class="tag" style="background:{{ $ikan->status == 'aktif' ? '#dcfce7' : '#fee2e2' }};color:{{ $ikan->status == 'aktif' ? '#15803d' : '#dc2626' }};">{{ ucfirst($ikan->status) }}</span>
 </div>
 </div>
 @endforeach
 </div>
 @endif

 @endif
</div>

</body>
</html>
