<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\admin\{
    DashboardController,
    PembudidayaController,
    JenisIkanController,
    KolamController,
    HasilPanenController,
    UserController,
};

/*
|--------------------------------------------------------------------------
| Web Routes — Sistem Informasi Budidaya Ikan Air Tawar (SIBUDI)
|--------------------------------------------------------------------------
*/

// ===================== PUBLIC ROUTES (Tanpa Login) =====================

// Landing page
Route::get('/', [PublicController::class, 'index'])->name('landing');

// Peta GIS (Leaflet.js)
Route::get('/peta', [PublicController::class, 'peta'])->name('public.peta');

// API: Data kolam untuk GIS
Route::get('/api/kolam-gis', [PublicController::class, 'apiKolamGis'])->name('api.kolam.gis');

// Pencarian publik
Route::get('/cari', [PublicController::class, 'cari'])->name('public.cari');

// Detail kolam (publik) — prefix /peta/ agar tidak bentrok dengan admin resource /kolam/{id}
Route::get('/peta/kolam/{kolam}', [PublicController::class, 'kolamDetail'])->name('public.kolam.show');

// API Pencarian publik (JSON autocomplete)
Route::get('/api/cari/pembudidaya', function (\Illuminate\Http\Request $request) {
    $q = trim($request->get('q', ''));
    if (strlen($q) < 2) return response()->json([]);
    return response()->json(
        \App\Models\Pembudidaya::where('nama', 'like', "%$q%")
            ->orWhere('nik', 'like', "%$q%")
            ->select('id', 'nama', 'nik', 'alamat')
            ->orderBy('nama')->limit(10)->get()
    );
})->name('api.cari.pembudidaya');

// ===================== AUTHENTICATION =====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ===================== PROTECTED ROUTES (Auth Required) =====================
Route::group(['middleware' => ['auth']], function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data Pembudidaya
    Route::resource('pembudidaya', PembudidayaController::class);

    // Data Jenis Ikan
    Route::resource('jenis-ikan', JenisIkanController::class)->except(['show']);

    // Data Kolam
    Route::resource('kolam', KolamController::class);

    // Data Hasil Panen
    Route::resource('hasil-panen', HasilPanenController::class);

    // Admin-only routes
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
});
