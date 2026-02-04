@extends('layouts.app')

@section('content')
<h4 class="mb-4">Log Aktivitas</h4>

<div class="table-responsive">
    <table class="table-custom table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Aktivitas</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td data-label="No">{{ $loop->iteration }}</td>
                <td data-label="User">
                    <span class="badge bg-primary">{{ $log->user->name ?? 'Unknown' }}</span>
                </td>
                <td data-label="Aktivitas">{{ $log->aktivitas ?? '-' }}</td>
                <td data-label="Waktu">
                    <small class="text-muted">
                        {{ $log->created_at ? $log->created_at->format('d-m-Y H:i:s') : '-' }}
                    </small>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted py-4">
                    <i class="bi bi-inbox"></i> Tidak ada data log aktivitas
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
