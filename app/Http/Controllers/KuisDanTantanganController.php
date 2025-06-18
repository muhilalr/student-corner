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
        // Ambil ID kuis berdasarkan slug
        $kuis = DB::table('kuis_regulers')
            ->where('slug', $slug)
            ->first();

        if (!$kuis) {
            abort(404); // Jika tidak ditemukan
        }

        // Ambil soal-soal berdasarkan ID kuis
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
                    $item->opsi = collect(); // kosong jika isian singkat
                }
                return $item;
            });

        $sudahSubmit = DB::table('hasil_kuis_regulers')
            ->where('id_kuis_reguler', $kuis->id)
            ->where('id_user', Auth::user()->id)
            ->exists();

        $skor = DB::table('hasil_kuis_regulers')
            ->where('id_kuis_reguler', $kuis->id)
            ->where('id_user', Auth::user()->id)
            ->value('skor');

        $jawabanUser = DB::table('hasil_kuis_regulers')
            ->where('id_kuis_reguler', $kuis->id)
            ->where('id_user', Auth::user()->id)
            ->value('jawaban');

        return view('kuis-tantangan.soal', compact('soal', 'kuis', 'sudahSubmit', 'skor'));
    }

    public function submit(Request $request, $slug)
    {
        $kuis = DB::table('kuis_regulers')->where('slug', $slug)->first();

        if (!$kuis) {
            abort(404);
        }

        // Ambil soal dan cocokkan jawaban untuk ditampilkan ulang nanti
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

        // Simpan skor (opsional, jika ingin ke DB)
        $skor = $request->input('skor');

        // Ambil jawaban user
        $jawabanUser = [];
        foreach ($soal as $item) {
            $jawabanKey = 'jawaban_' . $item->id;
            $jawabanUser[$item->id] = $request->input($jawabanKey);
        }

        // Simpan skor ke database hasil_kuis_regulers
        DB::table('hasil_kuis_regulers')->insert([
            'id_user' => Auth::id(),
            'id_kuis_reguler' => $kuis->id,
            'skor' => $skor,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect kembali ke halaman soal, tapi kali ini bawa data jawaban dan skor
        return view('kuis-tantangan.soal', [
            'kuis' => $kuis,
            'soal' => $soal,
            'skor' => $skor,
            'jawabanUser' => $jawabanUser,
            'sudahSubmit' => true,
        ]);
    }
}
