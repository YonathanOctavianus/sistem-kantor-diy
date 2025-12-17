<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // === TAMBAHKAN KODE INI ===
    // Memaksa Laravel menggunakan nama tabel 'peminjaman', bukan 'peminjamen'
    protected $table = 'peminjaman'; 
    // ==========================

    protected $fillable = [
        'user_id',
        'fasilitas_id',
        'tanggal_peminjaman',
        'jam_mulai',
        'jam_selesai',
        'keperluan',
        'jumlah_peserta',
        'status',
        'catatan_admin'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Fasilitas
    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class); // Pastikan ini 'Fasilitas::class'
    }
}