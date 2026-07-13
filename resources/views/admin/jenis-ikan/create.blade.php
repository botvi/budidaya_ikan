@extends('template-admin.layout')
@section('title', 'Tambah Jenis Ikan')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item"><a href="{{ route('jenis-ikan.index') }}">Jenis Ikan</a></li>
 <li class="breadcrumb-item active">Tambah</li>
 </ul>
 </div>
 <div class="col-md-12"><h2 class="mb-0" style="color:#14532d;font-weight:800;"> Tambah Jenis Ikan</h2></div>
 </div>
 </div>
 </div>

 <div class="row justify-content-center">
 <div class="col-lg-7">
 <div class="card" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:linear-gradient(135deg,#0891b2,#06b6d4);border-radius:20px 20px 0 0;padding:20px 28px;">
 <h5 style="color:white;margin:0;font-weight:700;"> Form Jenis Ikan</h5>
 </div>
 <div class="card-body p-4">
 @if($errors->any())
 <div class="alert alert-danger" style="border-radius:12px;"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
 @endif

 <form action="{{ route('jenis-ikan.store') }}" method="POST">
 @csrf
 <div class="row g-3">
 <div class="col-md-6">
 <label class="form-label fw-600">Nama Ikan <span class="text-danger">*</span></label>
 <input type="text" name="nama_ikan" value="{{ old('nama_ikan') }}" class="form-control @error('nama_ikan') is-invalid @enderror" placeholder="Contoh: Lele, Nila, Mas..." style="border-radius:10px;">
 @error('nama_ikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-md-6">
 <label class="form-label fw-600">Nama Latin</label>
 <input type="text" name="nama_latin" value="{{ old('nama_latin') }}" class="form-control" placeholder="Contoh: Clarias sp." style="border-radius:10px;font-style:italic;">
 </div>
 <div class="col-md-6">
 <label class="form-label fw-600">Umur Panen (Hari)</label>
 <input type="number" name="umur_panen_hari" value="{{ old('umur_panen_hari') }}" class="form-control" placeholder="Rata-rata hari panen" min="1" style="border-radius:10px;">
 </div>
 <div class="col-md-6">
 <label class="form-label fw-600">Status <span class="text-danger">*</span></label>
 <select name="status" class="form-select" style="border-radius:10px;">
 <option value="aktif" selected> Aktif</option>
 <option value="nonaktif"> Non-Aktif</option>
 </select>
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Deskripsi</label>
 <textarea name="deskripsi" rows="4" class="form-control" placeholder="Deskripsi singkat tentang jenis ikan ini..." style="border-radius:10px;">{{ old('deskripsi') }}</textarea>
 </div>
 </div>

 <div class="d-flex gap-2 mt-4">
 <button type="submit" class="btn" style="background:linear-gradient(135deg,#0891b2,#06b6d4);color:white;border:none;border-radius:10px;padding:10px 28px;font-weight:600;"> Simpan</button>
 <a href="{{ route('jenis-ikan.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;padding:10px 28px;">Batal</a>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div>
</div>
@endsection
