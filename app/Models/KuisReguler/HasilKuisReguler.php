<?php

namespace App\Models\KuisReguler;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilKuisReguler extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_kuis_reguler',
        'skor',
        'jawaban_benar',
        'jawaban_salah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kuis_reguler()
    {
        return $this->belongsTo(KuisReguler::class, 'id_kuis_reguler');
    }

    public function jawaban_kuis_reguler()
    {
        return $this->hasMany(JawabanKuisReguler::class, 'id_hasil_kuis_reguler');
    }
}
