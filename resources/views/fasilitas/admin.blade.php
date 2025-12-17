@extends('layouts.simple')

@section('title', 'Executive Approval Dashboard')

@push('styles')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<style>
    /* === 1. KONSEP MEWAH & FUTURISTIK === */
    :root {
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: 1px solid rgba(255, 255, 255, 0.5);
        --shadow-soft: 0 10px 30px -5px rgba(7, 33, 61, 0.1);
        --shadow-glow: 0 5px 15px rgba(238, 191, 99, 0.3);
        --gradient-primary: linear-gradient(135deg, #07213D 0%, #0f3457 100%);
        --gradient-gold: linear-gradient(135deg, #EEBF63 0%, #d4a03d 100%);
    }

    body {
        background-color: #f4f6f9; /* Background lebih bersih */
    }

    /* === 2. CARD FUTURISTIK === */
    .card-modern {
        background: var(--glass-bg);
        border: none;
        border-radius: 20px; /* Sudut lebih bulat */
        box-shadow: var(--shadow-soft);
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .card-modern:hover {
        transform: translateY(-5px); /* Efek melayang saat hover */
        box-shadow: 0 15px 35px -5px rgba(7, 33, 61, 0.15);
    }

    .card-header-modern {
        background: white;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header-modern h5 {
        font-weight: 700;
        color: var(--midnight-blue);
        letter-spacing: 0.5px;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* === 3. BUTTONS KEKINIAN === */
    .btn-lux {
        border: none;
        border-radius: 12px;
        padding: 8px 20px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-lux-primary {
        background: var(--gradient-primary);
        color: white;
        box-shadow: 0 4px 15px rgba(7, 33, 61, 0.3);
    }

    .btn-lux-gold {
        background: var(--gradient-gold);
        color: var(--midnight-blue);
        box-shadow: var(--shadow-glow);
    }

    .btn-lux:hover {
        transform: translateY(-2px) scale(1.02);
        filter: brightness(1.1);
    }

    .btn-icon-only {
        width: 35px;
        height: 35px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    /* === 4. FORM INPUT MODERN === */
    .form-control-modern {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 8px 15px;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .form-control-modern:focus {
        background-color: white;
        border-color: var(--gold-dignity);
        box-shadow: 0 0 0 3px rgba(238, 191, 99, 0.2);
    }

    /* === 5. TABEL ELEGANT === */
    .table-responsive {
        border-radius: 0 0 20px 20px;
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-modern thead th {
        background: var(--midnight-blue);
        color: white;
        padding: 15px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        border: none;
    }

    .table-modern tbody tr {
        background: white;
        transition: all 0.2s;
    }

    .table-modern tbody tr:hover {
        background-color: #fcfcfc;
        transform: scale(1.005); /* Efek zoom in sangat halus */
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        z-index: 10;
        position: relative;
    }

    .table-modern td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
        color: #555;
        font-size: 0.9rem;
    }

    /* Badge Status Pill */
    .badge-pill {
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* FullCalendar Customization */
    #calendar { font-family: 'Titillium Web', sans-serif; }
    .fc-toolbar-title { font-size: 1.5rem !important; font-weight: 800; color: var(--midnight-blue); }
    .fc-button-primary { 
        background: var(--midnight-blue) !important; 
        border: none !important; 
        border-radius: 8px !important;
        box-shadow: 0 4px 10px rgba(7, 33, 61, 0.2);
    }
    .fc-daygrid-event { border-radius: 6px !important; border: none; padding: 2px 5px; }
</style>
@endpush

@section('content')

<div class="card-modern p-4 mb-5">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-4">
        
        <div>
            <h6 class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">Control Center</h6>
            <h2 class="fw-bold m-0" style="color: var(--midnight-blue);">
                Manajemen Approval
            </h2>
        </div>
        
        <div class="bg-light p-2 rounded-4 border d-flex align-items-center gap-3">
            <form action="{{ route('fasilitas.rekap') }}" method="GET" target="_blank" class="d-flex align-items-center gap-2">
                <div class="d-flex flex-column">
                    <label class="small text-muted fw-bold" style="font-size: 0.7rem;">DARI TANGGAL</label>
                    <input type="date" name="tgl_awal" class="form-control-modern" required>
                </div>
                
                <div class="text-muted"><i class="fas fa-arrow-right"></i></div>

                <div class="d-flex flex-column">
                    <label class="small text-muted fw-bold" style="font-size: 0.7rem;">SAMPAI</label>
                    <input type="date" name="tgl_akhir" class="form-control-modern" required>
                </div>

                <button type="submit" class="btn-lux btn-lux-gold ms-2 d-flex align-items-center gap-2">
                    <i class="fas fa-print"></i> 
                    <span>Cetak Rekap</span>
                </button>
            </form>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-12">
        <div class="card-modern">
            <div class="card-header-modern">
                <h5><i class="fas fa-calendar-alt text-warning"></i> LIVE SCHEDULE</h5>
                
                <div class="d-flex gap-3">
                    <span class="badge rounded-pill bg-light text-dark border d-flex align-items-center gap-2 px-3">
                        <span class="rounded-circle" style="width:10px; height:10px; background:#07213D;"></span> Booked
                    </span>
                    <span class="badge rounded-pill bg-light text-dark border d-flex align-items-center gap-2 px-3">
                        <span class="rounded-circle" style="width:10px; height:10px; background:#ffc107;"></span> Pending
                    </span>
                </div>
            </div>
            <div class="card-body p-4">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card-modern" style="border-left: 5px solid #ffc107;">
            <div class="card-header-modern">
                <h5><i class="fas fa-bell text-warning"></i> WAITING LIST</h5>
                <span class="badge bg-warning text-dark rounded-pill px-3">Pending: {{ $pengajuan->where('status', 'menunggu')->count() }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-modern">
                        <thead style="background: #FFF8E1; color: #856404;">
                            <tr>
                                <th><i class="fas fa-bolt me-2"></i>Nama Kegiatan</th>
                                <th><i class="fas fa-building me-2"></i>Ruang</th>
                                <th><i class="far fa-clock me-2"></i>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $pendingList = $pengajuan->where('status', 'menunggu'); @endphp
                            
                            @forelse($pendingList as $p)
                            <tr>
                                <td class="fw-bold">{{ $p->keperluan }}</td>
                                <td class="text-primary fw-bold">{{ $p->fasilitas->nama_fasilitas }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted fst-italic">
                                    <i class="fas fa-check-circle text-success me-2"></i> Tidak ada antrean. Semua bersih!
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card-modern">
            <div class="card-header-modern" style="background: linear-gradient(to right, #07213D, #0a2b4d); color: white;">
                <h5 style="color: white;"><i class="fas fa-check-double text-warning"></i> APPROVAL EXECUTION</h5>
                <small class="text-white-50">Tindakan tidak dapat dibatalkan</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-modern align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Jadwal</th>
                                <th>Detail Kegiatan</th>
                                <th>Pemohon</th>
                                <th>Fasilitas</th>
                                <th>Keterangan</th>
                                <th class="text-center">Eksekusi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingList as $index => $p)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                
                                <td>
                                    <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->format('d M Y') }}</div>
                                    <div class="small text-muted">
                                        {{ \Carbon\Carbon::parse($p->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($p->jam_selesai)->format('H:i') }}
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="fw-bold text-primary">{{ $p->keperluan }}</div>
                                    <div class="d-flex gap-2 mt-1">
                                        <span class="badge bg-light text-secondary border">{{ $p->tipe_kegiatan ?? 'Offline' }}</span>
                                        <span class="badge bg-light text-secondary border">{{ $p->layout ?? 'Standar' }}</span>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="fw-bold">{{ $p->user->name }}</div>
                                    <div class="small text-muted">{{ $p->user->bidang ?? '-' }}</div>
                                    <div class="small text-info"><i class="fas fa-users"></i> {{ $p->jumlah_peserta }} Org</div>
                                </td>

                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info fw-bold border border-info">
                                        {{ $p->fasilitas->nama_fasilitas }}
                                    </span>
                                </td>
                                
                                <td>
                                    @if($p->link_zoom)
                                        <a href="{{ $p->link_zoom }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill">
                                            <i class="fas fa-video me-1"></i> Zoom
                                        </a>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('fasilitas.updateStatus', $p->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="btn-lux btn-lux-primary btn-icon-only" title="Approve" onclick="return confirm('Approve kegiatan ini?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('fasilitas.updateStatus', $p->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="btn-lux bg-danger text-white btn-icon-only shadow" style="border:none;" title="Tolak" onclick="return confirm('Tolak pengajuan ini?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted opacity-50">
                                        <i class="fas fa-coffee fa-3x mb-3"></i>
                                        <p>Tidak ada tugas pending. Selamat bersantai!</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: { left: 'prev,next today', center: 'title', right: 'dayGridMonth,listWeek' },
            locale: 'id',
            events: "{{ route('fasilitas.events') }}",
            eventClick: function(info) {
                Swal.fire({
                    title: info.event.title,
                    html: `<p class='text-muted'>Status: <b>${info.event.extendedProps.status.toUpperCase()}</b></p>`,
                    icon: 'info',
                    confirmButtonColor: '#07213D'
                });
            }
        });
        calendar.render();
    });
</script>
@endpush