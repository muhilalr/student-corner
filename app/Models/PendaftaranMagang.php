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
        'nama',
        'email',
        'no_hp',
        'cv_file',
        'surat_motivasi',
        'is_agreed',
        'agreed_at',
        'status',
    ];

    protected $casts = [
        'is_agreed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
