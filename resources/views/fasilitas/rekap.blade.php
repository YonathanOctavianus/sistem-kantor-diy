<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Peminjaman Fasilitas - Kemenimipas DIY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Pengaturan Cetak (Print) */
        @media print {
            @page {
                size: landscape; /* Kertas Mendatar */
                margin: 10mm;
            }
            .no-print {
                display: none !important; /* Sembunyikan tombol saat print */
            }
            body {
                -webkit-print-color-adjust: exact;
                background-color: white;
            }
        }

        body {
            font-family: 'Times New Roman', Times, serif; /* Font resmi laporan */
            font-size: 12px;
        }

        .header-laporan {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px double black;
            padding-bottom: 10px;
        }

        .table thead th {
            background-color: #07213D !important; /* Warna Midnight Blue */
            color: white !important;
            vertical-align: middle;
            text-align: center;
            font-size: 12px;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 11px;
        }
    </style>
</head>
<body class="p-4">

    <div class="d-flex justify-content-end mb-3 no-print gap-2">
        <button onclick="window.print()" class="btn btn-primary btn-sm">
            <i class="fas fa-print"></i> Cetak / Simpan PDF
        </button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm">
            <i class="fas fa-times"></i> Tutup
        </button>
    </div>

    <div class="header-laporan">
        <h3 class="fw-bold text-uppercase m-0">REKAPITULASI PEMINJAMAN FASILITAS</h3>
        <h5 class="m-0">KANWIL KEMENIMIPAS D.I. YOGYAKARTA</h5>
        
        @if($tglAwal && $tglAkhir)
            <p class="mb-0 fw-bold mt-2">
                Periode: {{ \Carbon\Carbon::parse($tglAwal)->translatedFormat('d F Y') }} 
                s/d 
                {{ \Carbon\Carbon::parse($tglAkhir)->translatedFormat('d F Y') }}
            </p>
        @else
            <p class="mb-0 fw-bold mt-2">Periode: Semua Waktu</p>
        @endif
        
        <small class="text-muted">Dicetak pada: {{ date('d F Y H:i') }} WIB</small>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="3%">No</th>
                    <th width="8%">Tanggal</th>
                    <th width="10%">Jam</th>
                    <th width="15%">Nama Kegiatan</th>
                    <th width="10%">Bidang</th>
                    <th width="5%">Jml Peserta</th>
                    <th width="8%">Tipe Kegiatan</th>
                    <th width="8%">Layout</th>
                    <th width="12%">Nama Pemohon</th>
                    <th width="15%">Keterangan (Link)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataRekap as $d)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($d->tanggal_peminjaman)->format('d/m/Y') }}
                    </td>
                    
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($d->jam_mulai)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($d->jam_selesai)->format('H:i') }}
                    </td>
                    
                    <td class="fw-bold">{{ $d->keperluan }}</td>
                    
                    <td>{{ $d->user->bidang ?? '-' }}</td>
                    
                    <td class="text-center">{{ $d->jumlah_peserta }}</td>
                    
                    <td class="text-center">{{ $d->tipe_kegiatan ?? 'Offline' }}</td>
                    
                    <td class="text-center">{{ $d->layout ?? 'Standar' }}</td>
                    
                    <td>{{ $d->user->name }}</td>
                    
                    <td>
                        @if($d->link_zoom)
                            <a href="{{ $d->link_zoom }}" target="_blank" class="text-decoration-none">
                                <i class="fas fa-link"></i> Link Zoom
                            </a>
                        @else
                            -
                        @endif
                        @if($d->catatan_admin)
                            <div class="text-muted fst-italic mt-1" style="font-size: 10px;">
                                Catatan: {{ $d->catatan_admin }}
                            </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-3">Tidak ada data peminjaman yang disetujui.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="row mt-5 no-break">
        <div class="col-4 offset-8 text-center">
            <p class="mb-5">Yogyakarta, {{ date('d F Y') }}<br>Mengetahui,</p>
            <br><br>
            <p class="fw-bold text-decoration-underline mb-0">ADMINISTRATOR</p>
            <small>NIP. ...........................</small>
        </div>
    </div>

</body>
</html>