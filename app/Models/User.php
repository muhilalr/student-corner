<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use App\Models\ProgresBelajar\VideoDilihat;
use App\Models\KuisReguler\HasilKuisReguler;
use App\Models\ProgresBelajar\ArtikelDibaca;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\TantanganBulanan\HasilKuisTantanganBulanan;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'jenis_kelamin',
        'no_hp',
        'instansi',
        'foto',
        'password',
        'slug',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pendaftaran_magang()
    {
        return $this->hasMany(PendaftaranMagang::class, 'user_id');
    }

    public function hasil_kuis_reguler()
    {
        return $this->hasMany(HasilKuisReguler::class, 'id_user');
    }

    public function hasil_kuis_tantangan_bulanan()
    {
        return $this->hasMany(HasilKuisTantanganBulanan::class, 'id_user');
    }

    public function artikel_dibaca()
    {
        return $this->hasMany(ArtikelDibaca::class, 'id_user');
    }

    public function video_dilihat()
    {
        return $this->hasMany(VideoDilihat::class, 'id_user');
    }

    public function getSlugAttribute()
    {
        return $this->id . '-' . Str::slug($this->name);
    }
}
