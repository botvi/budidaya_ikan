<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MTs Nurul Islam Gunung Toar — Daftar Akun</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Nunito:wght@400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root{--bg:#f8fafc;--card:#ffffff;--border:#e2e8f0;--nb:#0ea5e9;--np:#8b5cf6;--ng:#10b981;--tx:#0f172a;--mu:#64748b;}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Nunito',sans-serif;background:var(--bg);color:var(--tx);min-height:100vh;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;padding:20px;}
body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(14,165,233,.1) 1px,transparent 1px),linear-gradient(90deg,rgba(14,165,233,.1) 1px,transparent 1px);background-size:50px 50px;animation:grid 25s linear infinite;pointer-events:none;}
@keyframes grid{to{transform:translateY(50px)}}
.orb{position:fixed;border-radius:50%;filter:blur(100px);opacity:.15;pointer-events:none;}
.o1{width:450px;height:450px;background:var(--nb);top:-150px;right:-150px;}
.o2{width:400px;height:400px;background:var(--np);bottom:-130px;left:-130px;}

.card{background:rgba(255,255,255,.9);border:1px solid var(--border);border-radius:24px;padding:40px;width:100%;max-width:500px;position:relative;z-index:1;backdrop-filter:blur(16px);box-shadow:0 0 60px rgba(0,200,255,.08);}

.brand{text-align:center;margin-bottom:28px;}
.brand-logo{height:56px;object-fit:contain;margin-bottom:8px;}
.brand-name{font-family:'Poppins',sans-serif;font-size:1.4em;font-weight:900;background:linear-gradient(135deg,var(--nb),var(--np));-webkit-background-clip:text;-webkit-text-fill-color:transparent;letter-spacing:3px;}
.brand-sub{color:var(--mu);font-size:.84em;margin-top:4px;}

.alert-err{background:rgba(255,79,123,.1);border:1px solid rgba(255,79,123,.4);color:#ff7fa0;padding:12px 16px;border-radius:12px;font-size:.85em;margin-bottom:16px;}
.alert-err ul{list-style:none;padding:0;}

.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
@media(max-width:500px){.form-row{grid-template-columns:1fr;}}
.form-group{margin-bottom:14px;}
.form-label{display:block;font-size:.78em;font-weight:700;color:var(--mu);text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;}
.form-input{width:100%;background:rgba(0,0,0,.03);border:1px solid var(--border);color:var(--tx);padding:11px 14px;border-radius:11px;font-family:'Nunito';font-size:.9em;outline:none;transition:.2s;}
.form-input:focus{border-color:var(--nb);box-shadow:0 0 12px rgba(0,200,255,.12);}
.form-input::placeholder{color:var(--mu);}
.form-hint{font-size:.73em;color:var(--mu);margin-top:4px;}
.form-err{font-size:.73em;color:#ff7fa0;margin-top:4px;}

.pw-wrap{position:relative;}
.pw-wrap .form-input{padding-right:40px;}
.pw-toggle{position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--mu);cursor:pointer;transition:.2s;}
.pw-toggle:hover{color:var(--nb);}

.check-row{display:flex;align-items:flex-start;gap:10px;margin:14px 0;}
.check-row input[type=checkbox]{width:16px;height:16px;margin-top:2px;accent-color:var(--nb);cursor:pointer;flex-shrink:0;}
.check-row label{font-size:.83em;color:var(--mu);cursor:pointer;}
.check-row a{color:var(--nb);text-decoration:none;}
.check-row a:hover{color:var(--np);}

.btn-reg{width:100%;padding:13px;background:linear-gradient(135deg,var(--nb),var(--np));color:#fff;border:none;border-radius:12px;font-family:'Poppins',sans-serif;font-size:.88em;font-weight:700;letter-spacing:2px;cursor:pointer;transition:.3s;box-shadow:0 0 20px rgba(0,200,255,.2);}
.btn-reg:hover{transform:translateY(-2px);box-shadow:0 0 30px rgba(0,200,255,.35);}

.divider{border:none;border-top:1px solid var(--border);margin:18px 0;}
.footer-link{text-align:center;font-size:.85em;color:var(--mu);}
.footer-link a{color:var(--nb);font-weight:700;text-decoration:none;}
.footer-link a:hover{color:var(--np);}
</style>
</head>
<body>
<div class="orb o1"></div><div class="orb o2"></div>

<div class="card">
 <div class="brand">
 {{-- <img src="{{ asset('env/logo.png') }}" alt="MTs Nurul Islam Gunung Toar" class="brand-logo"> --}}
 <div class="brand-name">MTs Nurul Islam Gunung Toar</div>
 <div class="brand-sub">Buat akun untuk mulai belajar!</div>
 </div>

 @if($errors->any())
 <div class="alert-err">
 <ul>@foreach($errors->all() as $e)<li><i class="fas fa-exclamation-circle"></i> {{ $e }}</li>@endforeach</ul>
 </div>
 @endif

 @include('sweetalert::alert')

 <form method="POST" action="{{ route('register') }}">
 @csrf

 <div class="form-row">
 <div class="form-group">
 <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
 <input type="text" name="name" class="form-input" placeholder="Nama lengkap" value="{{ old('name') }}" required>
 @error('name')<div class="form-err">{{ $message }}</div>@enderror
 </div>
 <div class="form-group">
 <label class="form-label"><i class="fas fa-at"></i> Username</label>
 <input type="text" name="username" class="form-input" placeholder="Username unik" value="{{ old('username') }}" required>
 @error('username')<div class="form-err">{{ $message }}</div>@enderror
 </div>
 </div>

 <div class="form-row">
 <div class="form-group">
 <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
 <input type="email" name="email" class="form-input" placeholder="Alamat email" value="{{ old('email') }}" required>
 @error('email')<div class="form-err">{{ $message }}</div>@enderror
 </div>
 <div class="form-group">
 <label class="form-label"><i class="fab fa-whatsapp"></i> No. WhatsApp</label>
 <input type="tel" name="no_wa" class="form-input" placeholder="08xxxxxxxxx" value="{{ old('no_wa') }}" required>
 @error('no_wa')<div class="form-err">{{ $message }}</div>@enderror
 </div>
 </div>

 <div class="form-row">
 <div class="form-group">
 <label class="form-label"><i class="fas fa-lock"></i> Password</label>
 <div class="pw-wrap">
 <input type="password" name="password" id="pw1" class="form-input" placeholder="Min. 6 karakter" required>
 <button type="button" class="pw-toggle" onclick="togglePw('pw1','i1')"><i id="i1" class="fas fa-eye"></i></button>
 </div>
 @error('password')<div class="form-err">{{ $message }}</div>@enderror
 </div>
 <div class="form-group">
 <label class="form-label"><i class="fas fa-shield-alt"></i> Konfirmasi</label>
 <div class="pw-wrap">
 <input type="password" name="password_confirmation" id="pw2" class="form-input" placeholder="Ulangi password" required>
 <button type="button" class="pw-toggle" onclick="togglePw('pw2','i2')"><i id="i2" class="fas fa-eye"></i></button>
 </div>
 </div>
 </div>

 <div class="check-row">
 <input type="checkbox" id="terms" name="agree-terms" required>
 <label for="terms">Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> MTs Nurul Islam Gunung Toar</label>
 </div>

 <button type="submit" class="btn-reg"><i class="fas fa-rocket"></i> &nbsp; DAFTAR SEKARANG</button>
 </form>

 <hr class="divider">
 <div class="footer-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk sekarang</a></div>
</div>

<script>
function togglePw(id, iconId){
 var p=document.getElementById(id);
 var i=document.getElementById(iconId);
 p.type=p.type==='password'?'text':'password';
 i.className=p.type==='password'?'fas fa-eye':'fas fa-eye-slash';
}
</script>
</body>
</html>
