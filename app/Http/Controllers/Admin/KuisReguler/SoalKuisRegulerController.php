<?php

namespace App\Http\Controllers\Admin\KuisReguler;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KuisReguler\KuisReguler;
use Illuminate\Support\Facades\Storage;
use App\Models\KuisReguler\SoalKuisReguler;
use App\Models\KuisReguler\OpsiSoalKuisReguler;

class SoalKuisRegulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $soal = SoalKuisReguler::with('kuis_reguler')
            ->when($search, function ($query, $search) {
                $query->where('soal', 'like', '%' . $search . '%')
                    ->orWhere('jawaban', 'like', '%' . $search . '%')
                    ->orWhereHas('kuis_reguler', function ($q) use ($search) {
                        $q->where('judul', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('admin.kuis-reguler.soal-kuis.index', compact('soal'));
    }

    public function indexOpsi()
    {
        $opsi = OpsiSoalKuisReguler::with('soal_kuis_reguler')->paginate(12);
        return view('admin.kuis-reguler.opsi-soal-pilgan.index', compact('opsi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kuis_reguler = KuisReguler::all();
        return view('admin.kuis-reguler.soal-kuis.create', compact('kuis_reguler'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kuis_reguler' => 'required|exists:kuis_regulers,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
            'soal' => 'required|string',
            'tipe_soal' => 'required|in:Pilihan Ganda,Isian Singkat',
            'jawaban' => 'required|string',
        ]);

        $filePath = null;

        if ($request->hasFile('gambar')) {
            $filePath = $request->file('gambar')->store('gambar_soal_kuis_reguler', 'public');
        }

        // Simpan ke tabel soal_kuis_regulers
        $soal = SoalKuisReguler::create([
            'id_kuis_reguler' => $request->kuis_reguler,
            'gambar' => $filePath,
            'soal' => $request->soal,
            'tipe_soal' => $request->tipe_soal,
            'jawaban' => $request->jawaban,
        ]);

        // Jika pilihan ganda, simpan opsi-opsinya
        if ($request->tipe_soal === 'Pilihan Ganda' && $request->has('options')) {
            foreach ($request->options as $label => $text) {
                if (!empty($text)) {
                    OpsiSoalKuisReguler::create([
                        'id_soal_kuis_reguler' => $soal->id,
                        'label' => $label,       // A, B, C, D
                        'teks_opsi' => $text,    // Isi teks jawaban
                    ]);
                }
            }
        }

        return redirect()->route('admin_soal-kuis-reguler.index')->with('success', 'Soal berhasil ditambahkan.');
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
        $kuis_reguler = KuisReguler::all();
        $soal = SoalKuisReguler::with('opsi')->findOrFail($id);
        return view('admin.kuis-reguler.soal-kuis.edit', compact('soal', 'kuis_reguler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SoalKuisReguler $soal)
    {
        $request->validate([
            'kuis_reguler' => 'required|exists:kuis_regulers,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
            'soal' => 'required|string',
            'tipe_soal' => 'required|in:Pilihan Ganda,Isian Singkat',
            'jawaban' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            if ($soal->gambar) {
                Storage::disk('public')->delete($soal->gambar);
            }
            $filePath = $request->file('gambar')->store('gambar_soal_kuis_reguler', 'public');
            $soal->gambar = $filePath;
        }


        $soal->update([
            'id_kuis_reguler' => $request->kuis_reguler,
            'soal' => $request->soal,
            'tipe_soal' => $request->tipe_soal,
            'jawaban' => $request->jawaban,
        ]);

        // Hapus opsi lama kalau Pilihan Ganda
        if ($request->tipe_soal === 'Pilihan Ganda') {
            $soal->opsi()->delete();

            foreach ($request->options as $label => $teks) {
                if ($teks) {
                    OpsiSoalKuisReguler::create([
                        'id_soal_kuis_reguler' => $soal->id,
                        'label' => $label,
                        'teks_opsi' => $teks,
                    ]);
                }
            }
        }

        return redirect()->route('admin_soal-kuis-reguler.index')->with('success', 'Soal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoalKuisReguler $soal_kuis_reguler)
    {
        if ($soal_kuis_reguler->gambar) {
            Storage::disk('public')->delete($soal_kuis_reguler->gambar);
        }
        $soal_kuis_reguler->delete();
        return redirect()->route('admin_soal-kuis-reguler.index')->with('success', 'Soal berhasil dihapus.');
    }
}
