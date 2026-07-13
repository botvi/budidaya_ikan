@extends('template-admin.layout')
@section('title', 'Edit Pembudidaya')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item"><a href="{{ route('pembudidaya.index') }}">Pembudidaya</a></li>
 <li class="breadcrumb-item active">Edit</li>
 </ul>
 </div>
 <div class="col-md-12">
 <h2 class="mb-0" style="color:#14532d;font-weight:800;"> Edit Pembudidaya</h2>
 </div>
 </div>
 </div>
 </div>

 <div class="row justify-content-center">
 <div class="col-lg-8">
 <div class="card" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:linear-gradient(135deg,#b45309,#d97706);border-radius:20px 20px 0 0;padding:20px 28px;">
 <h5 style="color:white;margin:0;font-weight:700;"> Edit: {{ $pembudidaya->nama }}</h5>
 </div>
 <div class="card-body p-4">
 @if($errors->any())
 <div class="alert alert-danger" style="border-radius:12px;">
 <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
 </div>
 @endif

 <form action="{{ route('pembudidaya.update', $pembudidaya) }}" method="POST">
 @csrf @method('PUT')
 <div class="row g-3">
 <div class="col-md-6">
 <label class="form-label fw-600">NIK <span class="text-danger">*</span></label>
 <input type="text" name="nik" value="{{ old('nik', $pembudidaya->nik) }}" class="form-control @error('nik') is-invalid @enderror" maxlength="20" style="border-radius:10px;">
 @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-md-6">
 <label class="form-label fw-600">Nama Lengkap <span class="text-danger">*</span></label>
 <input type="text" name="nama" value="{{ old('nama', $pembudidaya->nama) }}" class="form-control @error('nama') is-invalid @enderror" style="border-radius:10px;">
 @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Alamat <span class="text-danger">*</span></label>
 <textarea name="alamat" rows="2" class="form-control @error('alamat') is-invalid @enderror" style="border-radius:10px;">{{ old('alamat', $pembudidaya->alamat) }}</textarea>
 @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-md-6">
 <label class="form-label fw-600">Nomor HP</label>
 <input type="text" name="no_hp" value="{{ old('no_hp', $pembudidaya->no_hp) }}" class="form-control" style="border-radius:10px;">
 </div>
 <div class="col-md-6">
 <label class="form-label fw-600">Email</label>
 <input type="email" name="email" value="{{ old('email', $pembudidaya->email) }}" class="form-control" style="border-radius:10px;">
 </div>
 <div class="col-md-4">
 <label class="form-label fw-600">Jenis Kelamin <span class="text-danger">*</span></label>
 <select name="jenis_kelamin" class="form-select" style="border-radius:10px;">
 <option value="L" {{ old('jenis_kelamin', $pembudidaya->jenis_kelamin) == 'L' ? 'selected' : '' }}> Laki-laki</option>
 <option value="P" {{ old('jenis_kelamin', $pembudidaya->jenis_kelamin) == 'P' ? 'selected' : '' }}> Perempuan</option>
 </select>
 </div>
 <div class="col-md-4">
 <label class="form-label fw-600">Tanggal Daftar</label>
 <input type="date" name="tanggal_daftar" value="{{ old('tanggal_daftar', $pembudidaya->tanggal_daftar?->format('Y-m-d')) }}" class="form-control" style="border-radius:10px;">
 </div>
 <div class="col-md-4">
 <label class="form-label fw-600">Status <span class="text-danger">*</span></label>
 <select name="status" class="form-select" style="border-radius:10px;">
 <option value="aktif" {{ old('status', $pembudidaya->status) == 'aktif' ? 'selected' : '' }}> Aktif</option>
 <option value="nonaktif" {{ old('status', $pembudidaya->status) == 'nonaktif' ? 'selected' : '' }}> Non-Aktif</option>
 </select>
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Keterangan</label>
 <textarea name="keterangan" rows="2" class="form-control" style="border-radius:10px;">{{ old('keterangan', $pembudidaya->keterangan) }}</textarea>
 </div>
 </div>

 <div class="d-flex gap-2 mt-4">
 <button type="submit" class="btn" style="background:linear-gradient(135deg,#d97706,#b45309);color:white;border:none;border-radius:10px;padding:10px 28px;font-weight:600;"> Perbarui Data</button>
 <a href="{{ route('pembudidaya.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;padding:10px 28px;">Batal</a>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div>
</div>
@endsection
