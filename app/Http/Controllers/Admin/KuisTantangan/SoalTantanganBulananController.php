<?php

namespace App\Http\Controllers\Admin\KuisTantangan;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\SoalTantanganBulananImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Models\TantanganBulanan\KuisTantanganBulanan;
use App\Models\TantanganBulanan\SoalKuisTantanganBulanan;
use App\Models\TantanganBulanan\OpsiSoalKuisTantanganBulanan;

class SoalTantanganBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $soal = SoalKuisTantanganBulanan::with('kuis_tantangan_bulanan')
            ->select('upload_batch_id', 'id_kuis_tantangan_bulanan', 'file_soal', DB::raw('MAX(created_at) as created_at'))
            ->when($search, function ($query, $search) {
                $query->whereHas('kuis_tantangan_bulanan', function ($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%');
                });
            })
            ->groupBy('upload_batch_id', 'id_kuis_tantangan_bulanan', 'file_soal')
            ->orderByDesc('created_at')
            ->paginate(10);

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
        $kuis_tantangan_bulanan = KuisTantanganBulanan::with('periode')->get();
        return view('admin.kuis-tantangan-bulanan.soal-kuis.create', compact('kuis_tantangan_bulanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kuis_tantangan_bulanan' => 'required|exists:kuis_tantangan_bulanans,id',
            'file' => 'required|file|mimes:xlsx',
            'images.*' => 'image|mimes:jpg,jpeg,png'
        ]);

        // Simpan file Excel ke storage
        $uploadedFile = $request->file('file');
        $filename = time() . '_' . $uploadedFile->getClientOriginalName();
        Storage::disk('public')->putFileAs('file_soal_kuis_tantangan_bulanan', $uploadedFile, $filename);

        // Simpan semua gambar ke folder dan mapping nama -> nama
        $imageMap = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                Storage::disk('public')->putFileAs('gambar_soal_kuis_tantangan_bulanan', $image, $imageName);
                $imageMap[$imageName] = $imageName;
            }
        }

        // Generate batch ID
        $batchId = Str::uuid();

        // Baca isi Excel dan lewati baris pertama (header)
        Excel::import(new SoalTantanganBulananImport($request->id_kuis_tantangan_bulanan, $filename, $imageMap, $batchId), $uploadedFile);

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
    // public function edit($id)
    // {
    //     $kuis_tantangan_bulanan = KuisTantanganBulanan::all();
    //     $soal = SoalKuisTantanganBulanan::with('opsi')->findOrFail($id);
    //     return view('admin.kuis-tantangan-bulanan.soal-kuis.edit', compact('soal', 'kuis_tantangan_bulanan'));
    // }

    public function editBatch($batchId)
    {
        $kuis_tantangan_bulanan = KuisTantanganBulanan::with('periode')->get();
        $batch = SoalKuisTantanganBulanan::where('upload_batch_id', $batchId)->firstOrFail();

        return view('admin.kuis-tantangan-bulanan.soal-kuis.edit', compact('batch', 'kuis_tantangan_bulanan'));
    }
    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, SoalKuisTantanganBulanan $soal)
    // {
    //     $request->validate([
    //         'kuis_tantangan_bulanan' => 'required|exists:kuis_tantangan_bulanans,id',
    //         'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
    //         'soal' => 'required|string',
    //         'tipe_soal' => 'required|in:Pilihan Ganda,Isian Singkat',
    //         'jawaban' => 'required',
    //     ]);

    //     if ($request->hasFile('gambar')) {
    //         if ($soal->gambar) {
    //             Storage::disk('public')->delete($soal->gambar);
    //         }
    //         $filePath = $request->file('gambar')->store('gambar_soal_kuis_tantangan_bulanan', 'public');
    //         $soal->gambar = $filePath;
    //     }

    //     $soal->update([
    //         'id_kuis_tantangan_bulanan' => $request->kuis_tantangan_bulanan,
    //         'soal' => $request->soal,
    //         'tipe_soal' => $request->tipe_soal,
    //         'jawaban' => $request->jawaban,
    //     ]);

    //     // Hapus opsi lama kalau Pilihan Ganda
    //     if ($request->tipe_soal === 'Pilihan Ganda') {
    //         $soal->opsi()->delete();

    //         foreach ($request->options as $label => $teks) {
    //             if ($teks) {
    //                 OpsiSoalKuisTantanganBulanan::create([
    //                     'id_soal_tantangan' => $soal->id,
    //                     'label' => $label,
    //                     'teks_opsi' => $teks,
    //                 ]);
    //             }
    //         }
    //     }

    //     return redirect()->route('admin_soal-kuis-tantangan-bulanan.index')->with('success', 'Soal berhasil diperbarui.');
    // }

    public function updateBatch(Request $request, $batchId)
    {
        $request->validate([
            'id_kuis_tantangan_bulanan' => 'required|exists:kuis_tantangan_bulanans,id',
            'file' => 'required|file|mimes:xlsx',
            'images.*' => 'image|mimes:jpg,jpeg,png',
        ]);

        // Ambil semua soal lama berdasarkan batch
        $oldSoal = SoalKuisTantanganBulanan::where('upload_batch_id', $batchId)->get();

        // Ambil nama file excel lama
        $oldFile = optional($oldSoal->first())->file_soal;

        // Ambil semua gambar yang digunakan dalam batch ini
        $gambarLama = $oldSoal->pluck('gambar')->filter()->unique();

        // Hapus semua soal dan opsi pilihan gandanya
        foreach ($oldSoal as $soal) {
            if ($soal->tipe_soal === 'Pilihan Ganda') {
                $soal->opsi()->delete();
            }
            $soal->delete();
        }

        // Hapus file excel lama
        if ($oldFile) {
            Storage::disk('public')->delete('file_soal_kuis_tantangan_bulanan/' . $oldFile);
        }

        // Hapus gambar lama dari storage jika tidak dipakai soal lain
        foreach ($gambarLama as $gambar) {
            $masihDipakai = SoalKuisTantanganBulanan::where('gambar', $gambar)->exists();
            if (!$masihDipakai) {
                Storage::disk('public')->delete('gambar_soal_kuis_tantangan_bulanan/' . $gambar);
            }
        }

        // Simpan file excel baru
        $uploadedFile = $request->file('file');
        $filename = time() . '_' . $uploadedFile->getClientOriginalName();
        Storage::disk('public')->putFileAs('file_soal_kuis_tantangan_bulanan', $uploadedFile, $filename);

        // Upload gambar baru
        $imageMap = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                Storage::disk('public')->putFileAs('gambar_soal_kuis_tantangan_bulanan', $image, $imageName);
                $imageMap[$imageName] = $imageName;
            }
        }

        // Import data baru dengan batch ID lama
        Excel::import(
            new SoalTantanganBulananImport(
                $request->id_kuis_tantangan_bulanan,
                $filename,
                $imageMap,
                $batchId
            ),
            $uploadedFile
        );

        return redirect()->route('admin_soal-kuis-tantangan-bulanan.index')->with('success', 'Soal kuis berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(SoalKuisTantanganBulanan $soal_kuis_tantangan_bulanan)
    // {
    //     if ($soal_kuis_tantangan_bulanan->gambar) {
    //         Storage::disk('public')->delete($soal_kuis_tantangan_bulanan->gambar);
    //     }
    //     $soal_kuis_tantangan_bulanan->delete();
    //     return redirect()->route('admin_soal-kuis-tantangan-bulanan.index')->with('success', 'Soal berhasil dihapus.');
    // }

    public function destroyBatch($batchId)
    {
        // Ambil semua soal dalam batch
        $soalBatch = SoalKuisTantanganBulanan::where('upload_batch_id', $batchId)->get();

        foreach ($soalBatch as $soal) {
            // Hapus gambar jika ada
            if ($soal->gambar) {
                Storage::disk('public')->delete('gambar_soal_kuis_tantangan_bulanan/' . $soal->gambar);
            }

            // Hapus opsi jika tipe soal pilihan ganda
            if ($soal->tipe_soal === 'Pilihan Ganda') {
                $soal->opsi()->delete();
            }

            // Hapus soal
            $soal->delete();
        }

        // Hapus file Excel (gunakan file dari soal pertama)
        if ($soalBatch->isNotEmpty()) {
            Storage::disk('public')->delete('file_soal_kuis_tantangan_bulanan/' . $soalBatch[0]->file_soal);
        }

        return redirect()->route('admin_soal-kuis-tantangan-bulanan.index')
            ->with('success', 'Batch soal berhasil dihapus.');
    }
}
