<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Mail\MailMagangDitolak;
use App\Mail\MailMagangDiterima;
use App\Models\PendaftaranMagang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\PendaftaranMagang as MailPendaftaranMagang;

class PendaftaranMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Cek apakah user sudah pernah mendaftar dan statusnya belum selesai
        $pendaftaran = PendaftaranMagang::where('user_id', $user->id)
            ->where('status', '!=', 'selesai')
            ->first();

        return view('program-magang.daftar-magang', compact('pendaftaran'));
    }

    public function index_admin()
    {
        $pendaftaran = PendaftaranMagang::all();
        return view('admin.pendaftaran-magang.index', compact('pendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();


        // Cek apakah user sudah pernah mendaftar dan statusnya belum selesai
        $existingPendaftaran = PendaftaranMagang::where('user_id', $user->id)
            ->where('status', '!=', 'selesai')
            ->first();

        if ($existingPendaftaran) {
            return redirect()->route('daftar-magang.index')
                ->with('error', 'Anda sudah memiliki pendaftaran yang sedang diproses.');
        }

        $request->validate([
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB
            'surat_motivasi' => 'nullable|string',
            'is_agreed' => 'required|accepted',
        ]);

        $filePath = $request->file('cv_file')->store('cv_magang_user', 'public');

        // Simpan data pendaftaran
        $pendaftaran = PendaftaranMagang::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
            'no_hp' => $user->no_hp,
            'cv_file' => $filePath,
            'surat_motivasi' => $request->surat_motivasi,
            'status' => 'diproses', // status default
            'is_agreed' => true,
            'agreed_at' => now(),
        ]);

        Mail::to($pendaftaran->email)->queue(new MailPendaftaranMagang($pendaftaran));

        return redirect()->route('daftar-magang.index')
            ->with('success', 'Pendaftaran berhasil dikirim!');
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
    public function edit(PendaftaranMagang $pendaftaran_magang)
    {
        return view('admin.pendaftaran-magang.edit', compact('pendaftaran_magang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PendaftaranMagang $pendaftaran_magang)
    {
        $request->validate([
            'status' => 'required',
        ]);

        // Simpan status lama untuk pengecekan
        $statusLama = $pendaftaran_magang->status;
        $statusBaru = $request->status;

        // Update status
        $pendaftaran_magang->update([
            'status' => $statusBaru,
        ]);

        // Kirim email hanya jika status berubah dari 'diproses' ke 'diterima' atau 'ditolak'
        if ($statusLama === 'diproses' && in_array($statusBaru, ['diterima', 'ditolak'])) {
            if ($statusBaru === 'diterima') {
                // Kirim email diterima
                Mail::to($pendaftaran_magang->email)->queue(new MailMagangDiterima($pendaftaran_magang));
            } elseif ($statusBaru === 'ditolak') {
                // Kirim email ditolak
                Mail::to($pendaftaran_magang->email)->queue(new MailMagangDitolak($pendaftaran_magang));
            }
        }

        return redirect()->route('admin_daftar-magang.index-admin')
            ->with('success', 'Status pendaftaran berhasil diperbarui dan email notifikasi telah dikirim');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendaftaranMagang $pendaftaran_magang)
    {
        Storage::disk('public')->delete($pendaftaran_magang->cv_file);
        $pendaftaran_magang->delete();
        return redirect()->route('admin_daftar-magang.index-admin')->with('success', 'Data Pendaftar Magang berhasil dihapus');
    }
}
