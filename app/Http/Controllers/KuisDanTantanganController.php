<?php

namespace App\Http\Controllers;

use App\Models\KuisReguler\KuisReguler;
use Illuminate\Http\Request;
use App\Models\KuisReguler\SoalKuisReguler;

class KuisDanTantanganController extends Controller
{
    public function index()
    {
        $kuis = KuisReguler::with('soal_reguler')->get();
        return view('kuis-tantangan.index', compact('kuis'));
    }
}
