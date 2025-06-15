<?php

namespace App\Models\KuisReguler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalKuisReguler extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kuis_reguler',
        'soal',
        'tipe_soal',
        'jawaban',
    ];

    public function kuis_reguler()
    {
        return $this->belongsTo(KuisReguler::class, 'id_kuis_reguler');
    }

    public function opsi_soal_reguler()
    {
        return $this->hasMany(OpsiSoalKuisReguler::class, 'id_soal_kuis_reguler');
    }
}
