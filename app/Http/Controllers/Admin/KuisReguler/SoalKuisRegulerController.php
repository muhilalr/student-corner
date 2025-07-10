<?php

namespace App\Http\Controllers\Admin\KuisReguler;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SoalKuisRegulerImport;
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

        $soal = SoalKuisReguler::select('id', 'id_kuis_reguler', 'file_soal')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('kuis_reguler', function ($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%');
                });
            })
            ->groupBy('id', 'id_kuis_reguler', 'file_soal')
            ->with('kuis_reguler')
            ->paginate(10);

        return view('admin.kuis-reguler.soal-kuis.index', compact('soal', 'search'));
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
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'kuis_reguler' => 'required|exists:kuis_regulers,id',
    //         'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
    //         'soal' => 'required|string',
    //         'tipe_soal' => 'required|in:Pilihan Ganda,Isian Singkat',
    //         'jawaban' => 'required|string',
    //     ]);

    //     $filePath = null;

    //     if ($request->hasFile('gambar')) {
    //         $filePath = $request->file('gambar')->store('gambar_soal_kuis_reguler', 'public');
    //     }

    //     // Simpan ke tabel soal_kuis_regulers
    //     $soal = SoalKuisReguler::create([
    //         'id_kuis_reguler' => $request->kuis_reguler,
    //         'gambar' => $filePath,
    //         'soal' => $request->soal,
    //         'tipe_soal' => $request->tipe_soal,
    //         'jawaban' => $request->jawaban,
    //     ]);

    //     // Jika pilihan ganda, simpan opsi-opsinya
    //     if ($request->tipe_soal === 'Pilihan Ganda' && $request->has('options')) {
    //         foreach ($request->options as $label => $text) {
    //             if (!empty($text)) {
    //                 OpsiSoalKuisReguler::create([
    //                     'id_soal_kuis_reguler' => $soal->id,
    //                     'label' => $label,       // A, B, C, D
    //                     'teks_opsi' => $text,    // Isi teks jawaban
    //                 ]);
    //             }
    //         }
    //     }

    //     return redirect()->route('admin_soal-kuis-reguler.index')->with('success', 'Soal berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'id_kuis_reguler' => 'required|exists:kuis_regulers,id',
            'file' => 'required|file|mimes:xlsx',
            'images.*' => 'image|mimes:jpg,jpeg,png'
        ]);

        // Simpan file Excel ke storage
        $uploadedFile = $request->file('file');
        $filename = time() . '_' . $uploadedFile->getClientOriginalName();
        $uploadedFile->storeAs('public/file_soal_kuis_reguler', $filename);

        // Simpan semua gambar ke folder dan mapping nama -> nama
        $imageMap = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->storeAs('public/gambar_soal_kuis_reguler', $imageName);
                $imageMap[$imageName] = $imageName;
            }
        }

        // Baca isi Excel dan lewati baris pertama (header)
        $collection = Excel::import(new SoalKuisRegulerImport($request->id_kuis_reguler, $filename, $imageMap), $request->file('file'));

        foreach ($collection as $row) {
            $soal = new SoalKuisReguler();
            $soal->id_kuis_reguler = $request->id_kuis_reguler;
            $soal->file_soal = $filename;
            $soal->soal = $row['soal'] ?? '';
            $soal->tipe_soal = $row['tipe_soal'] ?? 'Isian Singkat';
            $soal->jawaban = $row['jawaban'] ?? '';
            $soal->gambar = !empty($row['gambar']) && isset($imageMap[$row['gambar']])
                ? $imageMap[$row['gambar']]
                : null;
            $soal->save();

            if (strtolower($soal->tipe_soal) === 'pilihan ganda') {
                foreach (['A', 'B', 'C', 'D'] as $label) {
                    $key = 'opsi_' . strtolower($label);
                    if (!empty($row[$key])) {
                        OpsiSoalKuisReguler::create([
                            'id_soal_kuis_reguler' => $soal->id,
                            'label' => $label,
                            'teks_opsi' => $row[$key],
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin_soal-kuis-reguler.index')
            ->with('success', 'Soal kuis berhasil diimport.');
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
