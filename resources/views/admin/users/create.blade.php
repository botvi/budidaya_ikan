@extends('template-admin.layout')
@section('title', 'Tambah User')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
 <li class="breadcrumb-item active">Tambah</li>
 </ul>
 </div>
 <div class="col-md-12"><h2 class="mb-0" style="color:#14532d;font-weight:800;"> Tambah User</h2></div>
 </div>
 </div>
 </div>
 <div class="row justify-content-center">
 <div class="col-lg-6">
 <div class="card" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:linear-gradient(135deg,#374151,#1f2937);border-radius:20px 20px 0 0;padding:20px 28px;">
 <h5 style="color:white;margin:0;font-weight:700;"> Form User Baru</h5>
 </div>
 <div class="card-body p-4">
 @if($errors->any())
 <div class="alert alert-danger" style="border-radius:12px;"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
 @endif
 <form action="{{ route('users.store') }}" method="POST">
 @csrf
 <div class="row g-3">
 <div class="col-12">
 <label class="form-label fw-600">Nama <span class="text-danger">*</span></label>
 <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" style="border-radius:10px;">
 @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Email <span class="text-danger">*</span></label>
 <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" style="border-radius:10px;">
 @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Password <span class="text-danger">*</span></label>
 <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" style="border-radius:10px;">
 @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Konfirmasi Password</label>
 <input type="password" name="password_confirmation" class="form-control" style="border-radius:10px;">
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Role <span class="text-danger">*</span></label>
 <select name="role" class="form-select" style="border-radius:10px;">
 <option value="operator" selected> Operator</option>
 <option value="admin"> Admin</option>
 </select>
 </div>
 </div>
 <div class="d-flex gap-2 mt-4">
 <button type="submit" class="btn" style="background:#374151;color:white;border:none;border-radius:10px;padding:10px 28px;font-weight:600;"> Simpan</button>
 <a href="{{ route('users.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;padding:10px 28px;">Batal</a>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div>
</div>
@endsection
