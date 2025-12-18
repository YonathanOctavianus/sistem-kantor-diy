<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Jangan lupa baris ini

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Akun Admin Default
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@kemenimipas.go.id',
            'password' => bcrypt('password'), // Password default
            'role' => 'admin',
        ]);

        // Buat Akun User Biasa (Opsional)
        User::create([
            'name' => 'Pegawai Contoh',
            'email' => 'pegawai@kemenimipas.go.id',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
    }
}