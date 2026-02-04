@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-3">Data Kategori</h4>
    <form method="POST" action="{{ route('kategori.store') }}" class="row g-2">
        @csrf
        <div class="col-md-6">
            <input name="nama_kategori" class="form-control" placeholder="Nama kategori" required>
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
                <th>Nama Kategori</th>
                <th class="actions">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori as $k)
            <tr>
                <td data-label="No">{{ $loop->iteration }}</td>
                <td data-label="Nama Kategori">{{ $k->nama_kategori }}</td>
                <td class="actions" data-label="Aksi">
                    <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-sm btn-outline-warning table-btn">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('kategori.destroy', $k->id) }}" style="display:inline;">
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
                <td colspan="3" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i> Tidak ada data kategori
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
