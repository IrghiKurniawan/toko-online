@extends('templates.admin')

@section('content-admin')
    <style>
        .page-wrapper {
            margin-top: 70px;
        }

        .product-card img {
            height: 170px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .product-card {
            border-radius: 8px;
            transition: 0.2s ease-in-out;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }
    </style>

    <div class="container-fluid page-wrapper">

        <!-- Header & Search -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-2">
            <h5 class="fw-semibold mb-0">Produk</h5>

            <div class="d-flex gap-2" style="width: 420px;">
                <form method="GET" class="flex-grow-1">
                    <div class="input-group shadow-sm">
                        <input type="search" name="search" value="{{ request('search') }}"
                            class="form-control border-end-0"
                            placeholder="Cari produk..."
                            style="border:2px solid #002455;">
                        <button class="btn px-3"
                            style="background:#002455;color:#fff;border:2px solid #002455;border-left:none;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <a href="{{ route('admin.product.create') }}" class="btn btn-primary px-3">
                    + Tambah
                </a>
            </div>
        </div>

        {{-- Jika kosong --}}
        @if ($products->isEmpty())
            <div class="alert text-center py-5 shadow-sm"
                style="background:#E8F4F8;border:2px dashed #002455;border-radius:12px;">
                <i class="fas fa-box-open fa-3x mb-3 text-primary"></i>
                <h6 class="fw-semibold mb-1">Produk tidak ditemukan</h6>
                <small class="text-muted">Coba kata kunci lain</small>
            </div>
        @else
            <!-- Product Cards -->
            <div class="row g-4">
                @foreach ($products as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card product-card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">

                            <div class="card-body">
                                <h6 class="fw-semibold mb-1 text-truncate">
                                    {{ $item->name }}
                                </h6>

                                <p class="fw-bold text-primary mb-2">
                                    Rp {{ number_format($item->price) }}
                                </p>

                                <span class="badge bg-success">
                                    Stok: {{ $item->stock }}
                                </span>
                            </div>

                            <div class="card-footer bg-white border-0 d-flex justify-content-between">
                                <a href="{{ route('admin.product.edit' , $item->id) }}" class="btn btn-sm btn-outline-warning">
                                    Edit
                                </a>
                                <form action="{{ route('admin.product.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
