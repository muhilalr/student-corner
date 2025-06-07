<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PendaftaranMagang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'no_hp' => 'required|string|max:20',
        //     'cv_file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        //     'surat_motivasi' => 'nullable|string',
        //     'is_agreed' => 'accepted',
        // ]);

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

        // Upload CV file
        $cvPath = null;
        if ($request->hasFile('cv_file')) {
            $cvPath = $request->file('cv_file')->store('cv_files', 'public');
        }

        // Simpan data pendaftaran
        PendaftaranMagang::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
            'no_hp' => $user->no_hp,
            'cv_file' => $cvPath,
            'surat_motivasi' => $request->surat_motivasi,
            'status' => 'diproses', // status default
            'is_agreed' => true,
            'agreed_at' => now(),
        ]);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
