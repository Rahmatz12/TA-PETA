<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saluran extends Model
{
    use HasFactory;

    protected $table = 'salurans';

    protected $fillable = [
        'nama',
        'jenis',
        'kecamatan',
        'desa',
        'alamat',
        'deskripsi',
        'kondisi',
        'latitude',
        'longitude',
        'level_air',
        'status',
        'foto',
    ];

    protected $casts = [
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
    ];
}
