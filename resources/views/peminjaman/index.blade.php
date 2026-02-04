@extends('layouts.app')

@section('content')
<h4 class="mb-4">Data Peminjaman</h4>

<div class="table-responsive">
    <table class="table-custom table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th class="actions">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $p)
            <tr>
                <td data-label="No">{{ $loop->iteration }}</td>
                <td data-label="Peminjam">{{ $p->user->name }}</td>
                <td data-label="Alat">{{ $p->alat->nama_alat }}</td>
                <td data-label="Tanggal Pinjam">{{ $p->tanggal_pinjam ? \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') : '-' }}</td>
                <td data-label="Tanggal Kembali">{{ $p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali)->format('d-m-Y') : '-' }}</td>
                <td data-label="Status">
                    <span class="badge {{ $p->status == 'dipinjam' ? 'bg-warning text-dark' : 'bg-success' }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
                <td class="actions" data-label="Aksi">
                    @if($p->status == 'dipinjam')
                    <form method="POST" action="/peminjaman/{{ $p->id }}/kembali" style="display:inline;">
                        @csrf
                        <button class="btn btn-sm btn-outline-warning table-btn" type="submit">
                            <i class="bi bi-arrow-return-left"></i> Kembalikan
                        </button>
                    </form>
                    @else
                    <span class="text-muted small">Selesai</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4 p-3 bg-info bg-opacity-10 rounded">
    <h6 class="text-info"><i class="bi bi-info-circle"></i> Penjelasan Kolom Aksi:</h6>
    <ul class="mb-0 small">
        <li><strong>Kembalikan (Tombol Yellow):</strong> Tombol untuk memproses pengembalian alat ketika peminjam mengembalikan barangnya. Setelah diklik, status akan berubah menjadi "Dikembalikan" dan stok alat akan bertambah kembali.</li>
    </ul>
</div>

@endsection
