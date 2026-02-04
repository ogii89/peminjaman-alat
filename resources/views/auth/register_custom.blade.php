<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Aplikasi Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body{
            background: linear-gradient(135deg,#f6d365 0%, #fda085 100%);
            min-height: 100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card-register{
            width:100%;
            max-width:720px;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 20px 50px rgba(0,0,0,0.15);
            background:white;
            display:grid;
            grid-template-columns:1fr 1fr;
        }
        .left{
            padding:40px;
            background:linear-gradient(135deg,#667eea 0%, #764ba2 100%);
            color:white;
            display:flex;
            flex-direction:column;
            align-items:flex-start;
            justify-content:center;
        }
        .left h2{font-size:1.6rem;margin-bottom:6px}
        .left p{opacity:0.95}
        .right{padding:36px}
        .form-control{border-radius:10px;padding:12px}
        .btn-register{background:#2b6cb0;color:white;border:none;padding:10px 20px;border-radius:10px}
        @media(max-width:900px){.card-register{grid-template-columns:1fr;}}
    </style>
</head>
<body>
    <div class="card-register">
        <div class="left">
            <h2>Buat Akun Baru</h2>
            <p>Daftar untuk mengakses sistem peminjaman alat. Pilih role sesuai dengan kebutuhan.</p>
        </div>
        <div class="right">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="peminjam">Peminjam</option>
                        <option value="petugas">Petugas</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg" style="border-radius:10px;">
                            <i class="bi bi-person-plus-fill me-2"></i> Daftar Sekarang
                        </button>
                    </div>
                </div>

                <div class="text-center mt-2">
                    <span class="small text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Masuk</a></span>
                </div>
            </form>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>