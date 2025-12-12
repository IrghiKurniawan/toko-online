@extends('templates.admin')

@section('content-admin')
<div class="container mt-4">

    <h3 class="mb-3">Daftar Akun</h3>

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('admin.account.data') }}" class="mb-3 d-flex" style="max-width: 350px;">
        <input type="text" name="cari" class="form-control" placeholder="Cari nama..."
               value="{{ request('cari') }}">
        <button class="btn btn-primary ms-2">Cari</button>
    </form>

    <a href="{{ route('admin.account.create') }}" class="btn btn-success mb-3">+ Tambah Akun</a>

    {{-- Tabel Data Akun --}}
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $index => $user)
            <tr>
                <td>{{ $users->firstItem() + $index }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <a href="{{ route('admin.account.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.account.delete', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus akun ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

</div>
@endsection
