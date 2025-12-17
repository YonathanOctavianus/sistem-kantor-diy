@extends('layouts.simple')

@section('title', 'Profile')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2><i class="fas fa-user me-2"></i>Profile Saya</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                </div>
                <h4>{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->jabatan }}</p>
                <p><strong>NIP:</strong> {{ $user->nip }}</p>
                <p><strong>Bidang:</strong> {{ $user->bidang }}</p>
                <p><strong>Role:</strong> 
                    <span class="badge bg-{{ $user->role == 'superadmin' ? 'danger' : ($user->role == 'admin' ? 'warning' : 'info') }}">
                        {{ $user->role }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Profile</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" 
                                   id="nip" name="nip" value="{{ old('nip', $user->nip) }}" required>
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="bidang" class="form-label">Bidang</label>
                            <input type="text" class="form-control @error('bidang') is-invalid @enderror" 
                                   id="bidang" name="bidang" value="{{ old('bidang', $user->bidang) }}" required>
                            @error('bidang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                                   id="jabatan" name="jabatan" value="{{ old('jabatan', $user->jabatan) }}" required>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- User Info Card -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Akun</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <p><strong>Tanggal Registrasi:</strong><br>
                {{ $user->created_at->format('d F Y') }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Terakhir Update:</strong><br>
                {{ $user->updated_at->format('d F Y H:i') }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>Status Akun:</strong><br>
                <span class="badge bg-success">Aktif</span></p>
            </div>
            <div class="col-md-3">
                <p><strong>Email Terverifikasi:</strong><br>
                @if($user->email_verified_at)
                    <span class="badge bg-success">Ya</span>
                @else
                    <span class="badge bg-warning">Belum</span>
                @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Form validation
        $('form').on('submit', function(e) {
            const password = $('#password').val();
            const confirm = $('#password_confirmation').val();
            
            if (password && password !== confirm) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Password tidak sama!',
                    text: 'Password dan konfirmasi password harus sama',
                });
            }
        });
    });
</script>
@endsection