<?php

namespace App\Http\Controllers\Admin\KuisTantangan;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TantanganBulanan\KuisTantanganBulanan;
use Carbon\Carbon;
use COM;

class TantanganBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kuis = KuisTantanganBulanan::all();
        return view('admin.kuis-tantangan-bulanan.index', compact('kuis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kuis-tantangan-bulanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $slug = Str::slug($request->judul);

        KuisTantanganBulanan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'slug' => $slug
        ]);

        return redirect()->route('admin_kuis-tantangan-bulanan.index')->with('success', 'Kuis Tantangan Bulanan berhasil ditambahkan');
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
    public function edit(KuisTantanganBulanan $kuis_tantangan_bulanan)
    {
        return view('admin.kuis-tantangan-bulanan.edit', compact('kuis_tantangan_bulanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KuisTantanganBulanan $kuis_tantangan_bulanan)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $slug = Str::slug($request->judul);

        $kuis_tantangan_bulanan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'slug' => $slug
        ]);

        return redirect()->route('admin_kuis-tantangan-bulanan.index')->with('success', 'Kuis Tantangan Bulanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KuisTantanganBulanan $kuis_tantangan_bulanan)
    {
        $kuis_tantangan_bulanan->delete();
        return redirect()->route('admin_kuis-tantangan-bulanan.index')->with('success', 'Kuis Tantangan Bulanan berhasil dihapus');
    }
}
