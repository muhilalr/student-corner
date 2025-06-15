<?php

namespace App\Models\TantanganBulanan;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilKuisTantanganBulanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_kuis_tantangan_bulanan',
        'skor',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kuis_tantangan_bulanan()
    {
        return $this->belongsTo(KuisTantanganBulanan::class, 'id_kuis_tantangan_bulanan');
    }
}
