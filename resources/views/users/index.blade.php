@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Kelola User</h4>
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus"></i> Tambah User
    </a>
</div>

<div class="table-responsive">
    <table class="table-custom table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="actions">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td data-label="No">{{ $loop->iteration }}</td>
                <td data-label="Nama">{{ $user->name }}</td>
                <td data-label="Email">{{ $user->email }}</td>
                <td data-label="Role">
                    <span class="badge {{ 
                        $user->role === 'admin' ? 'bg-danger' : 
                        ($user->role === 'petugas' ? 'bg-warning text-dark' : 'bg-info')
                    }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td class="actions" data-label="Aksi">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning table-btn">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger table-btn" onclick="return confirm('Yakin ingin menghapus user ini?')">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i> Tidak ada data user
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 p-3 bg-info bg-opacity-10 rounded">
    <h6 class="text-info"><i class="bi bi-info-circle"></i> Penjelasan Role:</h6>
    <ul class="mb-0 small">
        <li><strong>Admin:</strong> Dapat mengelola semua fitur (kategori, alat, user, log aktivitas)</li>
        <li><strong>Petugas:</strong> Dapat mengelola peminjaman dan pengembalian alat</li>
        <li><strong>Peminjam:</strong> Dapat melihat daftar alat dan meminjam alat</li>
    </ul>
</div>
@endsection
