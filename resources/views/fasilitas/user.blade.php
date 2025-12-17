@extends('layouts.simple') @section('title', 'Peminjaman Fasilitas')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-elegant">
            <div class="card-header-elegant">
                <h5><i class="fas fa-calendar-plus"></i> Form Pengajuan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('fasilitas.pinjam') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Fasilitas</label>
                        <select name="fasilitas_id" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach($fasilitas as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama_fasilitas }} (Max: {{ $item->kapasitas }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date" name="tanggal_peminjaman" class="form-control" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label fw-bold">Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label fw-bold">Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Peserta</label>
                        <input type="number" name="jumlah_peserta" class="form-control" placeholder="Jml Orang" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Keperluan</label>
                        <textarea name="keperluan" class="form-control" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary-elegant w-100">
                        <i class="fas fa-paper-plane me-2"></i> Ajukan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="row mb-4">
            @foreach($fasilitas as $f)
            <div class="col-md-6">
                <div class="card card-elegant h-100">
                    <div class="card-body">
                        <h6 class="fw-bold text-primary">{{ $f->nama_fasilitas }}</h6>
                        <p class="small text-muted mb-2"><i class="fas fa-map-marker-alt"></i> {{ $f->lokasi }}</p>
                        <p class="small">{{ $f->deskripsi }}</p>
                        <span class="badge bg-info text-dark">
                            <i class="fas fa-users"></i> {{ $f->kapasitas }} Org
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="card card-elegant">
            <div class="card-header-elegant">
                <h5><i class="fas fa-history"></i> Riwayat Pengajuan Saya</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Fasilitas</th>
                                <th>Jam</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $r)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal_peminjaman)->format('d M Y') }}</td>
                                <td>{{ $r->fasilitas->nama_fasilitas }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($r->jam_selesai)->format('H:i') }}</td>
                                <td>
                                    @if($r->status == 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($r->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada riwayat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $riwayat->links() }}
            </div>
        </div>
    </div>
</div>
@endsection