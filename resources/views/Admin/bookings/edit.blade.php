@extends('admin.layouts.app')

@section('title', 'Edit Pemesanan')

@section('content')
    <h1 class="h4 mb-3">Edit Pemesanan Kendaraan</h1>

    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.bookings.form', ['booking' => $booking])
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
