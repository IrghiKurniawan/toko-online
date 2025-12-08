@extends('templates.customer')

@section('content-customer')
<div class="d-flex justify-content-center align-items-center" style="min-height:70vh; background: linear-gradient(180deg,#e9f2ff 0%, #ffffff 100%);">
  <div class="card shadow-sm" style="width:380px; border: 1px solid rgba(0,123,255,0.15); border-radius:12px;">
    <div class="card-header text-white" style="background-color:#0d6efd; border-top-left-radius:12px; border-top-right-radius:12px;">
      <h5 class="mb-0">Masuk ke Akun Anda</h5>
    </div>

    <div class="card-body p-4">
      @if(session('error'))
        <div class="alert alert-danger py-2">{{ session('error') }}</div>
      @endif

      <form method="POST" action="{{ route('loginProcess') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="contoh@domain.com">
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <div class="input-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Masukkan kata sandi">
            <button type="button" class="btn btn-outline-secondary" id="togglePassword" title="Tampilkan/ Sembunyikan">👁️</button>
            @error('password')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Ingat saya</label>
          </div>
          <a href="" class="small">Lupa kata sandi?</a>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
      </form>

      <hr class="my-3">
      <p class="text-center small mb-0">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
    </div>
  </div>
</div>

{{-- Script kecil untuk toggle password (Bootstrap + vanilla JS) --}}
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('togglePassword');
    const pwd = document.getElementById('password');
    if (!toggle || !pwd) return;
    toggle.addEventListener('click', function () {
      const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
      pwd.setAttribute('type', type);
    });
  });
</script>
@endpush

@endsection
