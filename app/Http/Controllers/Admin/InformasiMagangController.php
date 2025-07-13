<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\InformasiMagang;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Info;
use Illuminate\Validation\Rules\In;

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
        $info = InformasiMagang::all();
        return view('program-magang.index', compact('info'));
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
            'deskripsi' => 'required',
            'persyaratan' => 'required',
            'benefit' => 'required',
            'info_kontak' => 'required',
        ]);

        InformasiMagang::create([
            'nama_bidang' => $request->nama_bidang,
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'benefit' => $request->benefit,
            'info_kontak' => $request->info_kontak,
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
            'deskripsi' => 'required',
            'persyaratan' => 'required',
            'benefit' => 'required',
            'info_kontak' => 'required',
        ]);

        $informasi_magang->update([
            'nama_bidang' => $request->nama_bidang,
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'benefit' => $request->benefit,
            'info_kontak' => $request->info_kontak,
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
