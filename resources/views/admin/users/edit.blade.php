@extends('template-admin.layout')
@section('title', 'Edit User')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
 <li class="breadcrumb-item active">Edit</li>
 </ul>
 </div>
 <div class="col-md-12"><h2 class="mb-0" style="color:#14532d;font-weight:800;"> Edit User</h2></div>
 </div>
 </div>
 </div>
 <div class="row justify-content-center">
 <div class="col-lg-6">
 <div class="card" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:linear-gradient(135deg,#b45309,#d97706);border-radius:20px 20px 0 0;padding:20px 28px;">
 <h5 style="color:white;margin:0;font-weight:700;"> Edit: {{ $user->name }}</h5>
 </div>
 <div class="card-body p-4">
 @if($errors->any())
 <div class="alert alert-danger" style="border-radius:12px;"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
 @endif
 <form action="{{ route('users.update', $user) }}" method="POST">
 @csrf @method('PUT')
 <div class="row g-3">
 <div class="col-12">
 <label class="form-label fw-600">Nama</label>
 <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" style="border-radius:10px;">
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Email</label>
 <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" style="border-radius:10px;">
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Password Baru <span style="color:#9ca3af;font-weight:400;">(kosongkan jika tidak diganti)</span></label>
 <input type="password" name="password" class="form-control" style="border-radius:10px;">
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Konfirmasi Password</label>
 <input type="password" name="password_confirmation" class="form-control" style="border-radius:10px;">
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Role</label>
 <select name="role" class="form-select" style="border-radius:10px;">
 <option value="operator" {{ old('role', $user->role) == 'operator' ? 'selected' : '' }}> Operator</option>
 <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}> Admin</option>
 </select>
 </div>
 </div>
 <div class="d-flex gap-2 mt-4">
 <button type="submit" class="btn" style="background:linear-gradient(135deg,#d97706,#b45309);color:white;border:none;border-radius:10px;padding:10px 28px;font-weight:600;"> Perbarui</button>
 <a href="{{ route('users.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;padding:10px 28px;">Batal</a>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div>
</div>
@endsection
