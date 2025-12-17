@extends('templates.admin')

@section('content-admin')
    <div class="container mt-4">

        <h3 class="mb-3">Tambah Akun</h3>

        <form action="{{ route('admin.account.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.account.data') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
@endsection
