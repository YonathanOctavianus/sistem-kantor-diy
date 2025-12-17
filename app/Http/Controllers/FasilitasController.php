<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FasilitasController extends Controller
{
    /**
     * Tampilkan halaman fasilitas untuk user
     */
    public function userIndex()
    {
        // Ambil fasilitas yang tersedia
        $fasilitas = Fasilitas::where('status', 'tersedia')->get();
        
        // Ambil riwayat peminjaman user saat ini
        $riwayat = Peminjaman::where('user_id', Auth::id())
            ->with('fasilitas')
            ->latest()
            ->paginate(10);
            
        // Ambil jadwal yang sudah dibooking untuk cek bentrok
        $bookedSlots = Peminjaman::where('status', 'disetujui')
            ->where('tanggal_peminjaman', '>=', Carbon::today())
            ->select('fasilitas_id', 'tanggal_peminjaman', 'jam_mulai', 'jam_selesai')
            ->get()
            ->map(function ($item) {
                return [
                    'fasilitas_id' => $item->fasilitas_id,
                    'date' => $item->tanggal_peminjaman,
                    'start_time' => $item->jam_mulai,
                    'end_time' => $item->jam_selesai
                ];
            });
        
        return view('fasilitas.user', compact('fasilitas', 'riwayat', 'bookedSlots'));
    }
    
    /**
     * Proses pengajuan peminjaman fasilitas
     */
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas,id',
            'tanggal_peminjaman' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan' => 'required|string|max:500',
            'jumlah_peserta' => 'required|integer|min:1',
        ]);
        
        // Cek apakah fasilitas masih tersedia
        $fasilitas = Fasilitas::findOrFail($request->fasilitas_id);
        if ($fasilitas->status != 'tersedia') {
            return back()->withErrors([
                'fasilitas_id' => 'Fasilitas ini sedang tidak tersedia.'
            ])->withInput();
        }
        
        // Cek kapasitas
        if ($request->jumlah_peserta > $fasilitas->kapasitas) {
            return back()->withErrors([
                'jumlah_peserta' => 'Jumlah peserta melebihi kapasitas fasilitas.'
            ])->withInput();
        }
        
        // Cek bentrok jadwal
        $bentrok = Peminjaman::where('fasilitas_id', $request->fasilitas_id)
            ->where('tanggal_peminjaman', $request->tanggal_peminjaman)
            ->where('status', 'disetujui')
            ->where(function($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhere(function($q) use ($request) {
                          $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                      });
            })
            ->exists();
        
        // Simpan peminjaman
        $peminjaman = new Peminjaman();
        $peminjaman->user_id = Auth::id();
        $peminjaman->fasilitas_id = $request->fasilitas_id;
        $peminjaman->tanggal_peminjaman = $request->tanggal_peminjaman;
        $peminjaman->jam_mulai = $request->jam_mulai;
        $peminjaman->jam_selesai = $request->jam_selesai;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->jumlah_peserta = $request->jumlah_peserta;
        $peminjaman->status = $bentrok ? 'bentrok' : 'menunggu';
        $peminjaman->save();
        
        return redirect()->route('fasilitas.user')->with('success', 
            $bentrok 
                ? 'Pengajuan berhasil! Namun ada kemungkinan bentrok jadwal. Admin akan menghubungi Anda.' 
                : 'Pengajuan peminjaman berhasil dikirim! Tunggu persetujuan admin.'
        );
    }
    
    /**
     * Tampilkan halaman fasilitas untuk admin (persetujuan)
     */
    public function adminIndex()
    {
        // 1. Definisikan variabel $pengajuan (Ini yang tadi hilang)
        $pengajuan = Peminjaman::with(['user', 'fasilitas'])
            ->orderByRaw("FIELD(status, 'menunggu', 'disetujui', 'ditolak')") // Urutkan status Menunggu paling atas
            ->orderBy('tanggal_peminjaman', 'desc') // Lalu urutkan tanggal terbaru
            ->get();

        // 2. Kirim variabel tersebut ke tampilan
        return view('fasilitas.admin', compact('pengajuan'));
    }
    
    /**
     * Update status peminjaman oleh admin
     */
    public function updateStatus(Request $request, $id)
    {
        // Akan kita buat nanti
    }

    /**
     * API untuk Data Kalender
     */
    public function getEvents()
    {
        $peminjaman = Peminjaman::with(['user', 'fasilitas'])
            ->where('status', '!=', 'ditolak')
            ->get();

        $events = [];

        foreach ($peminjaman as $p) {
            // === LOGIKA WARNA ===
            // Jika DISETUJUI -> Pakai Biru Utama (#07213D) atau Biru Terang (#0d6efd)
            // Jika MENUNGGU -> Pakai Kuning (#ffc107)
            
            if ($p->status == 'disetujui') {
                $color = '#07213D'; // Biru Midnight (Sesuai Tema)
                // $color = '#0d6efd'; // Atau Biru Bootstrap (Lebih terang)
            } else {
                $color = '#ffc107'; // Kuning (Warning)
            }

            $textColor = '#ffffff'; // Teks putih biar kontras
            
            $events[] = [
                'title' => $p->fasilitas->nama_fasilitas . ' - ' . $p->user->name,
                'start' => $p->tanggal_peminjaman . 'T' . $p->jam_mulai,
                'end'   => $p->tanggal_peminjaman . 'T' . $p->jam_selesai,
                'backgroundColor' => $color,
                'borderColor' => $color,
                'textColor' => $textColor,
                'extendedProps' => [
                    'keperluan' => $p->keperluan,
                    'status' => $p->status
                ]
            ];
        }

        return response()->json($events);
    }

    public function rekap(Request $request)
    {
        // 1. Ambil Input Tanggal dari User (jika ada)
        $tglAwal = $request->input('tgl_awal');
        $tglAkhir = $request->input('tgl_akhir');

        // 2. Mulai Query dasar (Status Disetujui)
        $query = Peminjaman::with(['user', 'fasilitas'])
            ->where('status', 'disetujui');

        // 3. Jika user memilih tanggal, Filter datanya
        if ($tglAwal && $tglAkhir) {
            $query->whereBetween('tanggal_peminjaman', [$tglAwal, $tglAkhir]);
        }

        // 4. Eksekusi Query
        $dataRekap = $query->orderBy('tanggal_peminjaman', 'asc')->get();

        // 5. Kirim data + informasi tanggal ke View
        return view('fasilitas.rekap', compact('dataRekap', 'tglAwal', 'tglAkhir'));
    }
}