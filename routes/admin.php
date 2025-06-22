<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Models\KuisReguler\KuisReguler;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\InfografisController;
use App\Http\Controllers\Admin\SubjekMateriController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\InformasiMagangController;
use App\Http\Controllers\Admin\SubJudulArtikelController;
use App\Http\Controllers\Admin\PendaftaranMagangController;
use App\Http\Controllers\Admin\VideoPembelajaranController;
use App\Http\Controllers\Admin\DetailSubJudulArtikelController;
use App\Http\Controllers\Admin\KuisReguler\KuisRegulerController;
use App\Http\Controllers\Admin\KuisReguler\SoalKuisRegulerController;
use App\Http\Controllers\Admin\KuisTantangan\SoalTantanganBulananController;
use App\Http\Controllers\Admin\KuisTantangan\TantanganBulananController;
use App\Models\InformasiMagang;

Route::prefix('admin')->name('admin_')->group(function () {
  Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [AdminLoginController::class, 'login'])->name('proseslogin');

  Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [SubjekMateriController::class, 'index'])->middleware('role:admin')->name('dashboard');

    Route::get('/operator/dashboard', [SubjekMateriController::class, 'index'])->middleware('role:operator')->name('operator.dashboard');
    Route::get('/operator-magang/dashboard', [InformasiMagangController::class, 'index'])->middleware('role:operator magang')->name('magang.dashboard');
    Route::resource('data-admin', AdminController::class);
    Route::resource('subjek-materi', SubjekMateriController::class);
    Route::resource('artikel', ArtikelController::class);
    Route::resource('subjudul-artikel', SubJudulArtikelController::class);
    Route::resource('detail-subjudul-artikel', DetailSubJudulArtikelController::class);
    Route::resource('video-pembelajaran', VideoPembelajaranController::class);
    Route::resource('infografis', InfografisController::class);
    Route::resource('informasi-magang', InformasiMagangController::class);
    Route::get('/pendaftaran-magang', [PendaftaranMagangController::class, 'index_admin'])
      ->name('daftar-magang.index-admin');
    Route::get('/pendaftaran-magang/{pendaftaran_magang}/edit', [PendaftaranMagangController::class, 'edit'])
      ->name('daftar-magang.edit');
    Route::put('/pendaftaran-magang/{pendaftaran_magang}', [PendaftaranMagangController::class, 'update'])
      ->name('daftar-magang.update');
    Route::delete('/pendaftaran-magang/{pendaftaran_magang}', [PendaftaranMagangController::class, 'destroy'])
      ->name('daftar-magang.destroy');
    Route::resource('kuis-reguler', KuisRegulerController::class);
    Route::get('/opsi-soal-pilihan-ganda', [SoalKuisRegulerController::class, 'indexOpsi'])->name('opsi-soal-pilihan-ganda.index');
    Route::resource('soal-kuis-reguler', SoalKuisRegulerController::class);
    Route::resource('kuis-tantangan-bulanan', TantanganBulananController::class);
    Route::get('/opsi-pilgan-tantangan-bulanan', [SoalTantanganBulananController::class, 'indexOpsi'])->name('opsi-pilgan-tantangan-bulanan.index');
    Route::resource(('soal-kuis-tantangan-bulanan'), SoalTantanganBulananController::class);
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
  });
});
