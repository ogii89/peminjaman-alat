@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-1"><i class="bi bi-person-circle"></i> Profile Saya</h4>
    <p class="text-muted small">Kelola informasi akun dan keamanan profil Anda</p>
</div>

<div class="row g-4">
    <!-- Update Profile Section -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-light border-bottom">
                <h5 class="card-title mb-0"><i class="bi bi-person"></i> Informasi Profil</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> Profil berhasil diperbarui
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-check"></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Password Section -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-light border-bottom">
                <h5 class="card-title mb-0"><i class="bi bi-lock"></i> Ubah Password</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input id="current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" required>
                        @error('current_password', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input id="password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" required>
                        @error('password', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" required>
                        @error('password_confirmation', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (session('status') === 'password-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> Password berhasil diubah
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-check"></i> Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Section -->
<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="card border-0 shadow-sm border-start border-danger border-5">
            <div class="card-header bg-light border-bottom">
                <h5 class="card-title mb-0 text-danger"><i class="bi bi-exclamation-triangle"></i> Hapus Akun</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Setelah akun dihapus, semua data akan hilang permanen. Pastikan Anda sudah backup data penting.</p>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    <i class="bi bi-trash"></i> Hapus Akun
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle"></i> Konfirmasi Hapus Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.</p>
                <form method="post" action="{{ route('profile.destroy') }}" id="deleteForm">
                    @csrf
                    @method('delete')
                    <div class="mb-3">
                        <label for="delete_password" class="form-label">Masukkan Password untuk Konfirmasi</label>
                        <input id="delete_password" name="password" type="password" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="deleteForm" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus Akun</button>
            </div>
        </div>
    </div>
</div>

@endsection
