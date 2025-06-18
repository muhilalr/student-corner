<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KuisReguler\KuisReguler;
use App\Models\KuisReguler\SoalKuisReguler;

class KuisDanTantanganController extends Controller
{
    public function index()
    {
        $kuis = KuisReguler::with('soal_reguler')->get();
        return view('kuis-tantangan.index', compact('kuis'));
    }

    public function showSoalKuisReguler()
    {
        // Ambil soal beserta opsi jawaban (hanya untuk pilihan ganda)
        $soal = DB::table('soal_kuis_regulers')
            ->select('id', 'soal', 'jawaban', 'tipe_soal')
            ->get()
            ->map(function ($item) {
                // Hanya ambil opsi jika tipe soal adalah Pilihan Ganda
                if ($item->tipe_soal === 'Pilihan Ganda') {
                    $item->opsi = DB::table('opsi_soal_kuis_regulers')
                        ->where('id_soal_kuis_reguler', $item->id)
                        ->select('label', 'teks_opsi')
                        ->get();
                } else {
                    $item->opsi = collect(); // Collection kosong untuk isian singkat
                }
                return $item;
            });

        return view('kuis-tantangan.soal', compact('soal'));




        // $kuis = KuisReguler::where('slug', $slug)->firstOrFail();
        // $soal = SoalKuisReguler::with('opsi')->where('id_kuis_reguler', $kuis->id)->get();
        // return view('kuis-tantangan.soal', compact('kuis', 'soal'));
    }

    public function submitKuis()
    {
        return view('kuis-tantangan.submit');
    }
}
