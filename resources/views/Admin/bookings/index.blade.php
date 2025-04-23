@extends('admin.layouts.app')

@section('title', 'Data Pemesanan Kendaraan')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h4 text-gray-800">Data Pemesanan Kendaraan</h1>
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary btn-sm">+ Tambah Pemesanan</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan kendaraan..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-3 mb-2">
                    <select name="status" class="form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                </div>
                <div class="col-md-2 mb-2">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-block">Reset</a>
                </div>
            </div>
        </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kendaraan</th>
                        <th>Supir</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->vehicle->name }}</td>
                            <td>{{ $booking->driver->name }}</td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->end_date }}</td>
                            <td><span class="badge badge-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($booking->status) }}</span>
                            </td>
                            <td>{{ $booking->notes }}</td>
                            <td>
                                @if($booking->status === 'pending')
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan?')">Batal</button>
                                    </form>
                                @else
                                    <small class="text-muted">Tidak tersedia</small>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data pemesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
