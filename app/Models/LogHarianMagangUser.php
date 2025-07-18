<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHarianMagangUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pendaftaran_magang',
        'tanggal',
        'uraian_kegiatan',
        'status_kehadiran',
        'catatan',
        'status_verifikasi',
    ];

    public function pendaftaran_magang()
    {
        return $this->belongsTo(PendaftaranMagang::class, 'id_pendaftaran_magang');
    }
}
