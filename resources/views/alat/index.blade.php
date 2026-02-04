@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-3">Data Alat</h4>
    <form method="POST" action="{{ route('alat.store') }}" class="row g-2">
        @csrf
        <div class="col-md-3">
            <input name="nama_alat" class="form-control" placeholder="Nama alat" required>
        </div>
        <div class="col-md-3">
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input name="stok" type="number" class="form-control" placeholder="Stok" required>
        </div>
        <div class="col-md-auto">
            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</button>
        </div>
    </form>
</div>

<div class="table-responsive">
    <table class="table-custom table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th class="actions">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alat as $a)
            <tr>
                <td data-label="No">{{ $loop->iteration }}</td>
                <td data-label="Nama Alat">{{ $a->nama_alat }}</td>
                <td data-label="Kategori">{{ $a->kategori->nama_kategori }}</td>
                <td data-label="Stok"><span class="badge bg-info">{{ $a->stok }}</span></td>
                <td class="actions" data-label="Aksi">
                    <a href="{{ route('alat.edit', $a->id) }}" class="btn btn-sm btn-outline-warning table-btn">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('alat.destroy', $a->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger table-btn" onclick="return confirm('Yakin ingin menghapus?')">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i> Tidak ada data alat
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
