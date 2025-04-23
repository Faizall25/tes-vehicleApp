@extends('admin.layouts.app')

@section('title', 'Data Kendaraan')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h4 text-gray-800">Data Kendaraan</h1>
        <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary btn-sm">+ Tambah Kendaraan</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Disewa</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $vehicle->name }}</td>
                            <td>{{ ucfirst($vehicle->type) }}</td>
                            <td>{{ $vehicle->is_rented ? 'Ya' : 'Tidak' }}</td>
                            <td>{{ $vehicle->capacity }} orang</td>
                            <td>
                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-info">Edit</a>
                                
                                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data kendaraan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
