<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\KuisReguler\KuisReguler;
use App\Models\TantanganBulanan\Periode;
use App\Models\KuisReguler\SoalKuisReguler;
use App\Models\KuisReguler\HasilKuisReguler;
use App\Models\KuisReguler\JawabanKuisReguler;
use App\Models\KuisReguler\OpsiSoalKuisReguler;
use App\Models\TantanganBulanan\KuisTantanganBulanan;
use App\Models\TantanganBulanan\HasilKuisTantanganBulanan;

class KuisDanTantanganController extends Controller
{
    public function index()
    {
        $kuis = KuisReguler::withCount('soal_reguler')->get();

        // Ambil periode leaderboard yang aktif
        $periode = Periode::where('status_leaderboard', 'aktif')->first();

        $tantangan = null;
        $hariTersisa = null;
        $jumlahUser = 0;
        $topUsers = collect();

        if ($periode) {
            // Ambil tantangan yang sedang berlangsung (opsional untuk info di halaman)
            $tantangan = KuisTantanganBulanan::where('id_periode', $periode->id)
                ->where('status', 'aktif')
                ->where('tanggal_mulai', '<=', now())
                ->where('tanggal_selesai', '>=', now())
                ->first();

            $hariTersisa = $tantangan ? Carbon::now()->diffInDays($tantangan->tanggal_selesai, false) : null;

            // Ambil semua id kuis dalam periode aktif
            $kuisIds = KuisTantanganBulanan::where('id_periode', $periode->id)->pluck('id');

            // Hitung peserta unik
            $jumlahUser = HasilKuisTantanganBulanan::whereIn('id_kuis_tantangan_bulanan', $kuisIds)
                ->distinct('id_user')
                ->count('id_user');

            // Ambil top 10 user berdasarkan total skor dari seluruh kuis dalam periode
            $topUsers = HasilKuisTantanganBulanan::select('id_user', DB::raw('SUM(skor) as total_skor'))
                ->whereIn('id_kuis_tantangan_bulanan', $kuisIds)
                ->groupBy('id_user')
                ->orderByDesc('total_skor')
                ->with('user')
                ->take(10)
                ->get();
        }

        return view('kuis-tantangan.index', compact(
            'kuis',
            'tantangan',
            'hariTersisa',
            'jumlahUser',
            'topUsers',
            'periode'
        ));
    }

    public function showSoalKuisReguler($slug)
    {
        $user = Auth::user();
        $kuis = DB::table('kuis_regulers')->where('slug', $slug)->first();

        if (!$kuis) {
            abort(404);
        }

        $startTimeKey = 'quiz_start_time_' . $kuis->id;

        if (!session()->has($startTimeKey)) {
            session([$startTimeKey => now()->timestamp]);
        }


        // Ambil soal dan acak urutannya
        $soal = DB::table('soal_kuis_regulers')
            ->where('id_kuis_reguler', $kuis->id)
            ->select('id', 'gambar', 'soal', 'jawaban', 'tipe_soal')
            ->get()
            ->shuffle() // Acak soal
            ->map(function ($item) {
                if ($item->tipe_soal === 'Pilihan Ganda') {
                    $opsiAsli = DB::table('opsi_soal_kuis_regulers')
                        ->where('id_soal_kuis_reguler', $item->id)
                        ->select('id', 'teks_opsi')
                        ->get()
                        ->shuffle(); // Acak hanya isi teks

                    // Tetapkan ulang label secara urut A, B, C, D...
                    $labels = ['A', 'B', 'C', 'D', 'E'];
                    $item->opsi = collect();

                    foreach ($opsiAsli as $index => $opsi) {
                        $item->opsi->push((object)[
                            'id' => $opsi->id,
                            'label' => $labels[$index],
                            'teks_opsi' => $opsi->teks_opsi,
                        ]);
                    }
                } else {
                    $item->opsi = collect();
                }
                return $item;
            });

        return view('kuis-tantangan.soal', [
            'kuis' => $kuis,
            'soal' => $soal,
            'durasi' => $kuis->durasi_menit,
        ]);
    }

    public function submit(Request $request, $slug)
    {
        try {
            DB::beginTransaction();

            // Validasi input
            $request->validate([
                'kuis_id' => 'required|exists:kuis_regulers,id',
                'durasi_pengerjaan' => 'required|integer|min:0',
                'start_time_js' => 'required|integer'
            ]);

            $kuis = KuisReguler::findOrFail($request->kuis_id);
            $soalList = SoalKuisReguler::where('id_kuis_reguler', $kuis->id)->get();

            // Hitung skor
            $jawabanBenar = 0;
            $jawabanSalah = 0;
            $jawabanDetails = [];

            foreach ($soalList as $soal) {
                $jawabanUser = $request->input("jawaban_{$soal->id}");
                $isBenar = false;

                if ($soal->tipe_soal === 'Pilihan Ganda') {
                    // Untuk pilihan ganda, bandingkan dengan ID opsi yang benar
                    if ($jawabanUser) {
                        $opsiBenar = OpsiSoalKuisReguler::where('id_soal_kuis_reguler', $soal->id)
                            ->where('label', $soal->jawaban)
                            ->first();

                        if ($opsiBenar && $jawabanUser == $opsiBenar->id) {
                            $isBenar = true;
                            $jawabanBenar++;
                        } else {
                            $jawabanSalah++;
                        }
                    } else {
                        $jawabanSalah++;
                    }
                } else if ($soal->tipe_soal === 'Isian Singkat') {
                    // Untuk isian singkat, bandingkan teks (case-insensitive)
                    if ($jawabanUser && strtolower(trim($jawabanUser)) === strtolower(trim($soal->jawaban))) {
                        $isBenar = true;
                        $jawabanBenar++;
                    } else {
                        $jawabanSalah++;
                    }
                }

                $jawabanDetails[] = [
                    'id_soal' => $soal->id,
                    'jawaban_user' => $jawabanUser ?? '',
                    'benar' => $isBenar
                ];
            }

            // Hitung skor (misalnya dari 0-100)
            $totalSoal = count($soalList);
            $skor = $totalSoal > 0 ? round(($jawabanBenar / $totalSoal) * 100) : 0;

            // Simpan hasil kuis dengan durasi
            $hasilKuis = HasilKuisReguler::create([
                'id_user' => Auth::id(),
                'id_kuis_reguler' => $kuis->id,
                'skor' => $skor,
                'jawaban_benar' => $jawabanBenar,
                'jawaban_salah' => $jawabanSalah,
                'durasi_pengerjaan' => $request->durasi_pengerjaan // Simpan durasi dalam detik
            ]);

            // Simpan detail jawaban
            foreach ($jawabanDetails as $detail) {
                JawabanKuisReguler::create([
                    'id_hasil_kuis_reguler' => $hasilKuis->id,
                    'id_soal_kuis_reguler' => $detail['id_soal'],
                    'jawaban_user' => $detail['jawaban_user'],
                    'benar' => $detail['benar']
                ]);
            }

            DB::commit();

            // Redirect ke halaman hasil
            return redirect()->route('kuis.hasil', ['slug' => $slug, 'hasil_id' => $hasilKuis->id]);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan jawaban: ' . $e->getMessage()]);
        }
    }

    // public function hasil($id)
    // {
    //     $hasil = HasilKuisReguler::with(['kuisReguler', 'user'])
    //         ->where('id', $id)
    //         ->where('id_user', Auth::id())
    //         ->firstOrFail();

    //     // Konversi durasi dari detik ke menit dan detik untuk tampilan
    //     $durasiMenit = floor($hasil->durasi_pengerjaan / 60);
    //     $durasiDetik = $hasil->durasi_pengerjaan % 60;

    //     return view('kuis.hasil', compact('hasil', 'durasiMenit', 'durasiDetik'));
    // }


    public function hasil($slug, $hasil_id)
    {
        $kuis = KuisReguler::where('slug', $slug)->firstOrFail();
        $hasil = HasilKuisReguler::where('id', $hasil_id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        return view('kuis-tantangan.hasil', compact('kuis', 'hasil'));
    }

    public function reviewJawaban($slug, $hasil_id)
    {
        $kuis = KuisReguler::where('slug', $slug)->firstOrFail();
        $hasil = HasilKuisReguler::where('id', $hasil_id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $soal = SoalKuisReguler::where('id_kuis_reguler', $kuis->id)
            ->with(['opsi', 'jawaban' => function ($query) use ($hasil_id) {
                $query->where('id_hasil_kuis_reguler', $hasil_id);
            }])
            ->orderBy('created_at')
            ->get();

        return view('kuis.review', compact('kuis', 'hasil', 'soal'));
    }

    public function riwayat($slug)
    {
        $kuis = KuisReguler::where('slug', $slug)->firstOrFail();
        $riwayat = HasilKuisReguler::where('id_kuis_reguler', $kuis->id)
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('kuis.riwayat', compact('kuis', 'riwayat'));
    }


    public function showSoalTantanganBulanan($slug)
    {
        $user = Auth::user();
        $kuis = DB::table('kuis_tantangan_bulanans')->where('slug', $slug)->first();

        if (!$kuis) {
            abort(404);
        }

        // Cek apakah user sudah submit kuis ini
        $hasil = DB::table('hasil_kuis_tantangan_bulanans')
            ->where('id_user', $user->id)
            ->where('id_kuis_tantangan_bulanan', $kuis->id)
            ->first();

        if ($hasil) {
            return view('kuis-tantangan.tantangan-bulanan.soal', [
                'kuis' => $kuis,
                'skor' => session('skor', $hasil->skor),
                'jawaban_benar' => $hasil->jawaban_benar,
                'jawaban_salah' => $hasil->jawaban_salah,
                'sudahSubmit' => true,
            ]);
        }

        // Ambil soal dan opsi
        $soal = DB::table('soal_kuis_tantangan_bulanans')
            ->where('id_kuis_tantangan_bulanan', $kuis->id)
            ->select('id', 'gambar', 'soal', 'jawaban', 'tipe_soal')
            ->get()
            ->map(function ($item) {
                if ($item->tipe_soal === 'Pilihan Ganda') {
                    $item->opsi = DB::table('opsi_soal_kuis_tantangan_bulanans')
                        ->where('id_soal_tantangan', $item->id)
                        ->select('label', 'teks_opsi')
                        ->get();
                } else {
                    $item->opsi = collect();
                }
                return $item;
            });

        return view('kuis-tantangan.tantangan-bulanan.soal', [
            'kuis' => $kuis,
            'soal' => $soal,
            'sudahSubmit' => false,
        ]);
    }

    public function submitTantanganBulanan(Request $request, $slug)
    {
        $kuis = DB::table('kuis_tantangan_bulanans')->where('slug', $slug)->first();
        $user = Auth::user();

        if (!$kuis) {
            abort(404);
        }

        // Cek apakah sudah pernah submit
        $cek = DB::table('hasil_kuis_tantangan_bulanans')
            ->where('id_user', $user->id)
            ->where('id_kuis_tantangan_bulanan', $kuis->id)
            ->first();

        if ($cek) {
            return redirect()->route('tantangan-bulanan.soal', $slug)
                ->with('info', 'Anda sudah mengerjakan kuis ini.');
        }

        // Ambil soal
        $soal = DB::table('soal_kuis_tantangan_bulanans')
            ->where('id_kuis_tantangan_bulanan', $kuis->id)
            ->select('id', 'jawaban', 'tipe_soal')
            ->get();

        $jawabanBenar = 0;
        $jawabanSalah = 0;

        foreach ($soal as $item) {
            $key = 'jawaban_' . $item->id;
            $jawabanUser = strtolower(trim($request->input($key)));
            $jawabanKunci = strtolower(trim($item->jawaban));

            if ($jawabanUser === $jawabanKunci) {
                $jawabanBenar++;
            } else {
                $jawabanSalah++;
            }
        }

        $jumlahSoal = $soal->count();
        $skorFinal = round(($jawabanBenar / $jumlahSoal) * 100);

        // Simpan hasil ke database
        DB::table('hasil_kuis_tantangan_bulanans')->insert([
            'id_user' => $user->id,
            'id_kuis_tantangan_bulanan' => $kuis->id,
            'skor' => $skorFinal,
            'jawaban_benar' => $jawabanBenar,
            'jawaban_salah' => $jawabanSalah,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('tantangan-bulanan.soal', $slug)
            ->with([
                'success' => 'Jawaban berhasil disimpan.',
                'jawaban_benar' => $jawabanBenar,
                'jawaban_salah' => $jawabanSalah,
                'skor' => $skorFinal,
            ]);
    }
}
