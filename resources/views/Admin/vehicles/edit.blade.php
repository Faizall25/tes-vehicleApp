@extends('admin.layouts.app')

@section('title', 'Edit Kendaraan')

@section('content')
    <h1 class="h4 mb-4 text-gray-800">Edit Kendaraan</h1>

    <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <input type="text" name="name" class="form-control" value="{{ $vehicle->name }}" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kendaraan</label>
                    <select name="type" class="form-control" required>
                        <option value="angkutan_orang" {{ (old('type') ?? ($vehicle->type ?? '')) == 'angkutan_orang' ? 'selected' : '' }}>Angkutan Orang</option>
                        <option value="angkutan_barang" {{ (old('type') ?? ($vehicle->type ?? '')) == 'angkutan_barang' ? 'selected' : '' }}>Angkutan Barang</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Disewa?</label>
                    <select name="is_rented" class="form-control" required>
                        <option value="0" {{ $vehicle->is_rented == 0 ? 'selected' : '' }}>Tidak</option>
                        <option value="1" {{ $vehicle->is_rented == 1 ? 'selected' : '' }}>Ya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kapasitas</label>
                    <input type="number" name="capacity" class="form-control" value="{{ $vehicle->capacity }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
@endsection
