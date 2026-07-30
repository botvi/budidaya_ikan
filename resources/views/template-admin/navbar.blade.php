<nav class="pc-sidebar" style="--pc-sidebar-bg:#0d4f3c; --pc-sidebar-color:#a7f3d0; --pc-sidebar-active-color:#fff;">
 <div class="navbar-wrapper">
 <div class="m-header" style="background: linear-gradient(135deg, #052e16 0%, #14532d 100%); border-bottom: 1px solid rgba(255,255,255,0.08); padding: 18px 20px;">
 <a href="{{ route('dashboard') }}" class="b-brand" style="display:flex;align-items:center;gap:12px; text-decoration:none;">
 <div style="width:42px;height:42px;background:linear-gradient(135deg,#16a34a,#22c55e);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4em;box-shadow:0 3px 10px rgba(34,197,94,0.4);flex-shrink:0;"></div>
 <div style="line-height:1.2;">
 <div style="font-family:'Poppins',sans-serif;font-size:0.78em;font-weight:800;color:#86efac;letter-spacing:0.5px;">SIBUDI</div>
 <div style="font-family:'Poppins',sans-serif;font-size:0.65em;font-weight:500;color:rgba(255,255,255,0.5);">Budidaya Ikan Air Tawar</div>
 </div>
 </a>
 </div>

 <div class="navbar-content">
 <ul class="pc-navbar">
 {{-- Dashboard --}}
 <li class="pc-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
 <a href="{{ route('dashboard') }}" class="pc-link">
 <span class="pc-micon"><i class="ti ti-layout-dashboard"></i></span>
 <span class="pc-mtext">Dashboard</span>
 </a>
 </li>

 {{-- Section Data Master --}}
 <li class="pc-item pc-caption">
 <label>Data Master</label>
 </li>

 <li class="pc-item {{ request()->routeIs('pembudidaya.*') ? 'active' : '' }}">
 <a href="{{ route('pembudidaya.index') }}" class="pc-link">
 <span class="pc-micon"><i class="ti ti-users" style="color:#34d399;"></i></span>
 <span class="pc-mtext">Data Pembudidaya</span>
 </a>
 </li>

 <li class="pc-item {{ request()->routeIs('jenis-ikan.*') ? 'active' : '' }}">
 <a href="{{ route('jenis-ikan.index') }}" class="pc-link">
 <span class="pc-micon"><i class="ti ti-fish" style="color:#60a5fa;"></i></span>
 <span class="pc-mtext">Data Jenis Ikan</span>
 </a>
 </li>

 <li class="pc-item {{ request()->routeIs('kolam.*') ? 'active' : '' }}">
 <a href="{{ route('kolam.index') }}" class="pc-link">
 <span class="pc-micon"><i class="ti ti-droplet" style="color:#38bdf8;"></i></span>
 <span class="pc-mtext">Data Kolam</span>
 </a>
 </li>

 {{-- Section Produksi --}}
 <li class="pc-item pc-caption">
 <label>Produksi</label>
 </li>

 <li class="pc-item {{ request()->routeIs('hasil-panen.*') ? 'active' : '' }}">
 <a href="{{ route('hasil-panen.index') }}" class="pc-link">
 <span class="pc-micon"><i class="ti ti-basket" style="color:#fbbf24;"></i></span>
 <span class="pc-mtext">Data Hasil Panen</span>
 </a>
 </li>

 <li class="pc-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
 <a href="{{ route('laporan.index') }}" class="pc-link">
 <span class="pc-micon"><i class="ti ti-report" style="color:#f472b6;"></i></span>
 <span class="pc-mtext">Laporan</span>
 </a>
 </li>

 {{-- Section GIS --}}
 <li class="pc-item pc-caption">
 <label>Informasi Publik</label>
 </li>

 <li class="pc-item">
 <a href="{{ route('public.peta') }}" target="_blank" class="pc-link">
 <span class="pc-micon"><i class="ti ti-map-2" style="color:#a78bfa;"></i></span>
 <span class="pc-mtext">Peta GIS Kolam</span>
 </a>
 </li>

 <li class="pc-item">
 <a href="{{ route('public.cari') }}" target="_blank" class="pc-link">
 <span class="pc-micon"><i class="ti ti-search" style="color:#fb923c;"></i></span>
 <span class="pc-mtext">Pencarian Publik</span>
 </a>
 </li>


 </ul>
 </div>
 </div>
</nav>
