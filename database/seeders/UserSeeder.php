<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@kemenikan.go.id',
                'password' => Hash::make('admin123'),
                'role' => 'superadmin',
                'nip' => '198012312345',
                'bidang' => 'Administrasi',
                'jabatan' => 'Super Administrator',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin Fasilitas',
                'email' => 'fasilitas@kemenikan.go.id',
                'password' => Hash::make('fasilitas123'),
                'role' => 'admin',
                'nip' => '198512312346',
                'bidang' => 'Fasilitas Umum',
                'jabatan' => 'Admin Fasilitas',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@kemenikan.go.id',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'nip' => '199012312347',
                'bidang' => 'Kepegawaian',
                'jabatan' => 'Staf',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}