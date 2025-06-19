<?php

namespace App\Http\Controllers\Admin\KuisTantangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TantanganBulanan\KuisTantanganBulanan;
use App\Models\TantanganBulanan\OpsiSoalKuisTantanganBulanan;
use App\Models\TantanganBulanan\SoalKuisTantanganBulanan;

class SoalTantanganBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $soal = SoalKuisTantanganBulanan::with('kuis_tantangan_bulanan')->paginate(10);
        return view('admin.kuis-tantangan-bulanan.soal-kuis.index', compact('soal'));
    }

    public function indexOpsi()
    {
        $opsi = OpsiSoalKuisTantanganBulanan::with('soal_tantangan_bulanan')->paginate(12);
        return view('admin.kuis-tantangan-bulanan.opsi-soal-pilgan.index', compact('opsi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kuis_tantangan_bulanan = KuisTantanganBulanan::all();
        return view('admin.kuis-tantangan-bulanan.soal-kuis.create', compact('kuis_tantangan_bulanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kuis_tantangan_bulanan' => 'required|exists:kuis_tantangan_bulanans,id',
            'soal' => 'required|string',
            'tipe_soal' => 'required|in:Pilihan Ganda,Isian Singkat',
            'jawaban' => 'required|string',
        ]);

        // Simpan ke tabel soal_kuis_regulers
        $soal = SoalKuisTantanganBulanan::create([
            'id_kuis_tantangan_bulanan' => $request->kuis_tantangan_bulanan,
            'soal' => $request->soal,
            'tipe_soal' => $request->tipe_soal,
            'jawaban' => $request->jawaban,
        ]);

        // Jika pilihan ganda, simpan opsi-opsinya
        if ($request->tipe_soal === 'Pilihan Ganda' && $request->has('options')) {
            foreach ($request->options as $label => $text) {
                if (!empty($text)) {
                    OpsiSoalKuisTantanganBulanan::create([
                        'id_soal_tantangan' => $soal->id,
                        'label' => $label,       // A, B, C, D
                        'teks_opsi' => $text,    // Isi teks jawaban
                    ]);
                }
            }
        }

        return redirect()->route('admin_soal-kuis-tantangan-bulanan.index')->with('success', 'Soal berhasil ditambahkan.');
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
    public function edit($id)
    {
        $kuis_tantangan_bulanan = KuisTantanganBulanan::all();
        $soal = SoalKuisTantanganBulanan::with('opsi')->findOrFail($id);
        return view('admin.kuis-tantangan-bulanan.soal-kuis.edit', compact('soal', 'kuis_tantangan_bulanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kuis_tantangan_bulanan' => 'required|exists:kuis_tantangan_bulanans,id',
            'soal' => 'required|string',
            'tipe_soal' => 'required|in:Pilihan Ganda,Isian Singkat',
            'jawaban' => 'required',
        ]);

        $soal = SoalKuisTantanganBulanan::findOrFail($id);
        $soal->update([
            'id_kuis_tantangan_bulanan' => $request->kuis_tantangan_bulanan,
            'soal' => $request->soal,
            'tipe_soal' => $request->tipe_soal,
            'jawaban' => $request->jawaban,
        ]);

        // Hapus opsi lama kalau Pilihan Ganda
        if ($request->tipe_soal === 'Pilihan Ganda') {
            $soal->opsi()->delete();

            foreach ($request->options as $label => $teks) {
                if ($teks) {
                    OpsiSoalKuisTantanganBulanan::create([
                        'id_soal_tantangan' => $soal->id,
                        'label' => $label,
                        'teks_opsi' => $teks,
                    ]);
                }
            }
        }

        return redirect()->route('admin_soal-kuis-tantangan-bulanan.index')->with('success', 'Soal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoalKuisTantanganBulanan $soal_kuis_tantangan_bulanan)
    {
        $soal_kuis_tantangan_bulanan->delete();
        return redirect()->route('admin_soal-kuis-tantangan-bulanan.index')->with('success', 'Soal berhasil dihapus.');
    }
}
