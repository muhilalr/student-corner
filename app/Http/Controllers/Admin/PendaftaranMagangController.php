<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\MailMagangDitolak;
use App\Models\InformasiMagang;
use App\Mail\MailMagangDiterima;
use App\Models\PendaftaranMagang;
use App\Mail\SertifikatMagangMail;
use App\Mail\NotifikasiMagangAdmin;
use App\Models\LogHarianMagangUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Colors\Rgb\Channels\Red;
use App\Mail\PendaftaranMagang as MailPendaftaranMagang;

class PendaftaranMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug_bidang, $slug_posisi)
    {
        $user = Auth::user();

        $info = InformasiMagang::where('slug_bidang', $slug_bidang)->where('slug_posisi', $slug_posisi)->first();

        // Cek apakah user sudah pernah mendaftar dan statusnya belum selesai
        $pendaftaran = PendaftaranMagang::with('informasi_magang')
            ->where('user_id', $user->id)
            ->where('status', '!=', 'selesai')
            ->whereHas('informasi_magang', function ($query) use ($slug_bidang, $slug_posisi) {
                $query->where('slug_bidang', $slug_bidang)
                    ->where('slug_posisi', $slug_posisi);
            })
            ->first();

        return view('program-magang.daftar-magang', compact('pendaftaran', 'info'));
    }

    public function index_admin(Request $request)
    {
        $search = $request->input('search');
        $pendaftaran = PendaftaranMagang::with('informasi_magang')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhereHas('informasi_magang', function ($q) use ($search) {
                        $q->where('nama_bidang', 'like', '%' . $search . '%')
                            ->orWhere('posisi', 'like', '%' . $search . '%');
                    });
            })
            ->where('status', 'diproses')
            ->latest()
            ->paginate(10);
        return view('admin.pendaftaran-magang.index', compact('pendaftaran'));
    }

    public function magangDiterima(Request $request)
    {
        $search = $request->input('search');
        $pendaftaran = PendaftaranMagang::with('informasi_magang')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhereHas('informasi_magang', function ($q) use ($search) {
                        $q->where('nama_bidang', 'like', '%' . $search . '%')
                            ->orWhere('posisi', 'like', '%' . $search . '%');
                    });
            })
            ->where('status', 'diterima')
            ->latest()
            ->paginate(10);
        return view('admin.pendaftaran-magang.pendaftar-diterima', compact('pendaftaran'));
    }

    public function magangDitolak(Request $request)
    {
        $search = $request->input('search');
        $pendaftaran = PendaftaranMagang::with('informasi_magang')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhereHas('informasi_magang', function ($q) use ($search) {
                        $q->where('nama_bidang', 'like', '%' . $search . '%')
                            ->orWhere('posisi', 'like', '%' . $search . '%');
                    });
            })
            ->where('status', 'ditolak')
            ->latest()
            ->paginate(10);
        return view('admin.pendaftaran-magang.pendaftar-ditolak', compact('pendaftaran'));
    }

    public function riwayatMagang(Request $request)
    {
        $search = $request->input('search');
        $pendaftaran = PendaftaranMagang::with('informasi_magang')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhereHas('informasi_magang', function ($q) use ($search) {
                        $q->where('nama_bidang', 'like', '%' . $search . '%')
                            ->orWhere('posisi', 'like', '%' . $search . '%');
                    });
            })
            ->where('status', 'selesai')
            ->latest()
            ->paginate(10);
        return view('admin.pendaftaran-magang.riwayat-pendaftar', compact('pendaftaran'));
    }

    public function logHarian($pendaftaran_id)
    {
        $pendaftaran = PendaftaranMagang::findOrFail($pendaftaran_id);
        $logs = LogHarianMagangUser::with('pendaftaran_magang')
            ->where('id_pendaftaran_magang', $pendaftaran_id)->paginate(10);
        return view('admin.pendaftaran-magang.log-harian', compact('logs', 'pendaftaran'));
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
            'id_informasi_magang' => 'required|exists:informasi_magangs,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'surat_permohonan' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB
            'surat_motivasi' => 'nullable|string',
            'is_agreed' => 'required|accepted',
        ]);

        $fileCV = $request->file('cv_file')->store('cv_magang_user', 'public');
        $filePermohonan = $request->file('surat_permohonan')->store('surat_permohonan_magang_user', 'public');

        // Simpan data pendaftaran
        $pendaftaran = PendaftaranMagang::create([
            'user_id' => $user->id,
            'id_informasi_magang' => $request->id_informasi_magang,
            'nama' => $user->name,
            'email' => $user->email,
            'no_hp' => $user->no_hp,
            'cv_file' => $fileCV,
            'surat_permohonan' => $filePermohonan,
            'surat_motivasi' => $request->surat_motivasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'diproses', // status default
            'is_agreed' => true,
            'agreed_at' => now(),
        ]);

        $pendaftaran->load('informasi_magang');

        Mail::to($pendaftaran->email)->queue(new MailPendaftaranMagang($pendaftaran));
        Mail::to(env('ADMIN_EMAIL'))->queue(new NotifikasiMagangAdmin($pendaftaran));

        return redirect()->route('daftar-magang.index', ['slug_bidang' => $pendaftaran->informasi_magang->slug_bidang, 'slug_posisi' => $pendaftaran->informasi_magang->slug_posisi])
            ->with('success', 'Pendaftaran berhasil dikirim!');
    }

    public function uploadLaporan(Request $request, PendaftaranMagang $pendaftaran_magang)
    {
        $request->validate([
            'laporan_magang' => 'required|file|mimes:pdf',
        ]);

        if ($pendaftaran_magang->laporan_magang) {
            Storage::disk('public')->delete($pendaftaran_magang->laporan_magang);
        }

        $file = $request->file('laporan_magang');
        $namaFile = Auth::user()->slug . '.' . $file->getClientOriginalName();

        $filePath = $file->storeAs('laporan_magang', $namaFile, 'public');

        $pendaftaran_magang->update([
            'laporan_magang' => $filePath,
        ]);

        $pendaftaran_magang->load('informasi_magang');

        return redirect()->route('daftar-magang.index', ['slug_bidang' => $pendaftaran_magang->informasi_magang->slug_bidang, 'slug_posisi' => $pendaftaran_magang->informasi_magang->slug_posisi])->with('success', 'Laporan Magang berhasil diunggah');
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

    public function editDiterima(PendaftaranMagang $pendaftaran_magang)
    {
        return view('admin.pendaftaran-magang.edit-diterima', compact('pendaftaran_magang'));
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

        $pendaftaran_magang->load('informasi_magang');

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

    public function editSertifikat(PendaftaranMagang $pendaftaran_magang)
    {
        return view('admin.pendaftaran-magang.upload-sertifikat', compact('pendaftaran_magang'));
    }


    public function uploadSertifikat(Request $request, PendaftaranMagang $pendaftaran_magang)
    {
        $request->validate([
            'sertifikat_magang' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        if ($pendaftaran_magang->sertifikat_magang) {
            Storage::disk('public')->delete($pendaftaran_magang->sertifikat_magang);
        }

        $file = $request->file('sertifikat_magang')->store('sertifikat_magang_user', 'public');

        $pendaftaran_magang->update([
            'sertifikat_magang' => $file,
        ]);

        Mail::to($pendaftaran_magang->email)->queue(new SertifikatMagangMail($pendaftaran_magang));

        return redirect()->route('admin_daftar-magang.riwayatMagang')->with('success', 'Sertifikat Magang berhasil diunggah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendaftaranMagang $pendaftaran_magang)
    {
        Storage::disk('public')->delete($pendaftaran_magang->cv_file);
        Storage::disk('public')->delete($pendaftaran_magang->surat_permohonan);
        $pendaftaran_magang->delete();
        return redirect()->route('admin_daftar-magang.index-admin')->with('success', 'Data Pendaftar Magang berhasil dihapus');
    }
}
