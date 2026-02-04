<!DOCTYPE html>
<html>
<head>
    <title>UKK Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Top fixed navbar */
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            padding-top: 70px; /* reserve space for fixed navbar */
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            margin: 0;
            padding-left: 0;
            padding-right: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1100;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
        }

        .logout-btn {
            background-color: #ff6b6b;
            border: none;
            border-radius: 5px;
            color: white;
            padding: 8px 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff5252;
            transform: translateY(-2px);
        }

        /* Sidebar fixed to left, flush to top (no gap) */
        .sidebar {
            position: fixed;
            top: 0; /* flush to top */
            left: 0;
            bottom: 0;
            width: 220px; /* adjust if needed */
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            padding-top: 70px; /* push sidebar content below navbar visually */
            padding-bottom: 24px;
            padding-left: 12px;
            padding-right: 12px;
            overflow-y: auto;
            box-shadow: 2px 0 14px rgba(0,0,0,0.08);
            z-index: 1000;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-item {
            margin-bottom: 0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.25s ease;
            border-left: 4px solid transparent;
            border-radius: 6px;
        }

        .sidebar-link:hover {
            background-color: rgba(255,255,255,0.06);
            color: white;
            border-left-color: #667eea;
        }

        .sidebar-link i {
            margin-right: 12px;
            font-size: 1.3rem;
            width: 28px;
            text-align: center;
        }

        .sidebar-section-title {
            padding: 12px 18px 8px;
            color: #95a5a6;
            font-size: 0.85rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        /* Main/content shifted right so it doesn't sit under fixed sidebar */
        .main {
            display: flex;
            align-items: flex-start;
            gap: 24px;
            padding: 20px;
            width: 100%;
        }

        .content {
            flex: 1;
            margin-left: 220px; /* match .sidebar width */
            padding: 30px;
            background-color: #f8f9fa;
            margin-top: 0;
        }

        .alert {
            margin-bottom: 20px;
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }
        /* Table styles */
        .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .table-custom {
          width: 100%;
          border-collapse: separate;
          border-spacing: 0;
          background: #fff;
          border-radius: 10px;
          overflow: hidden;
          box-shadow: 0 6px 18px rgba(15,23,42,0.06);
          font-size: 0.95rem;
          margin-bottom: 1.5rem;
        }
        .table-custom thead {
          background: linear-gradient(90deg,#fafafa,#f1f5f9);
        }
        .table-custom th {
          font-weight: 700;
          color: #374151;
          padding: 14px 18px;
          text-align: left;
          border-bottom: 1px solid rgba(15,23,42,0.06);
        }
        .table-custom td {
          padding: 12px 18px;
          color: #4b5563;
          border-bottom: 1px solid rgba(15,23,42,0.04);
          vertical-align: middle;
        }
        .table-custom tbody tr:nth-child(even) { background: rgba(2,6,23,0.02); }
        .table-custom tbody tr:hover { background: rgba(102,126,234,0.04); }
        .table-custom .actions { white-space: nowrap; text-align: right; }
        .table-btn {
          padding: 6px 10px;
          font-size: 0.85rem;
          border-radius: 6px;
          display: inline-flex;
          align-items: center;
          gap: 4px;
          margin: 2px;
        }
        .btn-outline-warning:hover { background-color: #ffc107; color: #000; }
        .btn-outline-danger:hover { background-color: #dc3545; color: #fff; }
        .table-sm td, .table-sm th { padding: 8px 10px; font-size: 0.9rem; }

        @media (max-width: 992px) {
            /* Mobile: sidebar becomes static and full-width; content resets margin */
            body {
                padding-top: 0;
            }

            .navbar {
                position: relative;
                height: auto;
            }

            .main {
                flex-direction: column;
                padding: 12px;
            }

            .sidebar {
                position: static;
                top: auto;
                left: auto;
                bottom: auto;
                width: 100%;
                padding: 12px 0;
                box-shadow: none;
                height: auto;
            }

            .content {
                margin-left: 0;
                padding: 15px;
            }

            .sidebar-link {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark" style="height: 70px; padding: 0 20px;">
    <span class="navbar-brand">
        <i class="bi bi-tools"></i> Aplikasi Peminjaman Alat
    </span>
    <div class="d-flex align-items-center gap-3">
        <div class="dropdown">
            <button class="btn btn-link text-white text-decoration-none dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 0.9rem;">
                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person"></i> Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button class="dropdown-item text-danger" type="submit">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main area (sidebar + content) -->
<div class="main">

    <!-- Sidebar -->
    <div class="sidebar">
    <ul class="sidebar-menu">
        <div class="sidebar-section-title">
            <i class="bi bi-speedometer2"></i> Dashboard
        </div>
        <li class="sidebar-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <i class="bi bi-house"></i> Home
            </a>
        </li>

        @if(auth()->user()->role === 'admin')
        <div class="sidebar-section-title">
            <i class="bi bi-shield-lock"></i> Admin Panel
        </div>
        <li class="sidebar-item">
            <a href="{{ route('kategori.index') }}" class="sidebar-link">
                <i class="bi bi-tag"></i> Kategori Alat
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('alat.index') }}" class="sidebar-link">
                <i class="bi bi-box"></i> Data Alat
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('users.index') }}" class="sidebar-link">
                <i class="bi bi-people"></i> Kelola User
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ url('log-aktivitas') }}" class="sidebar-link">
                <i class="bi bi-clock-history"></i> Log Aktivitas
            </a>
        </li>
        @elseif(auth()->user()->role === 'petugas')
        <div class="sidebar-section-title">
            <i class="bi bi-briefcase"></i> Petugas
        </div>
        <li class="sidebar-item">
            <a href="{{ url('peminjaman') }}" class="sidebar-link">
                <i class="bi bi-arrow-left-right"></i> Kelola Peminjaman
            </a>
        </li>
        @elseif(auth()->user()->role === 'peminjam')
        <div class="sidebar-section-title">
            <i class="bi bi-person"></i> Peminjam
        </div>
        <li class="sidebar-item">
            <a href="{{ url('daftar-alat') }}" class="sidebar-link">
                <i class="bi bi-shop"></i> Daftar Alat
            </a>
        </li>
        @endif
    </ul>
</div>

    <!-- Content -->
    <div class="content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>







