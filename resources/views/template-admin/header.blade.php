<header class="pc-header" style="background: #ffffff; border-bottom: 2px solid #a7f3d0; box-shadow: 0 2px 12px rgba(4,120,87,0.06);">
 <div class="header-wrapper">
 <!-- [Mobile Media Block] start -->
 <div class="me-auto pc-mob-drp">
 <ul class="list-unstyled">
 <!-- Menu collapse Icon -->
 <li class="pc-h-item pc-sidebar-collapse">
 <a href="#" class="pc-head-link ms-0" id="sidebar-hide" style="color:#064e3b;">
 <i class="ti ti-menu-2"></i>
 </a>
 </li>
 <li class="pc-h-item pc-sidebar-popup">
 <a href="#" class="pc-head-link ms-0" id="mobile-collapse" style="color:#064e3b;">
 <i class="ti ti-menu-2"></i>
 </a>
 </li>
 <!-- Breadcrumb / school name -->
 <li class="pc-h-item d-none d-md-inline-flex ms-3">
 <div style="display:flex;align-items:center;gap:8px;">
 <span style="font-size:0.72em;font-weight:700;color:#047857;text-transform:uppercase;letter-spacing:1px;">
 Ref: Masjid Nurul Iman Sungai Perupuk
 </span>
 </div>
 </li>
 </ul>
 </div>
 <!-- [Mobile Media Block end] -->

 <div class="ms-auto">
 <ul class="list-unstyled">
 <li class="dropdown pc-h-item header-user-profile">
 <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
 role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false"
 style="gap:10px; background:#f0fdf4; border:1px solid #a7f3d0; border-radius:50px; padding:6px 14px 6px 6px;">
 
 <div style="width:34px;height:34px;background:linear-gradient(135deg,#064e3b,#047857);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:0.85em;flex-shrink:0;">
 {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
 </div>
 <div style="line-height:1.2;">
 <div style="font-size:0.82em;font-weight:600;color:#064e3b;">{{ Auth::user()->name }}</div>
 <div style="font-size:0.68em;color:#6b7280;text-transform:uppercase;font-weight:bold;">{{ Auth::user()->role }}</div>
 </div>
 <i class="ti ti-chevron-down" style="color:#6b7280;font-size:0.8em;"></i>
 </a>

 <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown" style="border:1px solid #a7f3d0;border-radius:16px;box-shadow:0 10px 30px rgba(6,78,59,0.12);min-width:220px;overflow:hidden;">
 <div style="background:linear-gradient(135deg,#064e3b,#047857);padding:20px;text-align:center;">
 <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.5em;font-weight:700;color:white;margin:0 auto 10px;">
 {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
 </div>
 <div style="font-weight:700;color:white;font-size:0.9em;">{{ Auth::user()->name }}</div>
 <div style="font-size:0.72em;color:rgba(255,255,255,0.7);text-transform:uppercase;font-weight:bold;background:rgba(255,255,255,0.15);border-radius:20px;padding:2px 10px;display:inline-block;margin-top:4px;">
 {{ Auth::user()->role }}
 </div>
 </div>
 <div style="padding:16px;">
 <form method="POST" action="{{ route('logout') }}">
 @csrf
 <button type="submit" style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:#dc2626;background:transparent;border:none;width:100%;font-size:0.85em;font-weight:500;cursor:pointer;font-family:'Poppins',sans-serif;transition:background 0.2s;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
 <i class="ti ti-power"></i> Keluar / Logout
 </button>
 </form>
 </div>
 </div>
 </li>
 </ul>
 </div>
 </div>
</header>
