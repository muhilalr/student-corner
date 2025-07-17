<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\InformasiMagang;
use Illuminate\Validation\Rules\In;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Info;

class InformasiMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = InformasiMagang::all();
        return view('admin.informasi-magang.index', compact('info'));
    }

    public function indexUser()
    {
        $info = InformasiMagang::withCount(['pendaftaran_magangs as pelamar' => function ($query) {
            $query->where('status', 'diproses');
        }])->get();
        return view('program-magang.index', compact('info'));
    }

    public function detail($slug_bidang, $slug_posisi)
    {
        $info = InformasiMagang::where('slug_bidang', $slug_bidang)->where('slug_posisi', $slug_posisi)->first();
        return view('program-magang.detail-informasi', compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.informasi-magang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang' => 'required',
            'posisi' => 'required',
            'kebutuhan_orang' => 'required|integer',
            'deskripsi' => 'required',
            'persyaratan' => 'required',
            'benefit' => 'required',
            'info_kontak' => 'required',
        ]);

        $slug_bidang = Str::slug($request->nama_bidang);
        $slug_posisi = Str::slug($request->posisi);

        InformasiMagang::create([
            'nama_bidang' => $request->nama_bidang,
            'posisi' => $request->posisi,
            'kebutuhan_orang' => $request->kebutuhan_orang,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'benefit' => $request->benefit,
            'info_kontak' => $request->info_kontak,
            'slug_bidang' => $slug_bidang,
            'slug_posisi' => $slug_posisi
        ]);
        return redirect()->route('admin_informasi-magang.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InformasiMagang $informasi_magang)
    {
        return view('admin.informasi-magang.edit', compact('informasi_magang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InformasiMagang $informasi_magang)
    {
        $request->validate([
            'nama_bidang' => 'required',
            'posisi' => 'required',
            'kebutuhan_orang' => 'required|integer',
            'deskripsi' => 'required',
            'persyaratan' => 'required',
            'benefit' => 'required',
            'info_kontak' => 'required',
        ]);

        $slug_bidang = Str::slug($request->nama_bidang);
        $slug_posisi = Str::slug($request->posisi);

        $informasi_magang->update([
            'nama_bidang' => $request->nama_bidang,
            'posisi' => $request->posisi,
            'kebutuhan_orang' => $request->kebutuhan_orang,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'benefit' => $request->benefit,
            'info_kontak' => $request->info_kontak,
            'slug_bidang' => $slug_bidang,
            'slug_posisi' => $slug_posisi
        ]);
        return redirect()->route('admin_informasi-magang.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformasiMagang $informasi_magang)
    {
        $informasi_magang->delete();
        return redirect()->route('admin_informasi-magang.index')->with('success', 'Data berhasil dihapus');
    }
}
