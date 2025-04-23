@extends('admin.layouts.app')

@section('title', 'Data Supir')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h4 text-gray-800">Data Supir</h1>
        <a href="{{ route('admin.drivers.create') }}" class="btn btn-primary btn-sm">+ Tambah Supir</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drivers as $driver)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $driver->name }}</td>
                            <td>{{ $driver->phone }}</td>
                            <td>
                                <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus supir ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data supir.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
