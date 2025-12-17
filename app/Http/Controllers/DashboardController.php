<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Panggil semua Model yang mau dihitung
use App\Models\User;
use App\Models\Fasilitas; // Pastikan Model ini ada
use App\Models\Atk;       // Pastikan Model ini ada (kalau belum, nanti angkanya 0)
use App\Models\Kerusakan; // Pastikan Model ini ada
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Statistik (Gunakan try-catch biar kalau tabel belum ada, tidak error fatal)
        $stats = [
            'total_fasum'     => 0,
            'total_atk'       => 0,
            'total_kerusakan' => 0,
        ];

        try {
            if(class_exists(Fasilitas::class)) $stats['total_fasum'] = Fasilitas::count();
            if(class_exists(Atk::class))       $stats['total_atk']   = Atk::count();
            if(class_exists(Kerusakan::class)) $stats['total_kerusakan'] = Kerusakan::where('status', 'dilaporkan')->count();
        } catch (\Exception $e) {
            // Abaikan error jika tabel belum dibuat
        }

        // 2. Ambil Peminjaman Aktif (Hari ini ke depan)
        $peminjaman_aktif = [];
        try {
            if(class_exists(Peminjaman::class)) {
                $peminjaman_aktif = Peminjaman::with(['user', 'fasilitas'])
                    ->where('status', 'disetujui')
                    ->where('tanggal_peminjaman', '>=', now()->toDateString())
                    ->orderBy('tanggal_peminjaman', 'asc')
                    ->limit(5)
                    ->get();
            }
        } catch (\Exception $e) { }

        // 3. Ambil Laporan Kerusakan Terbaru
        $kerusakan_terbaru = [];
        try {
            if(class_exists(Kerusakan::class)) {
                $kerusakan_terbaru = Kerusakan::with('user')
                    ->latest()
                    ->limit(5)
                    ->get();
            }
        } catch (\Exception $e) { }

        // 4. Kirim ke View 'dashboard' (bukan dashboard.index)
        return view('dashboard', compact('stats', 'peminjaman_aktif', 'kerusakan_terbaru'));
    }
}