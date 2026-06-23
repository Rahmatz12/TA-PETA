<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'phone' => '081234567890',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@email.com',
            'phone' => '081234567891',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@email.com',
            'phone' => '081234567892',
            'password' => bcrypt('password123'),
        ]);
    }
}
