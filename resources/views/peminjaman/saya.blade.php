@extends('layouts.app')

@section('content')
<h4>Peminjaman Saya</h4>

<table class="table table-bordered">
<tr>
    <th>Alat</th><th>Tanggal Pinjam</th><th>Tanggal Kembali</th><th>Status</th><th>Denda</th>
</tr>
@foreach($peminjaman as $p)
<tr>
    <td>{{ $p->alat->nama_alat }}</td>
    <td>{{ $p->tanggal_pinjam ? \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') : '-' }}</td>
    <td>{{ $p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali)->format('d-m-Y') : '-' }}</td>
    <td>
        <span class="badge {{ $p->status == 'dipinjam' ? 'bg-warning' : 'bg-success' }}">
            {{ ucfirst($p->status) }}
        </span>
    </td>
    <td>
        <strong class="text-danger">
            Rp {{ number_format($p->denda, 0, ',', '.') }}
        </strong>
    </td>
</tr>
@endforeach
</table>

<div class="mt-4 p-3 bg-info bg-opacity-10 rounded">
    <h6 class="text-info"><i class="bi bi-info-circle"></i> Penjelasan:</h6>
    <ul class="mb-0 small">
        <li><strong>Tanggal Pinjam:</strong> Tanggal ketika Anda mengambil alat</li>
        <li><strong>Tanggal Kembali:</strong> Tanggal target pengembalian alat (atau tanggal Anda benar-benar mengembalikan jika sudah dikembalikan)</li>
        <li><strong>Status:</strong> Menunjukkan apakah alat masih "Dipinjam" atau sudah "Dikembalikan"</li>
        <li><strong>Denda:</strong> Biaya keterlambatan (Rp 5.000 per hari jika melampaui 7 hari peminjaman). Jika Rp 0, berarti tidak ada denda</li>
    </ul>
</div>

@endsection
