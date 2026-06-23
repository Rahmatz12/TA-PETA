<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@sigirigasi.id',
            'phone' => '081234567890',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        Admin::create([
            'name' => 'Petugas Lapangan',
            'email' => 'petugas@sigirigasi.id',
            'phone' => '081234567891',
            'password' => bcrypt('petugas123'),
            'role' => 'petugas',
            'status' => 'aktif',
        ]);
    }
}
