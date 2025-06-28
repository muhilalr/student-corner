<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SubJudulArtikel;
use App\Http\Controllers\Controller;
use App\Models\DetailSubJudulArtikel;
use Illuminate\Support\Facades\Storage;

class DetailSubJudulArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail_subjuduls = DetailSubJudulArtikel::with('sub_judul_artikel.artikel')->get();
        return view('admin.artikel.detail_subjudul_artikel.index', compact('detail_subjuduls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjuduls = SubJudulArtikel::with('artikel')->get();
        return view('admin.artikel.detail_subjudul_artikel.create', compact('subjuduls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sub_judul_artikel_id' => 'required|exists:sub_judul_artikels,id',
            'konten_text' => 'required',
            'link_embed' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
            'urutan' => 'required|numeric',
        ]);

        $filePath = null;

        if ($request->hasFile('gambar')) {
            $filePath = $request->file('gambar')->store('detail_subjudul_artikel', 'public');
        }

        DetailSubJudulArtikel::create([
            'sub_judul_artikel_id' => $request->sub_judul_artikel_id,
            'konten_text' => $request->konten_text,
            'link_embed' => $request->link_embed,
            'gambar' => $filePath,
            'urutan' => $request->urutan
        ]);

        return redirect()->route('admin_detail-subjudul-artikel.index')->with('success', 'Detail Sub Judul Artikel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailSubJudulArtikel $detail_subjudul_artikel)
    {
        $subjuduls = SubJudulArtikel::all();
        return view('admin.artikel.detail_subjudul_artikel.edit', compact('detail_subjudul_artikel', 'subjuduls'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailSubJudulArtikel $detail_subjudul_artikel)
    {
        $request->validate([
            'sub_judul_artikel_id' => 'required|exists:sub_judul_artikels,id',
            'konten_text' => 'required',
            'link_embed' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
            'urutan' => 'required|numeric',
        ]);

        if ($request->hasFile('gambar')) {
            if ($detail_subjudul_artikel->gambar) {
                Storage::disk('public')->delete($detail_subjudul_artikel->gambar);
            }
            $filePath = $request->file('gambar')->store('detail_subjudul_artikel', 'public');
            $detail_subjudul_artikel->gambar = $filePath;
        }

        $detail_subjudul_artikel->update([
            'sub_judul_artikel_id' => $request->sub_judul_artikel_id,
            'konten_text' => $request->konten_text,
            'link_embed' => $request->link_embed,
            'urutan' => $request->urutan
        ]);

        return redirect()->route('admin_detail-subjudul-artikel.index')->with('success', 'Detail Sub Judul Artikel berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailSubJudulArtikel $detail_subjudul_artikel)
    {
        if ($detail_subjudul_artikel->gambar) {
            Storage::disk('public')->delete($detail_subjudul_artikel->gambar);
        }
        $detail_subjudul_artikel->delete();
        return redirect()->route('admin_detail-subjudul-artikel.index')->with('success', 'Detail Sub Judul Artikel berhasil dihapus');
    }
}
