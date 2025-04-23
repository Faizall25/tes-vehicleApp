@extends('admin.layouts.app')

@section('title', 'Edit Supir')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1 class="h4 text-gray-800">Edit Supir</h1>
        <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Supir</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $driver->name) }}">
                </div>

                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="phone" class="form-control" required value="{{ old('phone', $driver->phone) }}">
                </div>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
