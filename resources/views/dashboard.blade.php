@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="p-4 mb-4 rounded-4" style="background: linear-gradient(90deg,#eef2ff,#fef3c7);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1" style="font-weight:700">Halo, {{ auth()->user()->name }} 👋</h3>
                    <p class="mb-0 text-muted">Selamat datang di dashboard Aplikasi Peminjaman Alat. Mulai dengan memilih menu di sidebar atau gunakan shortcut di bawah.</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">Role Anda</small>
                    <div class="mt-1">
                        <span class="badge" style="background-color: {{ auth()->user()->role === 'admin' ? '#3b82f6' : (auth()->user()->role === 'petugas' ? '#f59e0b' : '#06b6d4') }}; color: #fff; padding: 6px 14px; border-radius: 8px; font-weight:600;">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick stats -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-md-4">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <div class="me-3 p-3 rounded-3" style="background: rgba(99,102,241,0.12)">
                    <i class="bi bi-people text-primary fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Users</div>
                    <div class="fs-5 fw-bold">{{ $userCount }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <div class="me-3 p-3 rounded-3" style="background: rgba(16,185,129,0.12)">
                    <i class="bi bi-box-seam text-success fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Alat</div>
                    <div class="fs-5 fw-bold">{{ $alatCount }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <div class="me-3 p-3 rounded-3" style="background: rgba(59,130,246,0.12)">
                    <i class="bi bi-journal-text text-info fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Peminjaman</div>
                    <div class="fs-5 fw-bold">{{ $peminjamanCount }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick actions -->
<div class="mb-3">
    <h5 class="fw-bold">Quick Actions</h5>
    <p class="text-muted small mb-2">Akses cepat ke fitur yang sering digunakan sesuai role Anda.</p>
</div>

@if(auth()->user()->role === 'admin')
<div class="row">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100" style="border-radius: 10px; border-left: 4px solid #667eea; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 15px rgba(102,126,234,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="bi bi-tag"></i> Kategori Alat</h5>
                <p class="card-text text-muted">Kelola kategori dan jenis alat</p>
                <a href="{{ route('kategori.index') }}" class="btn btn-primary btn-sm">Buka Menu</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100" style="border-radius: 10px; border-left: 4px solid #27ae60; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 15px rgba(39,174,96,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'">
            <div class="card-body">
                <h5 class="card-title text-success"><i class="bi bi-box"></i> Data Alat</h5>
                <p class="card-text text-muted">Kelola daftar dan stok alat</p>
                <a href="{{ route('alat.index') }}" class="btn btn-success btn-sm">Buka Menu</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100" style="border-radius: 10px; border-left: 4px solid #9b59b6; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 15px rgba(155,89,182,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'">
            <div class="card-body">
                <h5 class="card-title text-success" style="color: #9b59b6 !important;"><i class="bi bi-people"></i> Kelola User</h5>
                <p class="card-text text-muted">Atur pengguna sistem</p>
                <a href="{{ route('users.index') }}" class="btn btn-sm" style="background-color: #9b59b6; color: white;">Buka Menu</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100" style="border-radius: 10px; border-left: 4px solid #f39c12; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 15px rgba(243,156,18,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'">
            <div class="card-body">
                <h5 class="card-title text-warning"><i class="bi bi-clock-history"></i> Log Aktivitas</h5>
                <p class="card-text text-muted">Lihat riwayat aktivitas sistem</p>
                <a href="{{ url('log-aktivitas') }}" class="btn btn-warning btn-sm">Buka Menu</a>
            </div>
        </div>
    </div>
</div>

@elseif(auth()->user()->role === 'petugas')
<div class="row">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100" style="border-radius: 10px; border-left: 4px solid #3498db; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 15px rgba(52,152,219,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'">
            <div class="card-body">
                <h5 class="card-title text-info"><i class="bi bi-arrow-left-right"></i> Kelola Peminjaman</h5>
                <p class="card-text text-muted">Proses peminjaman dan pengembalian alat</p>
                <a href="{{ url('peminjaman') }}" class="btn btn-info btn-sm">Buka Menu</a>
            </div>
        </div>
    </div>
</div>

@elseif(auth()->user()->role === 'peminjam')
<div class="row">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100" style="border-radius: 10px; border-left: 4px solid #17a2b8; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 15px rgba(23,162,184,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'">
            <div class="card-body">
                <h5 class="card-title text-info"><i class="bi bi-shop"></i> Daftar Alat</h5>
                <p class="card-text text-muted">Lihat dan pinjam alat yang tersedia</p>
                <a href="{{ url('daftar-alat') }}" class="btn btn-info btn-sm">Lihat Alat</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
