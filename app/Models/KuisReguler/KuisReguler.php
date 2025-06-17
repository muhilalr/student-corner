<?php

namespace App\Models\KuisReguler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuisReguler extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'slug'
    ];

    public function soal_reguler()
    {
        return $this->hasMany(SoalKuisReguler::class, 'id_kuis_reguler');
    }

    public function hasil_kuis_reguler()
    {
        return $this->hasMany(HasilKuisReguler::class, 'id_kuis_reguler');
    }
}
