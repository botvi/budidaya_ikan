@extends('template-admin.layout')
@section('title', 'Input Hasil Panen')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item"><a href="{{ route('hasil-panen.index') }}">Hasil Panen</a></li>
 <li class="breadcrumb-item active">Input Panen</li>
 </ul>
 </div>
 <div class="col-md-12"><h2 class="mb-0" style="color:#14532d;font-weight:800;"> Input Hasil Panen</h2></div>
 </div>
 </div>
 </div>

 <div class="row justify-content-center">
 <div class="col-lg-8">
 <div class="card" style="border-radius:20px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.08);">
 <div class="card-header" style="background:linear-gradient(135deg,#b45309,#d97706);border-radius:20px 20px 0 0;padding:20px 28px;">
 <h5 style="color:white;margin:0;font-weight:700;"> Form Input Hasil Panen</h5>
 </div>
 <div class="card-body p-4">
 @if($errors->any())
 <div class="alert alert-danger" style="border-radius:12px;"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
 @endif

 <form action="{{ route('hasil-panen.store') }}" method="POST">
 @csrf
 <div class="row g-3">
 <div class="col-md-6">
 <label class="form-label fw-600">Kolam <span class="text-danger">*</span></label>
 <select name="kolam_id" class="form-select @error('kolam_id') is-invalid @enderror" style="border-radius:10px;">
 <option value="">-- Pilih Kolam --</option>
 @foreach($kolamList as $k)
 <option value="{{ $k->id }}" {{ old('kolam_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kolam }} ({{ $k->pembudidaya->nama ?? '' }})</option>
 @endforeach
 </select>
 @error('kolam_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-md-6">
 <label class="form-label fw-600">Jenis Ikan <span class="text-danger">*</span></label>
 <select name="jenis_ikan_id" class="form-select @error('jenis_ikan_id') is-invalid @enderror" style="border-radius:10px;">
 <option value="">-- Pilih Jenis Ikan --</option>
 @foreach($jenisIkanList as $ikan)
 <option value="{{ $ikan->id }}" {{ old('jenis_ikan_id') == $ikan->id ? 'selected' : '' }}>{{ $ikan->nama_ikan }}</option>
 @endforeach
 </select>
 @error('jenis_ikan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-md-4">
 <label class="form-label fw-600">Tanggal Panen <span class="text-danger">*</span></label>
 <input type="date" name="tanggal_panen" value="{{ old('tanggal_panen', date('Y-m-d')) }}" class="form-control @error('tanggal_panen') is-invalid @enderror" style="border-radius:10px;">
 @error('tanggal_panen')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-md-8">
 <label class="form-label fw-600">Total Panen (kg) <span class="text-danger">*</span></label>
 <input type="number" step="0.01" name="total_panen_kg" id="total_panen_kg" value="{{ old('total_panen_kg') }}" class="form-control @error('total_panen_kg') is-invalid @enderror" placeholder="0.00" min="0" style="border-radius:10px;">
 @error('total_panen_kg')<div class="invalid-feedback">{{ $message }}</div>@enderror
 </div>
 <div class="col-12">
 <label class="form-label fw-600">Keterangan</label>
 <textarea name="keterangan" rows="2" class="form-control" style="border-radius:10px;">{{ old('keterangan') }}</textarea>
 </div>
 </div>

 <div class="d-flex gap-2 mt-4">
 <button type="submit" class="btn" style="background:linear-gradient(135deg,#d97706,#b45309);color:white;border:none;border-radius:10px;padding:10px 28px;font-weight:600;"> Simpan Panen</button>
 <a href="{{ route('hasil-panen.index') }}" class="btn" style="background:#f3f4f6;color:#374151;border-radius:10px;padding:10px 28px;">Batal</a>
 </div>
 </form>
 </div>
 </div>
 </div>
 </div>
</div>

@endsection
