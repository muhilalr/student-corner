<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubjekMateri;
use Illuminate\Http\Request;
use App\Models\InformasiMagang;

class HomeController extends Controller
{
    public function index()
    {

        $subjek_materi = SubjekMateri::all();
        return view('home', compact('subjek_materi'));
    }
}
