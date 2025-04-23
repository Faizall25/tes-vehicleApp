@extends('approver.layouts.app')

@section('title', 'Approval Pemesanan Kendaraan')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h4 text-gray-800">Daftar Pemesanan Menunggu Persetujuan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kendaraan</th>
                        <th>Supir</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status Approval</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingApprovals as $approval)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $approval->booking->vehicle->name }}</td>
                            <td>{{ $approval->booking->driver->name }}</td>
                            <td>{{ $approval->booking->start_date }}</td>
                            <td>{{ $approval->booking->end_date }}</td>
                            <td>
                                <span class="badge badge-{{ $approval->status == 'pending' ? 'warning' : ($approval->status == 'approved' ? 'success' : 'danger') }}">
                                    {{ ucfirst($approval->status) }}
                                </span>
                            </td>
                            <td>{{ $approval->notes ?? '-' }}</td>
                            <td>
                                @if($approval->status === 'pending')
                                    <!-- Approve Form -->
                                    <form action="{{ route('approver.bookings.approve', $approval->booking_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-success" onclick="return confirm('Setujui pemesanan ini?')">Setujui</button>
                                    </form>

                                    <!-- Reject Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#rejectModal{{ $approval->id }}">
                                        Tolak
                                    </button>

                                    <!-- Modal Tolak -->
                                    <div class="modal fade" id="rejectModal{{ $approval->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel{{ $approval->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form method="POST" action="{{ route('approver.bookings.reject', $approval->booking_id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rejectModalLabel{{ $approval->id }}">Tolak Pemesanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="notes">Catatan Penolakan</label>
                                                            <textarea name="notes" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Tolak Pemesanan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <small class="text-muted">Sudah Diproses</small>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada pemesanan menunggu persetujuan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
