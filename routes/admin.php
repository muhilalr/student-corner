<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\InfografisController;
use App\Http\Controllers\Admin\SubjekMateriController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\InformasiMagangController;
use App\Http\Controllers\Admin\SubJudulArtikelController;
use App\Http\Controllers\Admin\VideoPembelajaranController;
use App\Http\Controllers\Admin\DetailSubJudulArtikelController;

Route::prefix('admin')->name('admin_')->group(function () {
  Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [AdminLoginController::class, 'login'])->name('proseslogin');

  Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [SubjekMateriController::class, 'index'])->middleware('role:admin')->name('dashboard');

    Route::get('/operator/dashboard', fn() => view('operator.dashboard'))->middleware('role:operator')->name('operator.dashboard');
    Route::get('/magang/dashboard', fn() => view('admin.magang'))->middleware('role:operator magang')->name('magang.dashboard');

    Route::resource('subjek-materi', SubjekMateriController::class);
    Route::resource('artikel', ArtikelController::class);
    Route::resource('subjudul-artikel', SubJudulArtikelController::class);
    Route::resource('detail-subjudul-artikel', DetailSubJudulArtikelController::class);
    Route::resource('video-pembelajaran', VideoPembelajaranController::class);
    Route::resource('infografis', InfografisController::class);
    Route::resource('informasi-magang', InformasiMagangController::class);
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
  });
});
