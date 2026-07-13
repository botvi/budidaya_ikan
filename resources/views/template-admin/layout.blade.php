<!DOCTYPE html>
<html lang="id">
<head>
 <title>@yield('title', 'Dashboard') | SIBUDI — Budidaya Ikan Air Tawar</title>
 <!-- [Meta] -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="description" content="Sistem Informasi Budidaya Ikan Air Tawar (SIBUDI) — Pengelolaan Data Pembudidaya, Kolam, Ikan, dan Hasil Panen">
 <meta name="keywords" content="Budidaya Ikan, Air Tawar, GIS, Kolam, Pembudidaya, Riau">
 <meta name="author" content="SIBUDI">
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <!-- Favicon -->
 <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%230d9488'><path d='M12 2L2 9h3v13h14V9h3L12 2zm1 18h-2v-5h2v5z'/></svg>" type="image/svg+xml">

 <!-- Google Font Poppins -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" id="main-font-link">

 <!-- [Tabler Icons] -->
 <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/tabler-icons.min.css">
 <!-- [Feather Icons] -->
 <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/feather.css">
 <!-- [Font Awesome] -->
 <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/fontawesome.css">
 <!-- [Boxicons] -->
 <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
 <!-- [Material Icons] -->
 <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/material.css">
 <!-- [Template CSS] -->
 <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style.css" id="main-style-link">
 <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style-preset.css">

 <style>
 /* ===================================================
 Masjid Nurul Iman — Custom Teal & Mint Theme (Modern, Tenang, Bersih)
 =================================================== */
 :root {
 --pc-sidebar-bg: #0f766e;
 --pc-sidebar-color: #ccfbf1;
 --pc-sidebar-active-color: #ffffff;
 --bs-primary: #0d9488;
 --bs-primary-rgb: 13, 148, 136;
 }

 body, .pc-link, .pc-mtext, .card, input, select, textarea, button {
 font-family: 'Poppins', sans-serif !important;
 }

 /* ---- Sidebar ---- */
 .pc-sidebar {
 background: linear-gradient(180deg, #115e59 0%, #0f766e 60%, #0d9488 100%) !important;
 }
 .pc-sidebar .m-header {
 background: linear-gradient(135deg, #115e59 0%, #0f766e 100%) !important;
 border-bottom: 1px solid rgba(255,255,255,0.08) !important;
 }
 .pc-sidebar .navbar-content {
 background: transparent !important;
 }
 .pc-sidebar .pc-link {
 color: rgba(255,255,255,0.85) !important;
 transition: all 0.2s !important;
 }
 .pc-sidebar .pc-link:hover {
 color: #ffffff !important;
 background: rgba(255,255,255,0.10) !important;
 border-radius: 8px !important;
 }
 .pc-sidebar .pc-navbar .pc-item.active > .pc-link,
 .pc-sidebar .pc-navbar .pc-item .pc-link.active {
 color: #ffffff !important;
 background: rgba(245,158,11,0.20) !important;
 border-radius: 8px !important;
 border-left: 3px solid #f59e0b !important;
 }
 .pc-sidebar .pc-navbar .pc-item.active > .pc-link .pc-micon i,
 .pc-sidebar .pc-navbar .pc-item .pc-link.active .pc-micon i {
 color: #f59e0b !important;
 }
 .pc-sidebar .pc-caption label {
 color: #99f6e4 !important;
 font-size: 0.65em !important;
 font-weight: 700 !important;
 text-transform: uppercase !important;
 letter-spacing: 1.5px !important;
 }

 /* Sidebar mobile overlay */
 .pc-sidebar.mob-sidebar-active {
 z-index: 1100 !important;
 }

 /* ---- Header ---- */
 .pc-header {
 background: #ffffff !important;
 border-bottom: 2px solid #99f6e4 !important;
 box-shadow: 0 2px 12px rgba(13,148,136,0.07) !important;
 }
 .pc-head-link {
 color: #0f766e !important;
 }
 .pc-head-link:hover {
 background: #f0fdfa !important;
 color: #0d9488 !important;
 }

 /* ---- Buttons ---- */
 .btn-primary {
 background: linear-gradient(135deg, #0f766e, #0d9488) !important;
 border-color: #0d9488 !important;
 font-weight: 600 !important;
 transition: all 0.25s !important;
 }
 .btn-primary:hover, .btn-primary:focus {
 background: linear-gradient(135deg, #115e59, #0f766e) !important;
 transform: translateY(-1px);
 box-shadow: 0 6px 16px rgba(13,148,136,0.35) !important;
 }
 .btn-outline-primary {
 color: #0d9488 !important;
 border-color: #0d9488 !important;
 }
 .btn-outline-primary:hover {
 background: #0d9488 !important;
 color: #fff !important;
 }
 .btn-success {
 background: linear-gradient(135deg, #0d9488, #10b981) !important;
 border-color: #10b981 !important;
 font-weight: 600 !important;
 }
 .btn-warning {
 background: linear-gradient(135deg, #d97706, #f59e0b) !important;
 border-color: #f59e0b !important;
 color: #fff !important;
 font-weight: 600 !important;
 }
 .btn-danger {
 background: linear-gradient(135deg, #dc2626, #ef4444) !important;
 border-color: #ef4444 !important;
 font-weight: 600 !important;
 }

 /* ---- Cards ---- */
 .card {
 border-radius: 14px !important;
 border: 1px solid #99f6e4 !important;
 box-shadow: 0 2px 10px rgba(13,148,136,0.06) !important;
 transition: box-shadow 0.3s ease !important;
 }
 .card:hover {
 box-shadow: 0 6px 24px rgba(13,148,136,0.12) !important;
 }
 .card-header {
 background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%) !important;
 color: #fff !important;
 border-radius: 14px 14px 0 0 !important;
 border-bottom: none !important;
 padding: 14px 20px !important;
 }
 .card-header h5, .card-header h4, .card-header h3, .card-header h6 {
 color: #fff !important;
 margin: 0 !important;
 font-weight: 600 !important;
 }

 /* ---- Tables ---- */
 .table thead th {
 background: #f0fdfa !important;
 color: #0f766e !important;
 font-weight: 700 !important;
 border-bottom: 2px solid #99f6e4 !important;
 font-size: 0.82em !important;
 text-transform: uppercase;
 letter-spacing: 0.5px;
 white-space: nowrap;
 }
 .table tbody tr:hover {
 background: #f0fdfa !important;
 }
 .table tbody td {
 vertical-align: middle;
 }

 /* ---- Pagination Laravel Bootstrap 5 styling ---- */
 .pagination {
 display: flex;
 padding-left: 0;
 list-style: none;
 justify-content: flex-end;
 margin-top: 15px;
 }
 .page-item .page-link {
 color: #0d9488 !important;
 border: 1px solid #99f6e4 !important;
 padding: 8px 16px;
 margin-left: -1px;
 transition: all 0.2s;
 }
 .page-item.active .page-link {
 background: #0d9488 !important;
 border-color: #0d9488 !important;
 color: #fff !important;
 }
 .page-item .page-link:hover {
 background: #f0fdfa !important;
 border-color: #99f6e4 !important;
 }
 .page-item.disabled .page-link {
 color: #9ca3af !important;
 background-color: #f3f4f6 !important;
 border-color: #e5e7eb !important;
 }

 /* ---- Typography & Badges ---- */
 .text-primary { color: #0d9488 !important; }
 .text-warning { color: #d97706 !important; }
 .bg-primary { background: linear-gradient(135deg, #0f766e, #0d9488) !important; }
 a { color: #0d9488; text-decoration: none; }
 a:hover { color: #0f766e; }

 .badge-aktif { background: #10b981 !important; color: #fff !important; }
 .badge-nonaktif{ background: #6b7280 !important; color: #fff !important; }
 .badge-L { background: #3b82f6 !important; color: #fff !important; }
 .badge-P { background: #ec4899 !important; color: #fff !important; }

 /* ---- Form Controls ---- */
 .form-control:focus, .form-select:focus {
 border-color: #0d9488 !important;
 box-shadow: 0 0 0 3px rgba(13,148,136,0.15) !important;
 }
 .form-label { font-weight: 500; font-size: 0.88em; }

 /* ---- Footer ---- */
 .pc-footer {
 background: #fff !important;
 border-top: 2px solid #99f6e4 !important;
 }

 /* ---- Breadcrumb ---- */
 .breadcrumb-item.active { color: #0d9488 !important; font-weight: 600; }
 .breadcrumb-item a { color: #6b7280 !important; }
 .breadcrumb-item a:hover { color: #0d9488 !important; }

 /* ---- Print style override ---- */
 @media print {
 .pc-sidebar, .pc-header, .pc-footer, .no-print,
 .btn, .breadcrumb, .page-header, .pagination { display: none !important; }
 .pc-container { margin: 0 !important; padding: 0 !important; }
 .pc-content { margin: 0 !important; padding: 10px !important; }
 .card { box-shadow: none !important; border: 1px solid #ccc !important; border-radius: 4px !important; }
 }
 </style>
 @yield('style')
</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

 <!-- [ Pre-loader ] start -->
 <div class="loader-bg">
 <div class="loader-track">
 <div class="loader-fill"></div>
 </div>
 </div>
 <!-- [ Pre-loader ] End -->

 <!-- [ Sidebar Menu ] start -->
 @include('template-admin.navbar')
 <!-- [ Sidebar Menu ] end -->

 <!-- [ Header Topbar ] start -->
 @include('template-admin.header')
 <!-- [ Header ] end -->

 <!-- [ Main Content ] start -->
 <div class="pc-container">
 @yield('content')
 </div>
 <!-- [ Main Content ] end -->

 <!-- [ Footer ] start -->
 <footer class="pc-footer">
 <div class="footer-wrapper container-fluid">
 <div class="row">
 <div class="col-sm my-1">
 <p class="m-0" style="color:#047857;font-size:0.82em;">
 <i class="fa-solid fa-mosque me-1"></i> Masjid Nurul Iman Sungai Perupuk &copy; {{ date('Y') }}
 </p>
 </div>
 <div class="col-auto my-1">
 <ul class="list-inline footer-link mb-0">
 <li class="list-inline-item">
 <a href="{{ route('dashboard') }}" style="color:#047857;">Dashboard</a>
 </li>
 </ul>
 </div>
 </div>
 </div>
 </footer>
 <!-- [ Footer ] end -->

 @include('sweetalert::alert')

 <!-- ====== Required JS (Mantis Template Assets) ====== -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
 <script src="{{ asset('admin') }}/assets/js/plugins/popper.min.js"></script>
 <script src="{{ asset('admin') }}/assets/js/plugins/simplebar.min.js"></script>
 <script src="{{ asset('admin') }}/assets/js/plugins/bootstrap.min.js"></script>
 <script src="{{ asset('admin') }}/assets/js/fonts/custom-font.js"></script>
 <script src="{{ asset('admin') }}/assets/js/pcoded.js"></script>
 <script src="{{ asset('admin') }}/assets/js/plugins/feather.min.js"></script>
 <script src="{{ asset('admin') }}/assets/js/plugins/apexcharts.min.js"></script>

 <script>
 layout_change('light');
 change_box_container('false');
 layout_rtl_change('false');
 preset_change("preset-1");
 font_change("Poppins");

 $(document).ready(function () {
 if (typeof feather !== 'undefined') feather.replace();

 // Active menu highlighting
 var currentPath = window.location.pathname;
 $('.pc-navbar .pc-link').each(function () {
 var href = $(this).attr('href');
 if (href && currentPath.indexOf(href.split('?')[0]) !== -1 && href.length > 1) {
 $(this).closest('.pc-item').addClass('active');
 }
 });
 });
 </script>

 @yield('script')
</body>
</html>
