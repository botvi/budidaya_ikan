@extends('template-admin.layout')
@section('title', 'Manajemen User')

@section('content')
<div class="pc-content">
 <div class="page-header">
 <div class="page-block">
 <div class="row align-items-center">
 <div class="col-md-12">
 <ul class="breadcrumb">
 <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
 <li class="breadcrumb-item active">Manajemen User</li>
 </ul>
 </div>
 <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap gap-2">
 <h2 class="mb-0" style="color:#14532d;font-weight:800;"> Manajemen User</h2>
 <a href="{{ route('users.create') }}" class="btn" style="background:#374151;color:white;border:none;border-radius:10px;padding:10px 22px;font-weight:600;">+ Tambah User</a>
 </div>
 </div>
 </div>
 </div>

 @if(session('success'))
 <div class="alert alert-success" style="border-radius:12px;border:none;background:#f0fdf4;color:#15803d;">{{ session('success') }}</div>
 @endif

 <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 24px rgba(0,0,0,.06);">
 <div class="card-body p-0">
 <div class="table-responsive">
 <table class="table table-hover mb-0" style="font-size:.88em;">
 <thead style="background:#f8fafc;">
 <tr>
 <th class="ps-4" style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">No</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Nama</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Email</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Role</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Terdaftar</th>
 <th style="color:#6b7280;font-weight:600;border-bottom:1px solid #f0f0f0;padding:14px 12px;">Aksi</th>
 </tr>
 </thead>
 <tbody>
 @forelse($users as $i => $user)
 <tr style="border-bottom:1px solid #f8f8f8;">
 <td class="ps-4" style="padding:14px 12px;color:#9ca3af;">{{ $users->firstItem() + $i }}</td>
 <td style="padding:14px 12px;">
 <div style="font-weight:600;color:#111827;">{{ $user->name }}</div>
 @if($user->id === auth()->id())<span style="background:#f0fdf4;color:#15803d;font-size:.72em;padding:2px 8px;border-radius:20px;font-weight:600;">Anda</span>@endif
 </td>
 <td style="padding:14px 12px;color:#374151;">{{ $user->email }}</td>
 <td style="padding:14px 12px;">
 @if($user->role == 'admin')
 <span style="background:#fef3c7;color:#b45309;padding:4px 12px;border-radius:20px;font-size:.82em;font-weight:600;"> Admin</span>
 @else
 <span style="background:#eff6ff;color:#1d4ed8;padding:4px 12px;border-radius:20px;font-size:.82em;font-weight:600;"> Operator</span>
 @endif
 </td>
 <td style="padding:14px 12px;color:#6b7280;">{{ $user->created_at->format('d M Y') }}</td>
 <td style="padding:14px 12px;">
 <div class="d-flex gap-1">
 <a href="{{ route('users.edit', $user) }}" class="btn btn-sm" style="background:#fef3c7;color:#b45309;border-radius:8px;padding:5px 12px;"> Edit</a>
 @if($user->id !== auth()->id())
 <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user {{ $user->name }}?')">
 @csrf @method('DELETE')
 <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border-radius:8px;padding:5px 12px;border:none;"></button>
 </form>
 @endif
 </div>
 </td>
 </tr>
 @empty
 <tr><td colspan="6" class="text-center py-5" style="color:#9ca3af;">Belum ada user.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 </div>
</div>
@endsection
