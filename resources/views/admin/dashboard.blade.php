@extends('templates.admin')

@section('content-admin')
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="text-center">
        <h3 class="fw-semibold text-primary mb-2">
            Halaman Admin
        </h3>

        <p class="text-muted mb-4">
            Selamat datang di panel admin.
        </p>

        <div class="border rounded p-4 bg-light">
            <p class="mb-1 fw-medium">
                Anda login sebagai <span class="text-primary">Admin</span>
            </p>
            <small class="text-muted">
                Gunakan menu di atas untuk mengelola data.
            </small>
        </div>
    </div>
</div>
@endsection
