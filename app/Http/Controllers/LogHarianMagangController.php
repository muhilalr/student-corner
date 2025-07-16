<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiMagang;
use App\Models\LogHarianMagangUser;
use App\Models\PendaftaranMagang;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Auth;

class LogHarianMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $slug_bidang, $slug_posisi)
    {
        $user = Auth::user();

        $info = InformasiMagang::where('slug_bidang', $slug_bidang)
            ->where('slug_posisi', $slug_posisi)
            ->firstOrFail();

        $pendaftaran = PendaftaranMagang::with('informasi_magang')
            ->where('user_id', $user->id)
            ->where('status', 'diterima')
            ->whereHas('informasi_magang', function ($query) use ($slug_bidang, $slug_posisi) {
                $query->where('slug_bidang', $slug_bidang)
                    ->where('slug_posisi', $slug_posisi);
            })
            ->firstOrFail();

        $logs = LogHarianMagangUser::where('id_pendaftaran_magang', $pendaftaran->id)
            ->when($request->start_date, function ($query) use ($request) {
                $query->whereDate('tanggal', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                $query->whereDate('tanggal', '<=', $request->end_date);
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status_kehadiran', $request->status);
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(3)
            ->withQueryString(); // agar filter tetap saat pindah halaman

        return view('program-magang.log-harian', compact('info', 'logs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($slug_bidang, $slug_posisi)
    {
        $user = Auth::user();
        $info = InformasiMagang::where('slug_bidang', $slug_bidang)->where('slug_posisi', $slug_posisi)->first();
        $pendaftaran = PendaftaranMagang::with('informasi_magang')
            ->where('user_id', $user->id)
            ->where('status', 'diterima')
            ->whereHas('informasi_magang', function ($query) use ($slug_bidang, $slug_posisi) {
                $query->where('slug_bidang', $slug_bidang)
                    ->where('slug_posisi', $slug_posisi);
            })
            ->first();

        return view('program-magang.create-log', compact('pendaftaran', 'info'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $slug_bidang, $slug_posisi)
    {
        $request->validate([
            'id_pendaftaran_magang' => 'required|exists:pendaftaran_magangs,id',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required|in:hadir,sakit,izin',
            'uraian_kegiatan' => 'required',
            'catatan' => 'nullable',
        ]);

        LogHarianMagangUser::create([
            'id_pendaftaran_magang' => $request->id_pendaftaran_magang,
            'tanggal' => $request->tanggal,
            'status_kehadiran' => $request->status_kehadiran,
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('daftar-magang.log-harian', ['slug_bidang' => $slug_bidang, 'slug_posisi' => $slug_posisi])
            ->with('success', 'Log harian berhasil ditambahkan.');
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
    public function edit($slug_bidang, $slug_posisi, $id)
    {
        $user = Auth::user();
        $info = InformasiMagang::where('slug_bidang', $slug_bidang)->where('slug_posisi', $slug_posisi)->first();
        $log = LogHarianMagangUser::with('pendaftaran_magang')
            ->where('id', $id)
            ->whereHas('pendaftaran_magang', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->first();

        if (!$log) {
            abort(404);
        }
        return view('program-magang.edit-log', compact('log', 'info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug_bidang, $slug_posisi, $id)
    {
        $request->validate([
            'id_pendaftaran_magang' => 'required|exists:pendaftaran_magangs,id',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required|in:hadir,sakit,izin',
            'uraian_kegiatan' => 'required',
            'catatan' => 'nullable',
        ]);

        $log = LogHarianMagangUser::findOrFail($id);
        $log->update([
            'id_pendaftaran_magang' => $request->id_pendaftaran_magang,
            'tanggal' => $request->tanggal,
            'status_kehadiran' => $request->status_kehadiran,
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('daftar-magang.log-harian', ['slug_bidang' => $slug_bidang, 'slug_posisi' => $slug_posisi])
            ->with('success', 'Log harian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug_bidang, $slug_posisi, $id)
    {
        LogHarianMagangUser::findOrFail($id)->delete();
        return redirect()->route('daftar-magang.log-harian', ['slug_bidang' => $slug_bidang, 'slug_posisi' => $slug_posisi])
            ->with('success', 'Log harian berhasil dihapus.');
    }
}
