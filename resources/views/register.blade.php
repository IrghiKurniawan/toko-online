@extends('templates.app')

@section('content-dinamis')
<div class="container mt-5" style="max-width: 450px;">
  <h3 class="text-center mb-3">Daftar Akun Baru</h3>

  <form method="POST" action="{{ route('registerUser') }}">
    @csrf

    <div class="mb-3">
      <label>Nama</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Konfirmasi Password</label>
      <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button class="btn btn-primary w-100">Daftar</button>

    <p class="text-center mt-3">
      Sudah punya akun? <a href="{{ route('login') }}">Login</a>
    </p>
  </form>
</div>
@endsection
