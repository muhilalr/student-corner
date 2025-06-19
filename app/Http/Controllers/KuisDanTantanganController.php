<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\KuisReguler\KuisReguler;
use App\Models\KuisReguler\SoalKuisReguler;

class KuisDanTantanganController extends Controller
{
    public function index()
    {
        $kuis = KuisReguler::with('soal_reguler')->get();
        return view('kuis-tantangan.index', compact('kuis'));
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
            // Jika sudah submit, hanya tampilkan ucapan dan skor
            return view('kuis-tantangan.soal', [
                'kuis' => $kuis,
                'skor' => $hasil->skor,
                'sudahSubmit' => true,
            ]);
        }

        // Ambil soal dan opsi
        $soal = DB::table('soal_kuis_regulers')
            ->where('id_kuis_reguler', $kuis->id)
            ->select('id', 'soal', 'jawaban', 'tipe_soal')
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

        // Ambil soal untuk memproses jawaban
        $soal = DB::table('soal_kuis_regulers')
            ->where('id_kuis_reguler', $kuis->id)
            ->select('id', 'jawaban', 'tipe_soal')
            ->get();

        $skor = 0;

        foreach ($soal as $item) {
            $key = 'jawaban_' . $item->id;
            $jawabanUser = strtolower(trim($request->input($key)));
            $jawabanBenar = strtolower(trim($item->jawaban));

            if ($jawabanUser === $jawabanBenar) {
                $skor++;
            }
        }

        $jumlahSoal = $soal->count();
        $skorFinal = round(($skor / $jumlahSoal) * 100);

        // Simpan hasil
        DB::table('hasil_kuis_regulers')->insert([
            'id_user' => $user->id,
            'id_kuis_reguler' => $kuis->id,
            'skor' => $skorFinal,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('kuis-tantangan.soal', $slug)
            ->with('success', 'Jawaban berhasil disimpan.');
    }
}
