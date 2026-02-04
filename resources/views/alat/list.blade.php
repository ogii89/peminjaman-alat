@extends('layouts.app')

@section('content')
<h4 class="mb-4">Daftar Alat</h4>

<div class="table-responsive">
    <table class="table-custom table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th class="actions">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alat as $a)
            <form method="POST" action="/pinjam/{{ $a->id }}">
                @csrf
            <tr>
                <td data-label="No">{{ $loop->iteration }}</td>
                <td data-label="Nama Alat">{{ $a->nama_alat }}</td>
                <td data-label="Kategori">{{ $a->kategori->nama_kategori }}</td>
                <td data-label="Stok">
                    <span class="badge bg-info">{{ $a->stok }} tersedia</span>
                </td>
                <td data-label="Tanggal Pinjam">
                    <input type="date" name="tanggal_pinjam" class="form-control form-control-sm" required>
                </td>
                <td data-label="Tanggal Kembali">
                    <input type="date" name="tanggal_kembali" class="form-control form-control-sm" required>
                </td>
                <td class="actions" data-label="Aksi">
                    <button class="btn btn-sm btn-outline-success table-btn" type="submit">
                        <i class="bi bi-check-circle"></i> Pinjam
                    </button>
                </td>
            </tr>
            </form>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i> Tidak ada data alat
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 p-3 bg-info bg-opacity-10 rounded">
    <h6 class="text-info"><i class="bi bi-info-circle"></i> Keterangan:</h6>
    <ul class="mb-0 small">
        <li><strong>Tanggal Pinjam:</strong> Tanggal ketika Anda akan mengambil alat ini</li>
        <li><strong>Tanggal Kembali:</strong> Tanggal ketika Anda harus mengembalikan alat ini</li>
        <li><strong>Aksi (Pinjam):</strong> Tombol untuk mengajukan peminjaman alat dengan tanggal yang sudah Anda pilih</li>
    </ul>
</div>

@endsection
