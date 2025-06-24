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
use App\Http\Controllers\SamplingSimulationController;
use App\Http\Controllers\Admin\InformasiMagangController;
use App\Http\Controllers\Admin\PendaftaranMagangController;
use App\Http\Controllers\VisualisasiData\ScatterController;
use App\Http\Controllers\VisualisasiData\PieChartController;
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
    Route::get('/scatter', [ScatterController::class, 'scatter'])->name('scatter');
    Route::post('/scatter/upload', [ScatterController::class, 'uploadData'])->name('scatter.upload');
    Route::post('/scatter/generate', [ScatterController::class, 'generate'])->name('scatter.generate');
    Route::get('/piechart', [PieChartController::class, 'index'])->name('piechart');
    Route::post('/piechart/upload', [PieChartController::class, 'uploadData'])->name('piechart.upload');
    Route::post('/piechart/generate', [PieChartController::class, 'generatePieChart'])->name('piechart.generate');
});

Route::get('/kuis-dan-tantangan-bulanan', [KuisDanTantanganController::class, 'index'])->name('kuis-tantangan.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/program-magang/informasi-magang', [InformasiMagangController::class, 'indexUser'])->name('program-magang.index');
Route::middleware('auth')->group(function () {
    Route::get('/profil/{slug}', [ProfilController::class, 'show'])->name('profil.show');
    Route::get('/profil/{slug}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::get('/profil/{slug}/artikel-dibaca', [ProfilController::class, 'showArtikelDibaca'])->name('profil.artikel');
    Route::get('/profil/{slug}/video-dilihat', [ProfilController::class, 'showVideoDilihat'])->name('profil.video');
    Route::get('/profil/{slug}/kuis-diselesaikan/kuis-reguler', [ProfilController::class, 'showKuisRegulerDiselesaikan'])->name('profil.kuis-reguler');
    Route::get('/profil/{slug}/kuis-diselesaikan/kuis-tantangan-bulanan', [ProfilController::class, 'showKuisTantanganDiselesaikan'])->name('profil.kuis-tantangan');
    Route::resource('profil', ProfilController::class);
    Route::get('/program-magang/daftar-magang', [PendaftaranMagangController::class, 'index'])
        ->name('daftar-magang.index');

    Route::post('/program-magang/daftar-magang', [PendaftaranMagangController::class, 'store'])
        ->name('daftar-magang.store');
    Route::get('/kuis-dan-tantangan-bulanan/kuis-reguler/{slug}', [KuisDanTantanganController::class, 'showSoalKuisReguler'])->name('kuis-tantangan.soal');
    Route::post('/kuis-dan-tantangan-bulanan/kuis-reguler/{slug}', [KuisDanTantanganController::class, 'submit'])->name('kuis.submit');
    Route::get('/kuis-dan-tantangan-bulanan/kuis-tantangan-bulanan/{slug}', [KuisDanTantanganController::class, 'showSoalTantanganBulanan'])->name('tantangan-bulanan.soal');
    Route::post('/kuis-dan-tantangan-bulanan/kuis-tantangan-bulanan/{slug}', [KuisDanTantanganController::class, 'submitTantanganBulanan'])->name('tantangan-bulanan.submit');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/simulasi-statistik', fn() => view('simulasi.index'))->name('simulasi.index');
Route::get('/simulasi-sampling', [SamplingSimulationController::class, 'index'])->name('simulasi.sampling');
Route::post('/simulasi-sampling', [SamplingSimulationController::class, 'simulate'])->name('simulasi.sampling.run');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
