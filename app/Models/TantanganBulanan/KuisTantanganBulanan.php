<?php

namespace App\Models\TantanganBulanan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KuisTantanganBulanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function soal_tantangan_bulanan()
    {
        return $this->hasMany(SoalKuisTantanganBulanan::class, 'id_kuis_tantangan_bulanan');
    }

    public function hasil_tantangan_bulanan()
    {
        return $this->hasMany(HasilKuisTantanganBulanan::class, 'id_kuis_tantangan_bulanan');
    }
}
