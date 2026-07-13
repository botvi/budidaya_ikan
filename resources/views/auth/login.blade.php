<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Login Admin — SIBUDI Budidaya Ikan Air Tawar</title>
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
 <style>
 *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
 body {
 font-family: 'Inter', sans-serif;
 min-height: 100vh;
 background: radial-gradient(ellipse at 20% 50%, rgba(22,163,74,.08) 0%, transparent 50%),
 radial-gradient(ellipse at 80% 20%, rgba(29,78,216,.08) 0%, transparent 50%),
 linear-gradient(180deg, #0f1117 0%, #0a0e18 100%);
 display: flex; align-items: center; justify-content: center; padding: 20px;
 }

 .login-card {
 width: 100%; max-width: 420px;
 background: rgba(255,255,255,.04); backdrop-filter: blur(20px);
 border: 1px solid rgba(255,255,255,.08); border-radius: 24px;
 overflow: hidden; box-shadow: 0 24px 64px rgba(0,0,0,.5);
 }

 .card-header {
 background: linear-gradient(135deg, #14532d, #166534);
 padding: 36px 32px; text-align: center;
 }
 .card-header .logo {
 width: 64px; height: 64px; background: rgba(255,255,255,.12);
 border-radius: 16px; display: flex; align-items: center; justify-content: center;
 font-size: 2em; margin: 0 auto 16px; box-shadow: 0 8px 24px rgba(0,0,0,.3);
 }
 .card-header h1 { font-size: 1.4em; font-weight: 800; color: white; margin-bottom: 4px; }
 .card-header p { font-size: .82em; color: rgba(255,255,255,.55); }

 .card-body { padding: 32px; }

 @if(session('success'))
 /* ... */
 @endif

 .alert-error {
 background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.2);
 color: #fca5a5; padding: 12px 16px; border-radius: 12px;
 font-size: .84em; margin-bottom: 20px;
 }

 .form-group { margin-bottom: 18px; }
 .form-label { display: block; font-size: .8em; font-weight: 600; color: rgba(255,255,255,.6); margin-bottom: 7px; letter-spacing: .3px; }
 .form-input {
 width: 100%; background: rgba(255,255,255,.06);
 border: 1px solid rgba(255,255,255,.1); border-radius: 12px;
 color: white; padding: 12px 16px; font-size: .9em; font-family: 'Inter';
 outline: none; transition: all .2s;
 }
 .form-input:focus { border-color: rgba(22,163,74,.5); background: rgba(255,255,255,.08); box-shadow: 0 0 0 3px rgba(22,163,74,.1); }
 .form-input::placeholder { color: rgba(255,255,255,.25); }
 .form-input.is-invalid { border-color: rgba(239,68,68,.5); }
 .invalid-feedback { font-size: .78em; color: #fca5a5; margin-top: 5px; display: block; }

 .btn-login {
 width: 100%; padding: 14px;
 background: linear-gradient(135deg, #16a34a, #15803d);
 color: white; font-size: .95em; font-weight: 700; font-family: 'Inter';
 border: none; border-radius: 12px; cursor: pointer;
 box-shadow: 0 8px 24px rgba(22,163,74,.3);
 transition: all .2s; margin-top: 4px;
 }
 .btn-login:hover { transform: translateY(-1px); box-shadow: 0 12px 30px rgba(22,163,74,.4); }
 .btn-login:active { transform: none; }

 .back-link { text-align: center; margin-top: 20px; }
 .back-link a { color: rgba(255,255,255,.4); text-decoration: none; font-size: .82em; transition: color .2s; }
 .back-link a:hover { color: #86efac; }

 .default-creds {
 margin-top: 20px; background: rgba(22,163,74,.08); border: 1px solid rgba(22,163,74,.15);
 border-radius: 12px; padding: 12px 16px; font-size: .78em;
 }
 .default-creds .title { font-weight: 700; color: #86efac; margin-bottom: 6px; }
 .cred-item { color: rgba(255,255,255,.5); margin-bottom: 2px; }
 .cred-item code { color: rgba(255,255,255,.75); background: rgba(255,255,255,.08); padding: 1px 6px; border-radius: 4px; font-size: .9em; }
 </style>
</head>
<body>
<div class="login-card">
 <div class="card-header">
 <div class="logo"></div>
 <h1>SIBUDI Admin</h1>
 <p>Sistem Informasi Budidaya Ikan Air Tawar</p>
 </div>

 <div class="card-body">
 @if(session('success'))
 <div style="background:rgba(22,163,74,.1);border:1px solid rgba(22,163,74,.2);color:#86efac;padding:12px 16px;border-radius:12px;font-size:.84em;margin-bottom:20px;">
 {{ session('success') }}
 </div>
 @endif

 @if($errors->any())
 <div class="alert-error">
 {{ $errors->first() }}
 </div>
 @endif

 <form method="POST" action="{{ route('login') }}">
 @csrf
 <div class="form-group">
 <label class="form-label">Email</label>
 <input type="email" name="email" value="{{ old('email') }}" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="admin@budidayaikan.id" autofocus>
 @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
 </div>

 <div class="form-group">
 <label class="form-label">Password</label>
 <input type="password" name="password" class="form-input" placeholder="••••••••">
 @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
 </div>

 <button type="submit" class="btn-login"> Masuk ke Panel Admin</button>
 </form>

 <!-- Default credentials hint -->

 <div class="back-link">
 <a href="{{ route('landing') }}">← Kembali ke Beranda</a>
 </div>
 </div>
</div>
</body>
</html>
