<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Infografis extends Model
{
    use HasFactory;

    protected $fillable = [
        'subjek_materi_id',
        'judul',
        'deskripsi',
        'gambar',
        'file_infografis',
    ];

    public function subjek_materi()
    {
        return $this->belongsTo(SubjekMateri::class, 'subjek_materi_id');
    }
}
