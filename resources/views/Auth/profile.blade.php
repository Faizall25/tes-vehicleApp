@extends(auth()->user()->role === 'admin' ? 'admin.layouts.app' : 'approver.layouts..app')

@section('title', 'User Profile')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Profil Saya</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route(auth()->user()->role === 'admin' ? 'admin.profile.update' : 'approver.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password Baru (opsional)</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
        </form>
    </div>
</div>
@endsection
