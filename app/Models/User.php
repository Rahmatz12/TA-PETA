<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role', // penting: admin / masyarakat
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // =========================
    // RELATIONSHIPS
    // =========================
    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }

    // =========================
    // ROLE HELPERS (INI YANG BARU)
    // =========================

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMasyarakat(): bool
    {
        return $this->role === 'masyarakat';
    }

    // scope biar gampang query admin
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeMasyarakat($query)
    {
        return $query->where('role', 'masyarakat');
    }
}