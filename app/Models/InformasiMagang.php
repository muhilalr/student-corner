<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bidang',
        'posisi',
        'deskripsi',
        'persyaratan',
        'benefit',
        'info_kontak',
    ];

    public function pendaftaran_magangs()
    {
        return $this->hasMany(PendaftaranMagang::class, 'id_informasi_magang');
    }
}
