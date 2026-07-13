<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Masjid Nurul Iman Sungai Perupuk — Tabungan Qurban</title>
 <meta name="description" content="Sistem Informasi Tabungan Qurban Masjid Nurul Iman Sungai Perupuk — Menabung untuk Qurban, Meraih Ridha Allah.">
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
 <style>
 :root {
 --green-dark: #064e3b;
 --green-mid: #0f766e;
 --green-light: #0d9488;
 --green-bright: #2dd4bf;
 --gold: #d97706;
 --gold-light: #f59e0b;
 --gold-pale: #fef3c7;
 --cream: #ccfbf1;
 --white: #ffffff;
 --text-dark: #1a1a2e;
 --text-muted: #6b7280;
 }
 * { margin: 0; padding: 0; box-sizing: border-box; }

 html { scroll-behavior: smooth; }

 body {
 font-family: 'Poppins', sans-serif;
 color: var(--text-dark);
 overflow-x: hidden;
 }

 /* ===== NAVBAR ===== */
 .navbar {
 position: fixed;
 top: 0; left: 0; right: 0;
 z-index: 999;
 padding: 0 5%;
 height: 68px;
 display: flex;
 align-items: center;
 justify-content: space-between;
 background: rgba(6,78,59,0.96);
 backdrop-filter: blur(12px);
 border-bottom: 1px solid rgba(255,255,255,0.08);
 transition: background 0.3s;
 }
 .navbar-brand {
 display: flex;
 align-items: center;
 gap: 12px;
 text-decoration: none;
 }
 .navbar-logo {
 width: 40px; height: 40px;
 background: linear-gradient(135deg, var(--gold), var(--gold-light));
 border-radius: 10px;
 display: flex;
 align-items: center;
 justify-content: center;
 font-size: 1.3em;
 box-shadow: 0 3px 10px rgba(217,119,6,0.4);
 }
 .navbar-text { line-height: 1.2; }
 .navbar-title { font-size: 0.82em; font-weight: 800; color: var(--gold-light); letter-spacing: 0.5px; }
 .navbar-sub { font-size: 0.68em; color: rgba(255,255,255,0.6); }
 .navbar-links {
 display: flex;
 align-items: center;
 gap: 6px;
 }
 .nav-link {
 color: rgba(255,255,255,0.85);
 text-decoration: none;
 font-size: 0.85em;
 font-weight: 500;
 padding: 8px 14px;
 border-radius: 8px;
 transition: all 0.2s;
 }
 .nav-link:hover { background: rgba(255,255,255,0.1); color: #fff; }
 .nav-btn {
 background: linear-gradient(135deg, var(--gold), var(--gold-light));
 color: #fff !important;
 font-weight: 700;
 padding: 9px 20px;
 border-radius: 10px;
 box-shadow: 0 4px 12px rgba(217,119,6,0.35);
 transition: all 0.25s;
 }
 .nav-btn:hover {
 transform: translateY(-2px);
 box-shadow: 0 6px 20px rgba(217,119,6,0.5);
 background: rgba(255,255,255,0.1) !important;
 color: var(--gold-light) !important;
 }
 .nav-btn-outline {
 border: 1.5px solid rgba(255,255,255,0.4);
 color: rgba(255,255,255,0.9) !important;
 }
 .nav-btn-outline:hover {
 background: rgba(255,255,255,0.12) !important;
 border-color: rgba(255,255,255,0.7);
 }

 /* ===== HERO ===== */
 .hero {
 min-height: 100vh;
 background: linear-gradient(135deg, #064e3b 0%, #0f766e 40%, #115e59 70%, #0d9488 100%);
 display: flex;
 align-items: center;
 justify-content: center;
 position: relative;
 overflow: hidden;
 text-align: center;
 padding: 120px 5% 80px;
 }
 .hero::before {
 content: '';
 position: absolute;
 inset: 0;
 background-image:
 repeating-linear-gradient(45deg, rgba(255,255,255,0.012) 0, rgba(255,255,255,0.012) 1px, transparent 1px, transparent 30px),
 repeating-linear-gradient(-45deg, rgba(255,255,255,0.012) 0, rgba(255,255,255,0.012) 1px, transparent 1px, transparent 30px);
 pointer-events: none;
 }
 .hero-circle {
 position: absolute;
 border-radius: 50%;
 pointer-events: none;
 }
 .hc1 { width:700px;height:700px; background:radial-gradient(circle,rgba(45,212,191,.2) 0%,transparent 70%); top:-200px;left:-200px; animation:pulse1 10s ease-in-out infinite; }
 .hc2 { width:600px;height:600px; background:radial-gradient(circle,rgba(217,119,6,.18) 0%,transparent 70%); bottom:-200px;right:-200px; animation:pulse2 12s ease-in-out infinite; }
 .hc3 { width:400px;height:400px; background:radial-gradient(circle,rgba(245,158,11,.12) 0%,transparent 70%); top:50%;left:50%;transform:translate(-50%,-50%); animation:pulse1 15s ease-in-out infinite reverse; }
 @keyframes pulse1 { 0%,100%{transform:scale(1) translate(0,0);} 50%{transform:scale(1.12) translate(20px,-20px);} }
 @keyframes pulse2 { 0%,100%{transform:scale(1) translate(0,0);} 50%{transform:scale(1.08) translate(-20px,20px);} }

 .hero-content { position: relative; z-index: 1; max-width: 820px; margin: 0 auto; }
 .hero-badge {
 display: inline-flex;
 align-items: center;
 gap: 8px;
 background: rgba(245,158,11,0.15);
 border: 1px solid rgba(245,158,11,0.3);
 color: var(--gold-light);
 font-size: 0.8em;
 font-weight: 600;
 padding: 8px 18px;
 border-radius: 50px;
 margin-bottom: 24px;
 letter-spacing: 0.5px;
 }
 .hero-emblem {
 width: 100px; height: 100px;
 background: linear-gradient(135deg, var(--gold), var(--gold-light));
 border-radius: 50%;
 display: flex; align-items: center; justify-content: center;
 font-size: 3em;
 margin: 0 auto 28px;
 box-shadow: 0 0 40px rgba(217,119,6,.5), 0 0 80px rgba(217,119,6,.2);
 animation: glow 3s ease-in-out infinite alternate;
 }
 @keyframes glow {
 from { box-shadow: 0 0 25px rgba(217,119,6,.4), 0 0 50px rgba(217,119,6,.15); }
 to { box-shadow: 0 0 50px rgba(217,119,6,.7), 0 0 100px rgba(217,119,6,.3); }
 }
 .hero-title {
 font-size: clamp(2em, 5vw, 3.5em);
 font-weight: 900;
 color: #fff;
 line-height: 1.15;
 margin-bottom: 12px;
 text-shadow: 0 2px 20px rgba(0,0,0,0.2);
 }
 .hero-title span { color: var(--gold-light); }
 .hero-sub {
 font-family: 'Amiri', serif;
 font-size: clamp(1em, 2.5vw, 1.4em);
 color: rgba(255,255,255,0.75);
 margin-bottom: 8px;
 font-style: italic;
 }
 .hero-desc {
 font-size: 1em;
 color: rgba(255,255,255,0.7);
 max-width: 600px;
 margin: 0 auto 36px;
 line-height: 1.7;
 }
 .hero-actions {
 display: flex;
 gap: 14px;
 justify-content: center;
 flex-wrap: wrap;
 }
 .btn-hero-primary {
 background: linear-gradient(135deg, var(--gold), var(--gold-light));
 color: #fff;
 padding: 15px 36px;
 border-radius: 14px;
 font-weight: 700;
 font-size: 1em;
 text-decoration: none;
 box-shadow: 0 6px 20px rgba(217,119,6,0.45);
 transition: all 0.3s;
 display: inline-flex;
 align-items: center;
 gap: 10px;
 }
 .btn-hero-primary:hover {
 transform: translateY(-3px);
 box-shadow: 0 10px 30px rgba(217,119,6,0.6);
 }
 .btn-hero-outline {
 background: rgba(255,255,255,0.1);
 color: #fff;
 padding: 15px 36px;
 border-radius: 14px;
 font-weight: 600;
 font-size: 1em;
 text-decoration: none;
 border: 1.5px solid rgba(255,255,255,0.3);
 transition: all 0.3s;
 display: inline-flex;
 align-items: center;
 gap: 10px;
 }
 .btn-hero-outline:hover {
 background: rgba(255,255,255,0.18);
 border-color: rgba(255,255,255,0.6);
 transform: translateY(-2px);
 }
 .hero-stats {
 display: flex;
 gap: 24px;
 justify-content: center;
 flex-wrap: wrap;
 margin-top: 52px;
 }
 .stat-card {
 background: rgba(255,255,255,0.1);
 backdrop-filter: blur(10px);
 border: 1px solid rgba(255,255,255,0.15);
 border-radius: 16px;
 padding: 20px 28px;
 text-align: center;
 min-width: 150px;
 }
 .stat-num {
 font-size: 2em;
 font-weight: 900;
 color: var(--gold-light);
 line-height: 1;
 margin-bottom: 4px;
 }
 .stat-label {
 font-size: 0.78em;
 color: rgba(255,255,255,0.7);
 font-weight: 500;
 }

 /* ===== SECTION COMMON ===== */
 section { padding: 88px 5%; }
 .section-tag {
 display: inline-flex; align-items: center; gap: 8px;
 background: var(--cream);
 color: var(--green-mid);
 font-size: 0.75em;
 font-weight: 700;
 padding: 6px 16px;
 border-radius: 50px;
 margin-bottom: 14px;
 text-transform: uppercase;
 letter-spacing: 1px;
 }
 .section-title {
 font-size: clamp(1.6em, 3.5vw, 2.6em);
 font-weight: 800;
 color: var(--green-dark);
 line-height: 1.2;
 margin-bottom: 14px;
 }
 .section-title span { color: var(--gold); }
 .section-subtitle {
 font-size: 0.95em;
 color: var(--text-muted);
 max-width: 580px;
 line-height: 1.75;
 }
 .section-header { margin-bottom: 48px; }

 /* ===== ABOUT QURBAN ===== */
 .about-section {
 background: #f0fdfa;
 }
 .about-grid {
 display: grid;
 grid-template-columns: 1fr 1fr;
 gap: 48px;
 align-items: center;
 max-width: 1100px;
 margin: 0 auto;
 }
 .about-text .quran-quote {
 background: linear-gradient(135deg, #064e3b, #0f766e);
 color: #fff;
 border-radius: 16px;
 padding: 24px 28px;
 margin-bottom: 28px;
 position: relative;
 overflow: hidden;
 }
 .about-text .quran-quote::before {
 content: '"';
 position: absolute;
 font-size: 8em;
 color: rgba(255,255,255,0.06);
 top: -20px; left: 10px;
 line-height: 1;
 font-family: serif;
 }
 .arabic-text {
 font-family: 'Amiri', serif;
 font-size: 1.4em;
 line-height: 2;
 direction: rtl;
 color: #fff;
 margin-bottom: 12px;
 }
 .arabic-source {
 font-size: 0.78em;
 color: var(--gold-light);
 font-style: italic;
 }
 .about-text p { color: #374151; line-height: 1.8; margin-bottom: 16px; font-size: 0.95em; }
 .about-visual {
 background: linear-gradient(135deg, #064e3b, #0f766e);
 border-radius: 24px;
 padding: 40px 32px;
 color: #fff;
 }
 .about-visual h3 { font-size: 1.3em; font-weight: 700; margin-bottom: 24px; }
 .keutamaan-item {
 display: flex;
 align-items: flex-start;
 gap: 14px;
 margin-bottom: 20px;
 }
 .keutamaan-icon {
 width: 40px; height: 40px; flex-shrink: 0;
 background: rgba(245,158,11,0.2);
 border-radius: 10px;
 display: flex; align-items: center; justify-content: center;
 font-size: 1.1em;
 }
 .keutamaan-item h4 { font-size: 0.9em; font-weight: 600; color: var(--gold-light); margin-bottom: 2px; }
 .keutamaan-item p { font-size: 0.8em; color: rgba(255,255,255,0.75); line-height: 1.5; }

 /* ===== TATA CARA ===== */
 .tatacara-section { background: #fff; }
 .steps-container { max-width: 900px; margin: 0 auto; }
 .step-item {
 display: flex;
 gap: 24px;
 margin-bottom: 32px;
 align-items: flex-start;
 }
 .step-num {
 width: 52px; height: 52px; flex-shrink: 0;
 background: linear-gradient(135deg, var(--green-dark), var(--green-light));
 border-radius: 50%;
 display: flex; align-items: center; justify-content: center;
 font-size: 1.2em; font-weight: 800;
 color: #fff;
 box-shadow: 0 4px 14px rgba(6,78,59,0.3);
 position: relative;
 }
 .step-num::after {
 content: '';
 position: absolute;
 bottom: -32px; left: 50%;
 transform: translateX(-50%);
 width: 2px;
 height: 28px;
 background: linear-gradient(to bottom, var(--green-light), transparent);
 }
 .step-item:last-child .step-num::after { display: none; }
 .step-content {
 background: #f8fffe;
 border: 1px solid #ccfbf1;
 border-radius: 16px;
 padding: 20px 24px;
 flex: 1;
 }
 .step-content h3 { font-size: 1em; font-weight: 700; color: var(--green-dark); margin-bottom: 6px; }
 .step-content p { font-size: 0.88em; color: #4b5563; line-height: 1.7; }
 .step-emoji { font-size: 1.4em; }

 /* ===== STATISTIK QURBAN ===== */
 .stats-section {
 background: linear-gradient(135deg, #064e3b 0%, #0f766e 60%, #0d9488 100%);
 position: relative;
 overflow: hidden;
 }
 .stats-section::before {
 content: '';
 position: absolute; inset: 0;
 background-image: repeating-linear-gradient(45deg,rgba(255,255,255,.01) 0,rgba(255,255,255,.01) 1px,transparent 1px,transparent 30px);
 }
 .stats-section .section-title { color: #fff; }
 .stats-section .section-tag { background: rgba(245,158,11,.15); color: var(--gold-light); }
 .stats-section .section-subtitle { color: rgba(255,255,255,.7); }
 .stats-section .section-header { text-align: center; margin-bottom: 52px; }
 .stats-section .section-header .section-subtitle { margin: 0 auto; }

 .qurban-grid {
 display: grid;
 grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
 gap: 24px;
 max-width: 1100px;
 margin: 0 auto;
 position: relative;
 z-index: 1;
 }
 .qurban-card {
 background: rgba(255,255,255,0.1);
 backdrop-filter: blur(12px);
 border: 1px solid rgba(255,255,255,0.15);
 border-radius: 20px;
 padding: 28px;
 transition: transform 0.3s, box-shadow 0.3s;
 }
 .qurban-card:hover {
 transform: translateY(-6px);
 box-shadow: 0 16px 40px rgba(0,0,0,0.2);
 }
 .qurban-card-icon {
 font-size: 2.4em;
 margin-bottom: 14px;
 }
 .qurban-card h3 {
 font-size: 1.1em;
 font-weight: 700;
 color: var(--gold-light);
 margin-bottom: 4px;
 }
 .qurban-card .kode {
 font-size: 0.75em;
 color: rgba(255,255,255,.5);
 margin-bottom: 20px;
 }
 .qurban-stat-row {
 display: flex;
 justify-content: space-between;
 align-items: center;
 margin-bottom: 10px;
 }
 .qurban-stat-row span:first-child {
 font-size: 0.8em;
 color: rgba(255,255,255,.65);
 }
 .qurban-stat-row span:last-child {
 font-size: 0.92em;
 font-weight: 700;
 color: #fff;
 }
 .progress-bar-wrap {
 background: rgba(255,255,255,.15);
 border-radius: 50px;
 height: 8px;
 overflow: hidden;
 margin-top: 14px;
 }
 .progress-bar-fill {
 height: 100%;
 background: linear-gradient(90deg, var(--gold), var(--gold-light));
 border-radius: 50px;
 transition: width 1s ease;
 }
 .progress-label {
 font-size: 0.75em;
 color: rgba(255,255,255,.6);
 margin-top: 6px;
 text-align: right;
 }
 .no-data-msg {
 grid-column: 1/-1;
 text-align: center;
 color: rgba(255,255,255,.6);
 padding: 48px;
 font-style: italic;
 }

 /* ===== CARA MENABUNG ===== */
 .tabungan-section { background: #f9fafb; }
 .tabungan-grid {
 display: grid;
 grid-template-columns: 1fr 1fr;
 gap: 48px;
 align-items: center;
 max-width: 1100px;
 margin: 0 auto;
 }
 .tf-info-card {
 background: linear-gradient(135deg, #064e3b, #0f766e);
 border-radius: 24px;
 padding: 36px;
 color: #fff;
 }
 .tf-info-card h3 {
 font-size: 1.25em; font-weight: 700; margin-bottom: 20px;
 display: flex; align-items: center; gap: 10px;
 }
 .rekening-box {
 background: rgba(255,255,255,0.1);
 border: 1px solid rgba(255,255,255,0.2);
 border-radius: 14px;
 padding: 20px;
 margin-bottom: 16px;
 }
 .rekening-box .bank-name { font-size: 0.78em; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
 .rekening-box .rek-num { font-size: 1.5em; font-weight: 800; color: var(--gold-light); letter-spacing: 3px; margin-bottom: 2px; }
 .rekening-box .rek-name { font-size: 0.85em; color: rgba(255,255,255,.8); }
 .tf-note { font-size: 0.8em; color: rgba(255,255,255,.6); margin-top: 10px; line-height: 1.6; }

 .tf-steps { }
 .tf-step {
 display: flex; gap: 16px; align-items: flex-start;
 margin-bottom: 20px;
 }
 .tf-step-icon {
 width: 44px; height: 44px; flex-shrink: 0;
 background: linear-gradient(135deg, var(--gold), var(--gold-light));
 border-radius: 12px;
 display: flex; align-items: center; justify-content: center;
 font-size: 1.1em;
 box-shadow: 0 4px 12px rgba(217,119,6,0.3);
 }
 .tf-step h4 { font-size: 0.95em; font-weight: 700; color: var(--green-dark); margin-bottom: 2px; }
 .tf-step p { font-size: 0.82em; color: var(--text-muted); line-height: 1.6; }

 .btn-transfer-cta {
 display: inline-flex;
 align-items: center;
 gap: 12px;
 background: linear-gradient(135deg, var(--green-dark), var(--green-light));
 color: #fff;
 padding: 16px 36px;
 border-radius: 14px;
 font-size: 1em;
 font-weight: 700;
 text-decoration: none;
 box-shadow: 0 6px 20px rgba(6,78,59,.3);
 transition: all 0.3s;
 margin-top: 24px;
 }
 .btn-transfer-cta:hover {
 transform: translateY(-3px);
 box-shadow: 0 10px 30px rgba(6,78,59,.45);
 }
 .btn-transfer-secondary {
 display: inline-flex;
 align-items: center;
 gap: 10px;
 background: transparent;
 color: var(--green-mid);
 padding: 16px 28px;
 border-radius: 14px;
 font-size: 0.9em;
 font-weight: 600;
 text-decoration: none;
 border: 1.5px solid var(--green-light);
 transition: all 0.3s;
 margin-top: 24px;
 margin-left: 12px;
 }
 .btn-transfer-secondary:hover { background: #f0fdfa; }

 /* ===== FOOTER ===== */
 footer {
 background: var(--green-dark);
 color: rgba(255,255,255,0.7);
 padding: 48px 5% 28px;
 }
 .footer-grid {
 display: grid;
 grid-template-columns: 2fr 1fr 1fr;
 gap: 40px;
 max-width: 1100px;
 margin: 0 auto 40px;
 }
 .footer-brand .brand-row {
 display: flex; align-items: center; gap: 12px; margin-bottom: 16px;
 }
 .footer-brand h3 { font-size: 1em; font-weight: 800; color: var(--gold-light); }
 .footer-brand p { font-size: 0.82em; line-height: 1.8; }
 .footer-col h4 { font-size: 0.82em; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 14px; }
 .footer-col ul { list-style: none; }
 .footer-col ul li { margin-bottom: 8px; }
 .footer-col ul li a { color: rgba(255,255,255,.6); text-decoration: none; font-size: 0.85em; transition: color 0.2s; }
 .footer-col ul li a:hover { color: var(--gold-light); }
 .footer-bottom {
 text-align: center;
 border-top: 1px solid rgba(255,255,255,.08);
 padding-top: 24px;
 font-size: 0.8em;
 color: rgba(255,255,255,.4);
 }

 /* ===== RESPONSIVE ===== */
 @media (max-width: 768px) {
 .about-grid, .tabungan-grid { grid-template-columns: 1fr; }
 .footer-grid { grid-template-columns: 1fr; gap: 24px; }
 .hero-stats { flex-direction: column; align-items: center; }
 .navbar-links .nav-link { display: none; }
 section { padding: 64px 5%; }
 }

 /* ===== SCROLL ANIMATE ===== */
 .fade-up {
 opacity: 0;
 transform: translateY(30px);
 transition: opacity 0.6s ease, transform 0.6s ease;
 }
 .fade-up.visible {
 opacity: 1;
 transform: translateY(0);
 }
 </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
 <a href="{{ route('landing') }}" class="navbar-brand">
 <div class="navbar-logo"><i class="fa-solid fa-mosque" style="color:white;"></i></div>
 <div class="navbar-text">
 <div class="navbar-title">MASJID NURUL IMAN</div>
 <div class="navbar-sub">Sungai Perupuk — Kota Padang</div>
 </div>
 </a>
 <div class="navbar-links">
 <a href="#tentang" class="nav-link">Tentang Qurban</a>
 <a href="#tata-cara" class="nav-link">Tata Cara</a>
 <a href="#statistik" class="nav-link">Statistik</a>
 <a href="#tabungan" class="nav-link">Cara Menabung</a>
 <a href="{{ route('cek.saldo') }}" class="nav-link" style="color:var(--gold-light);"><i class="fa-solid fa-wallet me-1"></i> Cek Saldo & Target</a>
 <a href="{{ route('cek.transfer') }}" class="nav-link" style="color:var(--gold-light);"><i class="fa-solid fa-magnifying-glass me-1"></i> Cek Status TF</a>
 <a href="{{ route('transfer.create') }}" class="nav-link nav-btn"><i class="fa-solid fa-money-bill-wave me-1"></i> Kirim Bukti TF</a>
 <a href="{{ route('login') }}" class="nav-link nav-btn-outline" style="border:1.5px solid rgba(255,255,255,.35); border-radius:10px;"><i class="fa-solid fa-lock me-1"></i> Login Admin</a>
 </div>
</nav>

<!-- HERO -->
<section class="hero" id="home">
 <div class="hero-circle hc1"></div>
 <div class="hero-circle hc2"></div>
 <div class="hero-circle hc3"></div>

 <div class="hero-content">
 <div class="hero-badge">
 <i class="fas fa-star" style="color:var(--gold-light);"></i>
 Sistem Informasi Tabungan Qurban 1446 H / {{ date('Y') }}
 </div>
 <div class="hero-emblem"><i class="fa-solid fa-mosque"></i></div>
 <h1 class="hero-title">
 Masjid <span>Nurul Iman</span><br>Sungai Perupuk
 </h1>
 <p class="hero-sub">
 بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ
 </p>
 <p class="hero-desc">
 Menabung untuk Qurban adalah langkah mulia mendekatkan diri kepada Allah SWT.
 Mulai menabung hari ini, wujudkan impian berqurban bersama jamaah Masjid Nurul Iman.
 </p>
 <div class="hero-actions">
 <a href="{{ route('transfer.create') }}" class="btn-hero-primary">
 <i class="fas fa-paper-plane"></i>
 Kirim Bukti Transfer
 </a>
 <a href="{{ route('cek.saldo') }}" class="btn-hero-outline" style="border-color: var(--gold-light); color: var(--gold-light);">
 <i class="fa-solid fa-wallet"></i>
 Cek Saldo & Target
 </a>
 <a href="{{ route('cek.transfer') }}" class="btn-hero-outline">
 <i class="fas fa-search"></i>
 Cek Status Transfer
 </a>
 <a href="#tata-cara" class="btn-hero-outline" style="background:rgba(255,255,255,.06);">
 <i class="fas fa-book-open"></i>
 Panduan Qurban
 </a>
 </div>

 <div class="hero-stats">
 <div class="stat-card">
 <div class="stat-num">{{ $totalPeserta }}</div>
 <div class="stat-label">Peserta Aktif</div>
 </div>
 <div class="stat-card">
 <div class="stat-num">Rp {{ number_format($totalTerkumpul / 1000000, 1) }}Jt</div>
 <div class="stat-label">Dana Terkumpul</div>
 </div>
 <div class="stat-card">
 <div class="stat-num">{{ $qurbanStats->count() }}</div>
 <div class="stat-label">Kategori Qurban</div>
 </div>
 <div class="stat-card">
 <div class="stat-num">{{ date('Y') }}</div>
 <div class="stat-label">Tahun Program</div>
 </div>
 </div>
 </div>
</section>

<!-- TENTANG QURBAN -->
<section class="about-section" id="tentang">
 <div class="about-grid">
 <div class="about-text fade-up">
 <div class="section-tag"><i class="fas fa-mosque"></i> Tentang Qurban</div>
 <h2 class="section-title">Apa Itu <span>Qurban?</span></h2>
 <div class="quran-quote">
 <div class="arabic-text">
 فَصَلِّ لِرَبِّكَ وَانْحَرْ
 </div>
 <div class="arabic-source">QS. Al-Kautsar: 2 — "Maka laksanakanlah shalat karena Tuhanmu, dan berkurbanlah."</div>
 </div>
 <p>
 <strong>Qurban (Udhiyah)</strong> adalah ibadah menyembelih hewan ternak pada Hari Raya Idul Adha
 (10 Dzulhijjah) dan hari-hari Tasyrik (11, 12, 13 Dzulhijjah) sebagai bentuk ketaatan dan
 <p>
 Hukum qurban adalah <strong>sunnah muakkad</strong> bagi setiap Muslim yang mampu secara finansial,
 dan sangat dianjurkan untuk dilaksanakan oleh setiap keluarga Muslim minimal satu kali dalam setahun.
 </p>
 <p>
 Melalui program tabungan qurban Masjid Nurul Iman, jamaah dapat mempersiapkan dana qurban
 secara bertahap selama setahun penuh sehingga kewajiban mulia ini dapat terlaksana
 dengan mudah dan meringankan.
 </p>
 </div>
 <div class="about-visual fade-up" style="transition-delay:.15s;">
 <h3><i class="fa-solid fa-star text-warning me-1"></i> Keutamaan Berqurban</h3>
 <div class="keutamaan-item">
 <div class="keutamaan-icon"><i class="fa-solid fa-droplet" style="color: #ef4444;"></i></div>
 <div>
 <h4>Amal Terbaik di Hari Idul Adha</h4>
 <p>Rasulullah ﷺ bersabda: "Tidak ada amalan yang lebih dicintai Allah pada Hari Raya Idul Adha selain menyembelih hewan qurban." (HR. Tirmidzi)</p>
 </div>
 </div>
 <div class="keutamaan-item">
 <div class="keutamaan-icon"><i class="fa-solid fa-star" style="color: var(--gold-light);"></i></div>
 <div>
 <h4>Setiap Bulu Mendapat Pahala</h4>
 <p>Setiap bulu hewan qurban menjadi kebaikan bagi orang yang berqurban di sisi Allah SWT.</p>
 </div>
 </div>
 <div class="keutamaan-item">
 <div class="keutamaan-icon"><i class="fa-solid fa-hands" style="color: var(--green-bright);"></i></div>
 <div>
 <h4>Meneladani Nabi Ibrahim AS</h4>
 <p>Qurban adalah syiar Islam untuk meneladani keikhlasan Nabi Ibrahim dan Ismail AS dalam ketaatan kepada Allah.</p>
 </div>
 </div>
 <div class="keutamaan-item">
 <div class="keutamaan-icon"><i class="fa-solid fa-drumstick-bite" style="color: #d97706;"></i></div>
 <div>
 <h4>Berbagi dengan Sesama</h4>
 <p>Daging qurban dibagikan kepada fakir miskin, tetangga, dan keluarga, memperkuat tali silaturahmi.</p>
 </div>
 </div>
 </div>
 </div>
</section>

<!-- TATA CARA -->
<section class="tatacara-section" id="tata-cara">
 <div style="max-width:900px; margin:0 auto;">
 <div class="section-header">
 <div class="section-tag"><i class="fas fa-list-check"></i> Panduan Lengkap</div>
 <h2 class="section-title">Tata Cara <span>Berqurban</span></h2>
 <p class="section-subtitle">Langkah-langkah yang perlu diperhatikan dalam melaksanakan ibadah qurban sesuai syariat Islam.</p>
 </div>

 <div class="steps-container">
 <div class="step-item fade-up">
 <div class="step-num"><span class="step-emoji"><i class="fa-solid fa-wallet"></i></span></div>
 <div class="step-content">
 <h3>1. Niat & Persiapan Dana</h3>
 <p>Niatkan ibadah qurban semata-mata karena Allah SWT sejak awal. Persiapkan dana secara bertahap melalui program tabungan qurban masjid. Hewan qurban yang boleh digunakan adalah: kambing/domba (1 orang), sapi/kerbau (1 ekor untuk 7 orang).</p>
 </div>
 </div>
 <div class="step-item fade-up" style="transition-delay:.1s;">
 <div class="step-num"><span class="step-emoji"><i class="fa-solid fa-paw"></i></span></div>
 <div class="step-content">
 <h3>2. Pemilihan Hewan Qurban</h3>
 <p>Hewan harus memenuhi syarat: sehat tidak cacat, usia cukup (kambing ≥1 tahun, domba ≥6 bulan, sapi ≥2 tahun), tidak kurus, tidak buta, tidak pincang, dan tidak memiliki cacat fisik yang berat.</p>
 </div>
 </div>
 <div class="step-item fade-up" style="transition-delay:.2s;">
 <div class="step-num"><span class="step-emoji"><i class="fa-solid fa-mosque"></i></span></div>
 <div class="step-content">
 <h3>3. Waktu Penyembelihan</h3>
 <p>Penyembelihan dilakukan setelah shalat Idul Adha (10 Dzulhijjah) hingga akhir hari Tasyrik (13 Dzulhijjah). Waktu terbaik adalah segera setelah shalat Ied dan khutbah selesai.</p>
 </div>
 </div>
 <div class="step-item fade-up" style="transition-delay:.3s;">
 <div class="step-num"><span class="step-emoji"><i class="fa-solid fa-scissors"></i></span></div>
 <div class="step-content">
 <h3>4. Proses Penyembelihan</h3>
 <p>Membaca <em>Bismillah Allahu Akbar</em>, menghadapkan hewan ke kiblat, menyembelih dengan pisau tajam agar tidak menyiksa hewan, dan memotong saluran napas, kerongkongan, serta dua urat nadi sekaligus.</p>
 </div>
 </div>
 <div class="step-item fade-up" style="transition-delay:.4s;">
 <div class="step-num"><span class="step-emoji"><i class="fa-solid fa-drumstick-bite"></i></span></div>
 <div class="step-content">
 <h3>5. Pembagian Daging</h3>
 <p>Daging dibagi menjadi tiga bagian: <strong>1/3 untuk shahibul qurban</strong>, <strong>1/3 untuk kerabat & tetangga</strong>, dan <strong>1/3 untuk fakir miskin</strong>. Dianjurkan agar daging disegerakan pembagiannya.</p>
 </div>
 </div>
 <div class="step-item fade-up" style="transition-delay:.5s;">
 <div class="step-num"><span class="step-emoji"><i class="fa-solid fa-clipboard-list"></i></span></div>
 <div class="step-content">
 <h3>6. Hal yang Dilarang Bagi Pemilik Qurban</h3>
 <p>Bagi yang berniat berqurban, tidak boleh memotong rambut, kuku, dan kulit sejak awal Dzulhijjah hingga hewan disembelih. Juga tidak diperbolehkan menjual daging, kulit, atau kepala hewan qurban.</p>
 </div>
 </div>
 </div>
 </div>
</section>

<!-- STATISTIK QURBAN PER MUSHOLA -->
<section class="stats-section" id="statistik">
 <div class="section-header" style="text-align:center; margin-bottom:52px;">
 <div class="section-tag" style="justify-content:center; margin:0 auto 14px;">
 <i class="fas fa-chart-bar"></i> Data Real-Time
 </div>
 <h2 class="section-title" style="color:#fff;">
 Informasi Qurban <span>{{ date('Y') }}</span>
 </h2>
 <p class="section-subtitle" style="margin:0 auto; color:rgba(255,255,255,.7);">
 Data terkini jumlah peserta dan perkembangan tabungan qurban per kategori hewan di Masjid Nurul Iman Sungai Perupuk.
 </p>
 </div>

 <div class="qurban-grid">
 @forelse($qurbanStats as $stat)
 <div class="qurban-card fade-up">
 <div class="qurban-card-icon">
 @if(str_contains(strtolower($stat->nama_kategori), 'sapi') || str_contains(strtolower($stat->nama_kategori), 'kerbau'))
 <i class="fa-solid fa-cow"></i>
 @elseif(str_contains(strtolower($stat->nama_kategori), 'kambing') || str_contains(strtolower($stat->nama_kategori), 'domba'))
 <i class="fa-solid fa-paw"></i>
 @else
 <i class="fa-solid fa-paw"></i>
 @endif
 </div>
 <h3>{{ $stat->nama_kategori }}</h3>
 <div class="kode">Kode: {{ $stat->kode_kategori }}</div>

 <div class="qurban-stat-row">
 <span>Target Dana</span>
 <span>Rp {{ number_format($stat->target_dana, 0, ',', '.') }}</span>
 </div>
 <div class="qurban-stat-row">
 <span>Jumlah Peserta</span>
 <span>{{ $stat->jumlah_peserta }} Orang</span>
 </div>
 <div class="qurban-stat-row">
 <span>Sudah Lunas</span>
 <span style="color: var(--gold-light);">{{ $stat->jumlah_lunas }} Orang <i class="fa-solid fa-circle-check text-success"></i></span>
 </div>
 @if($stat->keterangan)
 <div class="qurban-stat-row">
 <span>Keterangan</span>
 <span style="font-size:0.8em; text-align:right; max-width:120px;">{{ $stat->keterangan }}</span>
 </div>
 @endif

 @php
 $pct = $stat->jumlah_peserta > 0 ? round(($stat->jumlah_lunas / $stat->jumlah_peserta) * 100) : 0;
 @endphp
 <div class="progress-bar-wrap">
 <div class="progress-bar-fill" style="width: {{ $pct }}%;"></div>
 </div>
 <div class="progress-label">{{ $pct }}% peserta lunas</div>
 </div>
 @empty
 <div class="no-data-msg">
 <i class="fas fa-info-circle" style="font-size:2em; margin-bottom:12px; display:block;"></i>
 Data kategori qurban belum tersedia untuk tahun {{ date('Y') }}.<br>
 Silakan hubungi pengurus masjid untuk informasi lebih lanjut.
 </div>
 @endforelse
 </div>
</section>

<!-- CARA MENABUNG & TRANSFER -->
<section class="tabungan-section" id="tabungan">
 <div class="tabungan-grid">
 <div class="fade-up">
 <div class="section-tag"><i class="fas fa-piggy-bank"></i> Cara Menabung</div>
 <h2 class="section-title">Tabungan via <span>Transfer</span></h2>
 <p class="section-subtitle" style="margin-bottom:28px;">
 Tidak perlu datang langsung ke masjid. Jamaah dapat menyetorkan tabungan qurban melalui transfer bank,
 kemudian upload bukti transfer untuk diverifikasi oleh pengurus masjid.
 </p>

 <div class="tf-steps">
 <div class="tf-step">
 <div class="tf-step-icon"><i class="fa-solid fa-1"></i></div>
 <div>
 <h4>Transfer ke Rekening Masjid</h4>
 <p>Lakukan transfer ke rekening resmi Masjid Nurul Iman Sungai Perupuk sesuai nominal yang ingin ditabung.</p>
 </div>
 </div>
 <div class="tf-step">
 <div class="tf-step-icon"><i class="fa-solid fa-camera"></i></div>
 <div>
 <h4>Foto Bukti Transfer</h4>
 <p>Ambil foto atau screenshot bukti transfer dari aplikasi bank atau ATM Anda (format JPG/PNG).</p>
 </div>
 </div>
 <div class="tf-step">
 <div class="tf-step-icon"><i class="fa-solid fa-upload"></i></div>
 <div>
 <h4>Upload di Halaman Ini</h4>
 <p>Klik tombol "Kirim Bukti Transfer" lalu isi form dan upload foto bukti. Pilih nama Anda dari daftar peserta.</p>
 </div>
 </div>
 <div class="tf-step">
 <div class="tf-step-icon"><i class="fa-solid fa-check"></i></div>
 <div>
 <h4>Tunggu Konfirmasi Admin</h4>
 <p>Pengurus masjid akan memverifikasi transfer Anda dan mengkonfirmasi masuknya setoran ke sistem.</p>
 </div>
 </div>
 </div>

 <a href="{{ route('transfer.create') }}" class="btn-transfer-cta">
 <i class="fas fa-paper-plane"></i>
 Kirim Bukti Transfer Sekarang
 </a>
 <a href="{{ route('login') }}" class="btn-transfer-secondary">
 <i class="fas fa-lock"></i>
 Login Admin
 </a>
 </div>

 <div class="tf-info-card fade-up" style="transition-delay:.2s;">
 <h3><i class="fas fa-university"></i> Info Rekening Masjid</h3>
 <div class="rekening-box">
 <div class="bank-name">Bank Nagari (BPD Sumbar)</div>
 <div class="rek-num">2100 1234 5678</div>
 <div class="rek-name">Masjid Nurul Iman Sungai Perupuk</div>
 </div>
 <div class="rekening-box">
 <div class="bank-name">Bank BRI</div>
 <div class="rek-num">0032 0100 0012 309</div>
 <div class="rek-name">Masjid Nurul Iman Sungai Perupuk</div>
 </div>
 <p class="tf-note">
 <i class="fas fa-info-circle"></i>
 <strong style="color:var(--gold-light);">Catatan Penting:</strong><br>
 • Pastikan nama rekening tujuan benar sebelum transfer<br>
 • Simpan bukti transfer sampai dikonfirmasi<br>
 • Konfirmasi dilakukan oleh admin dalam 1×24 jam kerja<br>
 • Untuk pertanyaan, hubungi pengurus masjid
 </p>
 </div>
 </div>
</section>

<!-- FOOTER -->
<footer>
 <div class="footer-grid">
 <div class="footer-brand">
 <div class="brand-row">
 <div style="width:44px;height:44px;background:linear-gradient(135deg,#d97706,#f59e0b);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4em;"><i class="fa-solid fa-mosque" style="color:white;"></i></div>
 <div>
 <h3>Masjid Nurul Iman</h3>
 <div style="font-size:0.78em;color:rgba(255,255,255,.5);">Sungai Perupuk, Kota Padang</div>
 </div>
 </div>
 <p>
 Sistem Informasi Tabungan Qurban Masjid Nurul Iman Sungai Perupuk.
 Menabung untuk Qurban, Meraih Ridha Allah SWT. Program tabungan ini
 terbuka untuk seluruh jamaah dan masyarakat sekitar.
 </p>
 </div>
 <div class="footer-col">
 <h4>Navigasi</h4>
 <ul>
 <li><a href="#home">Beranda</a></li>
 <li><a href="#tentang">Tentang Qurban</a></li>
 <li><a href="#tata-cara">Tata Cara Qurban</a></li>
 <li><a href="#statistik">Statistik Qurban</a></li>
 <li><a href="#tabungan">Cara Menabung</a></li>
 </ul>
 </div>
 <div class="footer-col">
 <h4>Layanan</h4>
 <ul>
 <li><a href="{{ route('transfer.create') }}">Kirim Bukti Transfer</a></li>
 <li><a href="{{ route('login') }}">Login Admin</a></li>
 </ul>
 </div>
 </div>
 <div class="footer-bottom">
 <i class="fa-solid fa-mosque me-1"></i> Masjid Nurul Iman Sungai Perupuk &copy; {{ date('Y') }} &nbsp;|&nbsp;
 Sistem Tabungan Qurban &nbsp;|&nbsp;
 Kota Padang, Sumatera Barat
 </div>
</footer>

<script>
 // Scroll animation
 const observer = new IntersectionObserver((entries) => {
 entries.forEach(e => {
 if (e.isIntersecting) {
 e.target.classList.add('visible');
 }
 });
 }, { threshold: 0.12 });

 document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

 // Navbar scroll effect
 window.addEventListener('scroll', () => {
 const nav = document.querySelector('.navbar');
 if (window.scrollY > 60) {
 nav.style.background = 'rgba(6,78,59,0.99)';
 nav.style.boxShadow = '0 4px 20px rgba(0,0,0,0.25)';
 } else {
 nav.style.background = 'rgba(6,78,59,0.96)';
 nav.style.boxShadow = 'none';
 }
 });
</script>
</body>
</html>
