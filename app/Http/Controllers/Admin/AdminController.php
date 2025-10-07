<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Artikel;
use App\Models\Infografis;
use Illuminate\Http\Request;
use App\Models\PendaftaranRiset;
use App\Models\PendaftaranMagang;
use App\Models\VideoPembelajaran;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\KuisReguler\KuisReguler;
use App\Models\TantanganBulanan\Periode;
use App\Models\ProgresBelajar\ArtikelDibaca;
use App\Models\TantanganBulanan\KuisTantanganBulanan;
use App\Models\TantanganBulanan\HasilKuisTantanganBulanan;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('roles')->get();
        return view('admin.index', compact('admins'));
    }

    public function dashboard()
    {
        $artikel_populer = Artikel::select('artikels.*', DB::raw('COUNT(artikel_dibacas.id) as total_dibaca'))
            ->leftJoin('artikel_dibacas', 'artikels.id', '=', 'artikel_dibacas.id_artikel')
            ->groupBy('artikels.id')
            ->orderByDesc('total_dibaca')
            ->first();


        $video_populer = VideoPembelajaran::select('video_pembelajarans.*', DB::raw('COUNT(video_dilihats.id) as total_dilihat'))
            ->leftJoin('video_dilihats', 'video_pembelajarans.id', '=', 'video_dilihats.id_video')
            ->groupBy('video_pembelajarans.id')
            ->orderByDesc('total_dilihat')
            ->first();

        $infografis_populer = Infografis::select('infografis.*', DB::raw('COUNT(infografis_dilihats.id) as total_dilihat'))
            ->leftJoin('infografis_dilihats', 'infografis.id', '=', 'infografis_dilihats.id_infografis')
            ->groupBy('infografis.id')
            ->orderByDesc('total_dilihat')
            ->first();

        $periode = Periode::where('status_leaderboard', 'aktif')->first();
        // Ambil semua id kuis dalam periode aktif
        $kuisId = KuisTantanganBulanan::where('id_periode', $periode->id)->pluck('id');
        // Ambil top 10 user berdasarkan total skor dari seluruh kuis dalam periode
        $topUsers = HasilKuisTantanganBulanan::select('id_user', DB::raw('SUM(skor) as total_skor'))
            ->whereIn('id_kuis_tantangan_bulanan', $kuisId)
            ->groupBy('id_user')
            ->orderByDesc('total_skor')
            ->with('user')
            ->take(10)
            ->get();
        return view('admin.dashboard', [
            'user' => User::count(),
            'pendaftar_magang' => PendaftaranMagang::where('status', 'diproses')->count(),
            'pendaftar_riset' => PendaftaranRiset::where('status', 'diproses')->count(),
            'artikel' => Artikel::count(),
            'video' => VideoPembelajaran::count(),
            'infografis' => Infografis::count(),
            'kuis_reguler' => KuisReguler::count(),
            'kuis_tantangan' => KuisTantanganBulanan::count(),
            'artikel_populer' => $artikel_populer,
            'video_populer' => $video_populer,
            'infografis_populer' => $infografis_populer,
            'top_users' => $topUsers,
            'periode' => $periode
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Admin $data_admin)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.edit', compact('data_admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $data_admin)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed', // hanya jika ingin ganti password
            'role' => 'required|exists:roles,name',
        ]);

        // Update field biasa
        $data_admin->username = $request->username;

        // Update password jika diisi
        if ($request->filled('password')) {
            $data_admin->password = Hash::make($request->password);
        }

        $data_admin->save();

        // Update role
        $data_admin->syncRoles([$request->role]);

        return redirect()->route('admin_data-admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $data_admin)
    {
        $data_admin->delete();
        return redirect()->route('admin_data-admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}
