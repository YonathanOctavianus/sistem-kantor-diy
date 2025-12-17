<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_fasilitas',
        'deskripsi',
        'lokasi',
        'kapasitas',
        'status'
    ];
    
    // Accessor untuk view
    public function getPeminjamanHariIniAttribute()
    {
        // Jika relasi peminjaman sudah dibuat
        return $this->peminjaman()
            ->whereDate('tanggal_peminjaman', today())
            ->where('status', 'disetujui')
            ->count();
    }
}