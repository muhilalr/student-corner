<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHarianMagangUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pendaftaran_magang',
        'nama_kegiatan',
        'uraian_kegiatan',
        'gambar',
    ];

    public function pendaftaran_magang()
    {
        return $this->belongsTo(PendaftaranMagang::class, 'id_pendaftaran_magang');
    }
}
