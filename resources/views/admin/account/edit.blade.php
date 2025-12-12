@extends('templates.admin')

@section('content-admin')
    <div class="container mt-4">

        <h3 class="mb-3">Edit Akun</h3>

        <form action="{{ route('admin.account.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.account.data') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
@endsection
