<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Fasilitas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin Kanwil',
            'email' => 'admin@kemenimipas.go.id',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun User Contoh (Untuk tes bentrok nanti)
        User::create([
            'name' => 'Pegawai Satu',
            'email' => 'pegawai1@kemenimipas.go.id',
            'password' => bcrypt('password123'),
            'role' => 'user', // Asumsi ada kolom role 'user'
        ]);

        // 3. Buat Data Dummy Fasilitas (Opsional, biar tidak kosong)
        Fasilitas::create([
            'nama_fasilitas' => 'Aula Utama',
            'deskripsi' => 'Aula besar kapasitas 100 orang, sound system lengkap.',
            'lokasi' => 'Lantai 2',
            'kapasitas' => 100,
            'status' => 'tersedia'
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Ruang Rapat Divisi',
            'deskripsi' => 'Ruang rapat oval, ada proyektor.',
            'lokasi' => 'Lantai 1 Sayap Kiri',
            'kapasitas' => 20,
            'status' => 'tersedia'
        ]);
    }
}