<?php

use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\KontenEdukasiController;
use App\Http\Controllers\VisualisasiDataController;
use App\Http\Controllers\KuisDanTantanganController;
use App\Http\Controllers\Admin\InformasiMagangController;
use App\Http\Controllers\Admin\PendaftaranMagangController;
use App\Http\Controllers\VisualisasiData\HistogramController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/konten-edukasi/{slug}', [KontenEdukasiController::class, 'show'])->name('konten-edukasi.show');
Route::get('/konten-edukasi/{subjek_slug}/artikel/{slug}', [KontenEdukasiController::class, 'showArtikel'])->name('konten-edukasi.showArtikel');
Route::get('/konten-edukasi/{subjek_slug}/video/{slug}', [KontenEdukasiController::class, 'showVideo'])->name('konten-edukasi.showVideo');

Route::prefix('kalkulator-statistik')->group(function () {
    Route::get('/', fn() => view('kalkulator-statistik.index'))->name('kalkulator-statistik.index');
    Route::get('/kalkulator-mean-median-modus', fn() => view('kalkulator-statistik.mean'))->name('kalkulator-statistik.mean');
    Route::get('/kalkulator-kombinasi', fn() => view('kalkulator-statistik.kombinasi'))->name('kalkulator-statistik.kombinasi');
    Route::get('/kalkulator-standar-deviasi', fn() => view('kalkulator-statistik.standar-deviasi'))->name('kalkulator-statistik.standar-deviasi');
});

// routes/web.php


Route::prefix('visualisasi-data')->name('visualisasi.')->group(function () {
    Route::get('/', fn() => view('visualisasi-data.index'))->name('index');
    Route::get('/histogram', [HistogramController::class, 'histogram'])->name('histogram');
    Route::post('/histogram/upload', [HistogramController::class, 'uploadData'])->name('histogram.upload');
    Route::post('/histogram/generate', [HistogramController::class, 'generateHistogram'])->name('histogram.generate');
});

Route::get('/kuis-dan-tantangan-bulanan', [KuisDanTantanganController::class, 'index'])->name('kuis-tantangan.index');

Route::get('/quiz/result', [KuisDanTantanganController::class, 'result'])->name('quiz.result');
// Route::get('/kalkulator-statistik', fn() => view('kalkulator-statistik.index'))->name('kalkulator-statistik.index');
// Route::get('/kalkulator-statistik/kalkulator-mean-median-modus', fn() => view('kalkulator-statistik.mean'))->name('kalkulator-statistik.mean');
// Route::get('/kalkulator-statistik/kalkulator-kombinasi', fn() => view('kalkulator-statistik.kombinasi'))->name('kalkulator-statistik.kombinasi');
// Route::get('/kalkulator-statistik/kalkulator-standar-deviasi', fn() => view('kalkulator-statistik.standar-deviasi'))->name('kalkulator-statistik.standar-deviasi');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profil/{slug}', [ProfilController::class, 'show'])->name('profil.show');
    Route::resource('profil', ProfilController::class);
    Route::get('/program-magang/daftar-magang', [PendaftaranMagangController::class, 'index'])
        ->name('daftar-magang.index');

    Route::post('/program-magang/daftar-magang', [PendaftaranMagangController::class, 'store'])
        ->name('daftar-magang.store');
    Route::get('/kuis-dan-tantangan-bulanan/kuis-reguler/{slug}', [KuisDanTantanganController::class, 'showSoalKuisReguler'])->name('kuis-tantangan.soal');
    Route::post('/kuis-dan-tantangan-bulanan/kuis-reguler/{slug}', [KuisDanTantanganController::class, 'submit'])->name('kuis.submit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/program-magang/{slug}', [InformasiMagangController::class, 'show'])->name('program-magang.index');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
