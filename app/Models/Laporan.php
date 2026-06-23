<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';

    protected $fillable = [
        'kode_laporan',
        'user_id',
        'nama_pelapor',
        'telepon',
        'email',
        'status_pelapor',
        'nama_saluran',
        'jenis_saluran',
        'kecamatan',
        'desa',
        'alamat',
        'deskripsi_lokasi',
        'jenis_kerusakan',
        'tingkat_keparahan',
        'dampak_pertanian',
        'lama_kerusakan',
        'deskripsi_kerusakan',
        'latitude',
        'longitude',
        'foto',
        'is_anonymous',
        'status',
        'catatan_verifikasi',
        'tanggal_verifikasi',
        'tanggal_proses',
        'tanggal_selesai',
        'admin_id',
        'estimasi_perbaikan',
    ];

    protected $casts = [
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
        'is_anonymous' => 'boolean',
        'tanggal_verifikasi' => 'datetime',
        'tanggal_proses' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
