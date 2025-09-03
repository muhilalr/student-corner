<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiMagang;
use App\Models\PendaftaranMagang;
use App\Models\LogHarianMagangUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Container\Attributes\Log;
use App\Mail\NotifikasiLogHarianMagangUser;

class LogHarianMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $pendaftaran = PendaftaranMagang::where('user_id', $user->id)
            ->where('status', 'diterima')
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
            ->paginate(10)
            ->withQueryString(); // agar filter tetap saat pindah halaman

        return view('program-magang.log-harian', compact('logs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        $pendaftaran = PendaftaranMagang::where('user_id', $user->id)
            ->where('status', 'diterima')
            ->first();

        return view('program-magang.create-log', compact('pendaftaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pendaftaran_magang' => 'required|exists:pendaftaran_magangs,id',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required|in:hadir,sakit,izin',
            'uraian_kegiatan' => 'required',
            'catatan' => 'nullable',
        ]);

        $log = LogHarianMagangUser::create([
            'id_pendaftaran_magang' => $request->id_pendaftaran_magang,
            'tanggal' => $request->tanggal,
            'status_kehadiran' => $request->status_kehadiran,
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'catatan' => $request->catatan,
            'status_verifikasi' => 'pending',
        ]);

        $log->load('pendaftaran_magang');

        Mail::to(env('ADMIN_EMAIL'))->queue(new NotifikasiLogHarianMagangUser($log));

        return redirect()->route('daftar-magang.log-harian')
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
    public function edit($id)
    {
        $user = Auth::user();
        $log = LogHarianMagangUser::with('pendaftaran_magang')
            ->where('id', $id)
            ->whereHas('pendaftaran_magang', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->first();

        if (!$log) {
            abort(404);
        }
        return view('program-magang.edit-log', compact('log'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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

        return redirect()->route('daftar-magang.log-harian')
            ->with('success', 'Log harian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        LogHarianMagangUser::findOrFail($id)->delete();
        return redirect()->route('daftar-magang.log-harian')
            ->with('success', 'Log harian berhasil dihapus.');
    }
}
