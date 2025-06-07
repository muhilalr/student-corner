<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Infografis;
use Illuminate\Support\Str;
use App\Models\SubjekMateri;
use Illuminate\Http\Request;
use App\Models\SubJudulArtikel;
use App\Models\VideoPembelajaran;
use App\Models\DetailSubJudulArtikel;

class KontenEdukasiController extends Controller
{
    public function show($slug)
    {
        $subjek = SubjekMateri::where('slug', $slug)->firstOrFail();
        $subjeks = SubjekMateri::all();
        $artikels = Artikel::where('subjek_materi_id', $subjek->id)->get();
        $videos = VideoPembelajaran::where('subjek_materi_id', $subjek->id)->get();
        $infografis = Infografis::where('subjek_materi_id', $subjek->id)->get();

        return view('konten-edukasi.index', compact('artikels', 'subjek', 'subjeks', 'videos', 'infografis'));
    }

    public function showArtikel($subjek_slug, $artikel_slug)
    {
        $subjek = SubjekMateri::where('slug', $subjek_slug)->firstOrFail();

        $artikel = Artikel::where('subjek_materi_id', $subjek->id)
            ->where('slug', $artikel_slug)
            ->with([
                'subjudul_artikel' => function ($query) {
                    $query->orderBy('urutan', 'asc');
                },
                'subjudul_artikel.detail_sub_judul_artikel' => function ($query) {
                    $query->orderBy('urutan', 'asc');
                }
            ])
            ->firstOrFail();

        return view('konten-edukasi.artikel', compact('artikel', 'subjek'));
    }

    public function showVideo($subjek_slug, $video_slug)
    {
        $subjek = SubjekMateri::where('slug', $subjek_slug)->firstOrFail();
        $video = VideoPembelajaran::where('subjek_materi_id', $subjek->id)->where('slug', $video_slug)->firstOrFail();
        return view('konten-edukasi.video-pembelajaran', compact('video', 'subjek'));
    }
}
