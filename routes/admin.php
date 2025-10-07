<?php

use App\Models\InformasiMagang;
use Illuminate\Support\Facades\Route;
use App\Models\KuisReguler\KuisReguler;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\InfografisController;
use App\Http\Controllers\Admin\SubjekMateriController;
use App\Http\Controllers\Admin\InformasiRisetController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\InformasiMagangController;
use App\Http\Controllers\Admin\SubJudulArtikelController;
use App\Http\Controllers\Admin\PendaftaranRisetController;
use App\Http\Controllers\Admin\PendaftaranMagangController;
use App\Http\Controllers\Admin\VideoPembelajaranController;
use App\Http\Controllers\Admin\DetailSubJudulArtikelController;
use App\Http\Controllers\Admin\KuisTantangan\PeriodeController;
use App\Http\Controllers\Admin\KuisReguler\KuisRegulerController;
use App\Http\Controllers\Admin\KuisReguler\SoalKuisRegulerController;
use App\Http\Controllers\Admin\KuisTantangan\TantanganBulananController;
use App\Http\Controllers\Admin\KuisTantangan\SoalTantanganBulananController;

Route::prefix('admin')->name('admin_')->group(function () {
  Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [AdminLoginController::class, 'login'])->name('proseslogin');

  Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('role:admin')->name('dashboard');

    Route::get('/operator/dashboard', [SubjekMateriController::class, 'index'])->middleware('role:operator')->name('operator.dashboard');
    Route::get('/operator-magang/dashboard', [InformasiMagangController::class, 'index'])->middleware('role:operator magang')->name('magang.dashboard');
    Route::resource('data-admin', AdminController::class);


    // Konten Edukasi
    Route::resource('subjek-materi', SubjekMateriController::class);
    Route::resource('artikel', ArtikelController::class);
    Route::get('/subjudul-artikel/{id_artikel}', [SubJudulArtikelController::class, 'index'])->name('subjudul-artikel.index');
    Route::get('/subjudul-artikel/create/{id_artikel}', [SubJudulArtikelController::class, 'create'])->name('subjudul-artikel.create');
    Route::resource('subjudul-artikel', SubJudulArtikelController::class)->except('index', 'create');
    Route::get('/detail-subjudul-artikel/{id_subjudul}', [DetailSubJudulArtikelController::class, 'index'])->name('detail-subjudul-artikel.index');
    Route::get('/detail-subjudul-artikel/create/{id_subjudul}', [DetailSubJudulArtikelController::class, 'create'])->name('detail-subjudul-artikel.create');
    Route::resource('detail-subjudul-artikel', DetailSubJudulArtikelController::class)->except('index', 'create');
    Route::resource('video-pembelajaran', VideoPembelajaranController::class);
    Route::resource('infografis', InfografisController::class);


    // Informasi Magang
    Route::post('/informasi-magang/status-aktif/{id}', [InformasiMagangController::class, 'statusAktif'])
      ->name('informasi-magang.statusAktif');
    Route::post('/informasi-magang/status-nonaktif/{id}', [InformasiMagangController::class, 'statusNonaktif'])
      ->name('informasi-magang.statusNonaktif');
    Route::resource('informasi-magang', InformasiMagangController::class);


    // Pendaftaran Magang
    Route::get('/pendaftaran-magang', [PendaftaranMagangController::class, 'index_admin'])
      ->name('daftar-magang.index-admin');
    Route::get('/pendaftaran-magang-diterima', [PendaftaranMagangController::class, 'magangDiterima'])
      ->name('daftar-magang.magangDiterima');
    Route::get('/pendaftaran-magang-ditolak', [PendaftaranMagangController::class, 'magangDitolak'])
      ->name('daftar-magang.magangDitolak');
    Route::get('/riwayat-pendaftaran-magang', [PendaftaranMagangController::class, 'riwayatMagang'])
      ->name('daftar-magang.riwayatMagang');
    Route::get('/log-harian/{pendaftaran_id}', [PendaftaranMagangController::class, 'logHarian'])
      ->name('daftar-magang.logHarian');
    Route::post('/log-harian/verifikasi-setuju/{id}', [PendaftaranMagangController::class, 'verifikasiSetuju'])
      ->name('daftar-magang.verifikasiSetuju');
    Route::post('/log-harian/verifikasi-tolak/{id}', [PendaftaranMagangController::class, 'verifikasiTolak'])
      ->name('daftar-magang.verifikasiTolak');


    Route::get('/pendaftaran-magang/{pendaftaran_magang}/edit', [PendaftaranMagangController::class, 'edit'])
      ->name('daftar-magang.edit');
    Route::get('/pendaftaran-magang/{pendaftaran_magang}/edit-diterima', [PendaftaranMagangController::class, 'editDiterima'])
      ->name('daftar-magang.edit-diterima');
    Route::get('/pendaftaran-magang/{pendaftaran_magang}/upload-sertifikat', [PendaftaranMagangController::class, 'editSertifikat'])
      ->name('daftar-magang.editSertifikat');
    Route::put('/pendaftaran-magang/{pendaftaran_magang}/upload-sertifikat', [PendaftaranMagangController::class, 'uploadSertifikat'])
      ->name('daftar-magang.upload-sertifikat');
    Route::put('/pendaftaran-magang/{pendaftaran_magang}', [PendaftaranMagangController::class, 'update'])
      ->name('daftar-magang.update');
    Route::delete('/pendaftaran-magang/{pendaftaran_magang}', [PendaftaranMagangController::class, 'destroy'])
      ->name('daftar-magang.destroy');


    // Informasi riset
    Route::resource('informasi-riset', InformasiRisetController::class);

    // Pendaftaran Riset
    Route::get('/pendaftaran-riset', [PendaftaranRisetController::class, 'index_admin'])
      ->name('daftar-riset.index-admin');
    Route::get('/pendaftaran-riset-diterima', [PendaftaranRisetController::class, 'risetDiterima'])
      ->name('daftar-riset.risetDiterima');
    Route::get('/pendaftaran-riset-ditolak', [PendaftaranRisetController::class, 'risetDitolak'])
      ->name('daftar-riset.risetDitolak');
    Route::get('/riwayat-pendaftaran-riset', [PendaftaranRisetController::class, 'riwayatRiset'])
      ->name('daftar-riset.riwayatRiset');

    Route::get('/pendaftaran-riset/{pendaftaran_riset}/edit', [PendaftaranRisetController::class, 'edit'])
      ->name('daftar-riset.edit');
    Route::get('/pendaftaran-riset/{pendaftaran_riset}/edit-diterima', [PendaftaranRisetController::class, 'editDiterima'])
      ->name('daftar-riset.edit-diterima');
    Route::get('/pendaftaran-riset/{pendaftaran_riset}/upload-sertifikat', [PendaftaranRisetController::class, 'editSertifikat'])
      ->name('daftar-riset.editSertifikat');
    Route::put('/pendaftaran-riset/{pendaftaran_riset}/upload-sertifikat', [PendaftaranRisetController::class, 'uploadSertifikat'])
      ->name('daftar-riset.upload-sertifikat');
    Route::put('/pendaftaran-riset/{pendaftaran_riset}', [PendaftaranRisetController::class, 'update'])
      ->name('daftar-riset.update');
    Route::delete('/pendaftaran-riset/{pendaftaran_riset}', [PendaftaranRisetController::class, 'destroy'])
      ->name('daftar-riset.destroy');

    // Kuis Reguler
    Route::resource('kuis-reguler', KuisRegulerController::class);
    // Route::get('/soal-kuis-reguler/edit-batch/{batchId}', [SoalKuisRegulerController::class, 'editBatch'])->name('soal-kuis-reguler.edit-batch');
    // Route::put('/soal-kuis-reguler/update-batch/{batchId}', [SoalKuisRegulerController::class, 'updateBatch'])->name('soal-kuis-reguler.update-batch');
    // Route::delete('/admin/soal-kuis-reguler/destroy-batch/{batchId}', [SoalKuisRegulerController::class, 'destroyBatch'])->name('soal-kuis-reguler.destroy-batch');
    Route::get('/soal-kuis-reguler/{id_kuis}', [SoalKuisRegulerController::class, 'index'])->name('soal-kuis-reguler.index');
    Route::get('/soal-kuis-reguler/create/{id_kuis}', [SoalKuisRegulerController::class, 'create'])->name('soal-kuis-reguler.create');
    Route::resource('soal-kuis-reguler', SoalKuisRegulerController::class)->except('index', 'create');


    //Kuis Tantangan Bulanan
    Route::resource('periode', PeriodeController::class);
    Route::post('/periode/set-leaderboard/{id}', [PeriodeController::class, 'setLeaderboard'])
      ->name('periode.setLeaderboard');
    Route::post('/periode/nonaktifkan-leaderboard', [PeriodeController::class, 'nonaktifkanLeaderboard'])
      ->name('periode.nonaktifkanLeaderboard');
    Route::resource('kuis-tantangan-bulanan', TantanganBulananController::class);

    Route::get('/soal-kuis-tantangan-bulanan/{id_kuis}', [SoalTantanganBulananController::class, 'index'])->name('soal-kuis-tantangan-bulanan.index');
    Route::get('/soal-kuis-tantangan-bulanan/create/{id_kuis}', [SoalTantanganBulananController::class, 'create'])->name('soal-kuis-tantangan-bulanan.create');
    Route::resource('soal-kuis-tantangan-bulanan', SoalTantanganBulananController::class)->except('index', 'create');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
  });
});
