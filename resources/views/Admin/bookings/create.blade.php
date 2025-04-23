@extends('admin.layouts.app')

@section('title', 'Tambah Pemesanan Kendaraan')

@section('content')
    <h1 class="h4 mb-3">Tambah Pemesanan Kendaraan</h1>
    <form action="{{ route('admin.bookings.store') }}" method="POST">
        @csrf
        @include('admin.bookings.form')
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
