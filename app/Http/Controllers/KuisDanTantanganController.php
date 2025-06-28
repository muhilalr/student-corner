<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\KuisReguler\KuisReguler;
use App\Models\TantanganBulanan\Periode;
use App\Models\KuisReguler\SoalKuisReguler;
use App\Models\TantanganBulanan\KuisTantanganBulanan;
use App\Models\TantanganBulanan\HasilKuisTantanganBulanan;

class KuisDanTantanganController extends Controller
{
    public function index()
    {
        $kuis = KuisReguler::with('soal_reguler')->get();

        // Ambil periode leaderboard yang aktif
        $periode = Periode::where('status_leaderboard', 'aktif')->first();

        $tantangan = null;
        $hariTersisa = null;
        $jumlahUser = 0;
        $topUsers = collect();

        if ($periode) {
            // Ambil tantangan yang sedang berlangsung (opsional untuk info di halaman)
            $tantangan = KuisTantanganBulanan::where('id_periode', $periode->id)
                ->where('status', 'aktif')
                ->where('tanggal_mulai', '<=', now())
                ->where('tanggal_selesai', '>=', now())
                ->first();

            $hariTersisa = $tantangan ? Carbon::now()->diffInDays($tantangan->tanggal_selesai, false) : null;

            // Ambil semua id kuis dalam periode aktif
            $kuisIds = KuisTantanganBulanan::where('id_periode', $periode->id)->pluck('id');

            // Hitung peserta unik
            $jumlahUser = HasilKuisTantanganBulanan::whereIn('id_kuis_tantangan_bulanan', $kuisIds)
                ->distinct('id_user')
                ->count('id_user');

            // Ambil top 10 user berdasarkan total skor dari seluruh kuis dalam periode
            $topUsers = HasilKuisTantanganBulanan::select('id_user', DB::raw('SUM(skor) as total_skor'))
                ->whereIn('id_kuis_tantangan_bulanan', $kuisIds)
                ->groupBy('id_user')
                ->orderByDesc('total_skor')
                ->with('user')
                ->take(10)
                ->get();
        }

        return view('kuis-tantangan.index', compact(
            'kuis',
            'tantangan',
            'hariTersisa',
            'jumlahUser',
            'topUsers',
            'periode'
        ));
    }

    public function showSoalKuisReguler($slug)
    {
        $user = Auth::user();
        $kuis = DB::table('kuis_regulers')->where('slug', $slug)->first();

        if (!$kuis) {
            abort(404);
        }

        // Cek apakah user sudah submit kuis ini
        $hasil = DB::table('hasil_kuis_regulers')
            ->where('id_user', $user->id)
            ->where('id_kuis_reguler', $kuis->id)
            ->first();

        if ($hasil) {
            return view('kuis-tantangan.soal', [
                'kuis' => $kuis,
                'skor' => session('skor', $hasil->skor),
                'jawaban_benar' => $hasil->jawaban_benar,
                'jawaban_salah' => $hasil->jawaban_salah,
                'sudahSubmit' => true,
            ]);
        }

        // Ambil soal dan opsi
        $soal = DB::table('soal_kuis_regulers')
            ->where('id_kuis_reguler', $kuis->id)
            ->select('id', 'gambar', 'soal', 'jawaban', 'tipe_soal')
            ->get()
            ->map(function ($item) {
                if ($item->tipe_soal === 'Pilihan Ganda') {
                    $item->opsi = DB::table('opsi_soal_kuis_regulers')
                        ->where('id_soal_kuis_reguler', $item->id)
                        ->select('label', 'teks_opsi')
                        ->get();
                } else {
                    $item->opsi = collect();
                }
                return $item;
            });

        return view('kuis-tantangan.soal', [
            'kuis' => $kuis,
            'soal' => $soal,
            'sudahSubmit' => false,
        ]);
    }


    public function submit(Request $request, $slug)
    {
        $kuis = DB::table('kuis_regulers')->where('slug', $slug)->first();
        $user = Auth::user();

        if (!$kuis) {
            abort(404);
        }

        // Cek apakah sudah pernah submit
        $cek = DB::table('hasil_kuis_regulers')
            ->where('id_user', $user->id)
            ->where('id_kuis_reguler', $kuis->id)
            ->first();

        if ($cek) {
            return redirect()->route('kuis-tantangan.soal', $slug)
                ->with('info', 'Anda sudah mengerjakan kuis ini.');
        }

        // Ambil soal
        $soal = DB::table('soal_kuis_regulers')
            ->where('id_kuis_reguler', $kuis->id)
            ->select('id', 'jawaban', 'tipe_soal')
            ->get();

        $jawabanBenar = 0;
        $jawabanSalah = 0;

        foreach ($soal as $item) {
            $key = 'jawaban_' . $item->id;
            $jawabanUser = strtolower(trim($request->input($key)));
            $jawabanKunci = strtolower(trim($item->jawaban));

            if ($jawabanUser === $jawabanKunci) {
                $jawabanBenar++;
            } else {
                $jawabanSalah++;
            }
        }

        $jumlahSoal = $soal->count();
        $skorFinal = round(($jawabanBenar / $jumlahSoal) * 100);

        // Simpan hasil ke database
        DB::table('hasil_kuis_regulers')->insert([
            'id_user' => $user->id,
            'id_kuis_reguler' => $kuis->id,
            'skor' => $skorFinal,
            'jawaban_benar' => $jawabanBenar,
            'jawaban_salah' => $jawabanSalah,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('kuis-tantangan.soal', $slug)
            ->with([
                'success' => 'Jawaban berhasil disimpan.',
                'jawaban_benar' => $jawabanBenar,
                'jawaban_salah' => $jawabanSalah,
                'skor' => $skorFinal,
            ]);
    }

    public function showSoalTantanganBulanan($slug)
    {
        $user = Auth::user();
        $kuis = DB::table('kuis_tantangan_bulanans')->where('slug', $slug)->first();

        if (!$kuis) {
            abort(404);
        }

        // Cek apakah user sudah submit kuis ini
        $hasil = DB::table('hasil_kuis_tantangan_bulanans')
            ->where('id_user', $user->id)
            ->where('id_kuis_tantangan_bulanan', $kuis->id)
            ->first();

        if ($hasil) {
            return view('kuis-tantangan.tantangan-bulanan.soal', [
                'kuis' => $kuis,
                'skor' => session('skor', $hasil->skor),
                'jawaban_benar' => $hasil->jawaban_benar,
                'jawaban_salah' => $hasil->jawaban_salah,
                'sudahSubmit' => true,
            ]);
        }

        // Ambil soal dan opsi
        $soal = DB::table('soal_kuis_tantangan_bulanans')
            ->where('id_kuis_tantangan_bulanan', $kuis->id)
            ->select('id', 'gambar', 'soal', 'jawaban', 'tipe_soal')
            ->get()
            ->map(function ($item) {
                if ($item->tipe_soal === 'Pilihan Ganda') {
                    $item->opsi = DB::table('opsi_soal_kuis_tantangan_bulanans')
                        ->where('id_soal_tantangan', $item->id)
                        ->select('label', 'teks_opsi')
                        ->get();
                } else {
                    $item->opsi = collect();
                }
                return $item;
            });

        return view('kuis-tantangan.tantangan-bulanan.soal', [
            'kuis' => $kuis,
            'soal' => $soal,
            'sudahSubmit' => false,
        ]);
    }

    public function submitTantanganBulanan(Request $request, $slug)
    {
        $kuis = DB::table('kuis_tantangan_bulanans')->where('slug', $slug)->first();
        $user = Auth::user();

        if (!$kuis) {
            abort(404);
        }

        // Cek apakah sudah pernah submit
        $cek = DB::table('hasil_kuis_tantangan_bulanans')
            ->where('id_user', $user->id)
            ->where('id_kuis_tantangan_bulanan', $kuis->id)
            ->first();

        if ($cek) {
            return redirect()->route('tantangan-bulanan.soal', $slug)
                ->with('info', 'Anda sudah mengerjakan kuis ini.');
        }

        // Ambil soal
        $soal = DB::table('soal_kuis_tantangan_bulanans')
            ->where('id_kuis_tantangan_bulanan', $kuis->id)
            ->select('id', 'jawaban', 'tipe_soal')
            ->get();

        $jawabanBenar = 0;
        $jawabanSalah = 0;

        foreach ($soal as $item) {
            $key = 'jawaban_' . $item->id;
            $jawabanUser = strtolower(trim($request->input($key)));
            $jawabanKunci = strtolower(trim($item->jawaban));

            if ($jawabanUser === $jawabanKunci) {
                $jawabanBenar++;
            } else {
                $jawabanSalah++;
            }
        }

        $jumlahSoal = $soal->count();
        $skorFinal = round(($jawabanBenar / $jumlahSoal) * 100);

        // Simpan hasil ke database
        DB::table('hasil_kuis_tantangan_bulanans')->insert([
            'id_user' => $user->id,
            'id_kuis_tantangan_bulanan' => $kuis->id,
            'skor' => $skorFinal,
            'jawaban_benar' => $jawabanBenar,
            'jawaban_salah' => $jawabanSalah,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('tantangan-bulanan.soal', $slug)
            ->with([
                'success' => 'Jawaban berhasil disimpan.',
                'jawaban_benar' => $jawabanBenar,
                'jawaban_salah' => $jawabanSalah,
                'skor' => $skorFinal,
            ]);
    }
}
