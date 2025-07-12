<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class PendaftaranMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_informasi_magang',
        'nama',
        'email',
        'no_hp',
        'cv_file',
        'surat_permohonan',
        'surat_motivasi',
        'is_agreed',
        'agreed_at',
        'status',
        'laporan_magang',
        'sertifikat_magang',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    protected $casts = [
        'is_agreed' => 'boolean',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function informasi_magang()
    {
        return $this->belongsTo(InformasiMagang::class, 'id_informasi_magang');
    }

    public function log_harian_magang()
    {
        return $this->hasMany(LogHarianMagangUser::class, 'id_pendaftaran_magang');
    }
}
