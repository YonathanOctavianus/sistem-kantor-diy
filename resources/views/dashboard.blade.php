@extends('layouts.simple') 

@section('title', 'Executive Dashboard')

@push('styles')
<style>
    /* === KONSEP DESAIN: MODERN, CLEAN, & LUXURY === */
    :root {
        --glass-bg: rgba(255, 255, 255, 0.9);
        --card-radius: 20px;
    }

    /* 1. HERO SECTION (Gradient Mewah) */
    .hero-dashboard {
        background: linear-gradient(135deg, var(--midnight-blue) 0%, #1a4a7c 100%);
        border-radius: var(--card-radius);
        padding: 2.5rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(7, 33, 61, 0.25);
        margin-bottom: 2rem;
    }

    /* Pattern Background Halus */
    .hero-dashboard::before {
        content: '';
        position: absolute;
        top: -50%; left: -20%;
        width: 200%; height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 60%);
        transform: rotate(30deg);
        pointer-events: none;
    }

    /* 2. STAT CARDS (Efek Melayang) */
    .stat-card-neo {
        background: white;
        border-radius: var(--card-radius);
        padding: 1.5rem;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card-neo:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(7, 33, 61, 0.12);
        border-color: var(--gold-dignity);
    }

    .stat-icon-circle {
        width: 55px; height: 55px;
        border-radius: 15px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        transition: transform 0.3s;
    }

    .stat-card-neo:hover .stat-icon-circle {
        transform: scale(1.1) rotate(10deg);
    }

    .stat-value {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--midnight-blue);
        line-height: 1.2;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    /* Warna Icon Spesifik */
    .bg-icon-blue { background: rgba(7, 33, 61, 0.1); color: var(--midnight-blue); }
    .bg-icon-gold { background: rgba(238, 191, 99, 0.15); color: #d69e2e; }
    .bg-icon-green { background: rgba(40, 167, 69, 0.1); color: #28a745; }
    .bg-icon-red { background: rgba(220, 53, 69, 0.1); color: #dc3545; }

    /* 3. TOMBOL AKSI CEPAT (Modern Buttons) */
    .btn-quick-action {
        background: white;
        border: 1px solid #f0f0f0;
        padding: 1.25rem;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.3s;
        text-decoration: none;
        color: var(--midnight-blue);
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    .btn-quick-action:hover {
        background: white;
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(7, 33, 61, 0.1);
        border-color: var(--gold-dignity);
        color: var(--midnight-blue);
    }

    .action-icon {
        width: 45px; height: 45px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: var(--midnight-blue);
        font-size: 1.2rem;
    }

    .btn-quick-action:hover .action-icon {
        background: var(--midnight-blue);
        color: var(--gold-dignity);
    }

    /* 4. TABLE SECTION */
    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--midnight-blue);
        margin-bottom: 1.25rem;
        display: flex; align-items: center; gap: 10px;
    }
    
    .section-title::before {
        content: ''; width: 4px; height: 20px;
        background: var(--gold-dignity);
        border-radius: 2px;
    }

    .table-card {
        background: white;
        border-radius: var(--card-radius);
        box-shadow: 0 5px 20px rgba(0,0,0,0.03);
        overflow: hidden;
        border: 1px solid #f0f0f0;
    }

    .table-modern th {
        background: #f8f9fa;
        color: #8898aa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem 1.5rem;
    }

    .table-modern td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f5f5f5;
    }
    
    .table-modern tr:hover td {
        background-color: #fafbfc;
    }
</style>
@endpush

@section('content')

<div class="hero-dashboard d-flex align-items-center justify-content-between flex-wrap gap-4">
    <div style="z-index: 2;">
        <h2 class="fw-bold mb-1">Halo, {{ Auth::user()->name }}! 👋</h2>
        <p class="mb-0 opacity-75" style="font-weight: 300;">Selamat datang di Pusat Kontrol Sistem Perkantoran.</p>
    </div>
    <div style="z-index: 2; text-align: right;">
        <div class="d-inline-flex align-items-center bg-white bg-opacity-10 rounded-pill px-3 py-2 border border-white border-opacity-25">
            <i class="far fa-calendar-alt me-2 text-warning"></i>
            <span>{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card-neo">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $stats['total_fasum'] ?? 0 }}</div>
                    <div class="stat-label">Fasilitas Umum</div>
                </div>
                <div class="stat-icon-circle bg-icon-blue">
                    <i class="fas fa-building"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2">Ready</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card-neo">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $stats['total_atk'] ?? 0 }}</div>
                    <div class="stat-label">Jenis ATK</div>
                </div>
                <div class="stat-icon-circle bg-icon-green">
                    <i class="fas fa-box-open"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2">In Stock</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card-neo">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $stats['total_kerusakan'] ?? 0 }}</div>
                    <div class="stat-label">Laporan Masuk</div>
                </div>
                <div class="stat-icon-circle bg-icon-gold">
                    <i class="fas fa-tools"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2">Perlu Tindakan</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card-neo">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value" style="font-size: 1.5rem; padding-top: 5px;">
                        {{ ucfirst(Auth::user()->role) }}
                    </div>
                    <div class="stat-label">Status Akses</div>
                </div>
                <div class="stat-icon-circle bg-icon-red">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2">Active</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    
    <div class="col-lg-4">
        <div class="section-title">Menu Cepat</div>
        <div class="d-flex flex-column gap-3">
            @if(Auth::user()->role == 'admin')
            <a href="{{ route('fasilitas.admin') }}" class="btn-quick-action">
                <div class="action-icon"><i class="fas fa-check-double"></i></div>
                <div>
                    <h6 class="fw-bold m-0">Approval Fasilitas</h6>
                    <small class="text-muted">Kelola pengajuan masuk</small>
                </div>
            </a>
            @else
            <a href="{{ route('fasilitas.user') }}" class="btn-quick-action">
                <div class="action-icon"><i class="fas fa-calendar-plus"></i></div>
                <div>
                    <h6 class="fw-bold m-0">Pinjam Ruangan</h6>
                    <small class="text-muted">Booking aula/ruang rapat</small>
                </div>
            </a>
            @endif

            <a href="#" class="btn-quick-action">
                <div class="action-icon"><i class="fas fa-pencil-alt"></i></div>
                <div>
                    <h6 class="fw-bold m-0">Permintaan ATK</h6>
                    <small class="text-muted">Ajukan barang habis pakai</small>
                </div>
            </a>

            <a href="#" class="btn-quick-action">
                <div class="action-icon"><i class="fas fa-camera"></i></div>
                <div>
                    <h6 class="fw-bold m-0">Lapor Kerusakan</h6>
                    <small class="text-muted">Foto & laporkan sarpras</small>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="section-title mb-0">Jadwal Fasilitas Terdekat</div>
            <a href="{{ Auth::user()->role == 'admin' ? route('fasilitas.admin') : route('fasilitas.user') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Fasilitas</th>
                            <th>Peminjam</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman_aktif as $p)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-building text-secondary opacity-50"></i>
                                    <span class="fw-bold text-dark">{{ $p->fasilitas->nama_fasilitas }}</span>
                                </div>
                            </td>
                            <td>{{ $p->user->name }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->format('d M') }} 
                                <span class="text-muted small">({{ \Carbon\Carbon::parse($p->jam_mulai)->format('H:i') }})</span>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Disetujui</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="fas fa-mug-hot fa-2x text-light mb-3"></i>
                                <p class="text-muted m-0">Belum ada jadwal peminjaman dalam waktu dekat.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection