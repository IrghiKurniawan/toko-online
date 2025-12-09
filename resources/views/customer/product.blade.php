@extends('templates.customer')

@section('content-customer')
    <div class="container py-5">

        {{-- Header Section --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">
            <div>
                <h2 class="h2 mb-1 fw-bold" style="color:#002455;">Produk Terbaru</h2>
                <p class="text-muted mb-0">Temukan produk berkualitas terbaik untuk Anda</p>
            </div>

            {{-- Search Bar --}}
            <form action="" method="GET" class="d-flex" style="max-width:450px; width:100%;">
                <div class="input-group shadow-sm">
                    <input type="search" name="search" value="{{ $search }}" class="form-control border-end-0"
                        placeholder="Cari produk yang Anda inginkan..." aria-label="Search" 
                        style="border: 2px solid #002455; padding: 0.625rem 1rem;" />
                    <button class="btn px-4" type="submit"
                        style="background-color:#002455; color:#fff; border: 2px solid #002455; border-left: none;">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="#" class="btn px-4" 
                        style="background-color:#FFC107; color:#002455; border: 2px solid #FFC107; font-weight: 600;">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge rounded-pill" style="background-color:#002455; font-size: 0.7rem; margin-left: 0.25rem;">0</span>
                    </a>
                </div>
            </form>
        </div>

        @if($products->isEmpty())
            <div class="alert shadow-sm text-center py-5" role="alert" 
                style="background-color: #E8F4F8; border: 2px solid #002455; border-radius: 12px;">
                <i class="fas fa-box-open fa-3x mb-3" style="color:#002455;"></i>
                <h5 style="color:#002455;" class="mb-2">Tidak ada produk yang ditemukan</h5>
                <p class="text-muted mb-0">Coba gunakan kata kunci pencarian yang berbeda</p>
            </div>
        @else
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 border-0 product-card"
                            style="background-color: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,36,85,0.1);">

                            <div class="position-relative overflow-hidden" style="height:240px; background: linear-gradient(135deg, #002455 0%, #1B3C53 100%);">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top h-100 w-100"
                                    style="object-fit:cover; transition: transform 0.4s ease;" alt="{{ $product->name }}" loading="lazy">

                                @if($product->stock > 0)
                                    <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2"
                                        style="background-color:#FFC107; color:#002455; font-weight: 600; border-radius: 8px;">
                                        Stok: {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2"
                                        style="background-color:#dc3545; color:#fff; font-weight: 600; border-radius: 8px;">
                                        <i class="fas fa-times-circle me-1"></i>Habis
                                    </span>
                                @endif

                                {{-- Quick View Overlay --}}
                                <div class="position-absolute bottom-0 start-0 end-0 p-2 quick-view-overlay" 
                                    style="background: linear-gradient(to top, rgba(0,36,85,0.9), transparent); opacity: 0; transition: opacity 0.3s ease;">
                                    <button class="btn btn-sm w-100" style="background-color:#fff; color:#002455; font-weight: 600;">
                                        <i class="fas fa-eye me-1"></i>Lihat Detail
                                    </button>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title mb-2 fw-bold" title="{{ $product->name }}" 
                                    style="color:#002455; 
                                    display: -webkit-box; 
                                    -webkit-line-clamp: 2; 
                                    -webkit-box-orient: vertical; 
                                    overflow: hidden; 
                                    min-height: 3em;
                                    line-height: 1.4;">
                                    {{ $product->name }}
                                </h5>

                                <div class="mb-3">
                                    <p class="card-text fw-bold mb-0" style="color:#002455; font-size: 1.5rem;">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    <small class="text-muted">Harga terbaik</small>
                                </div>

                                <div class="mt-auto">
                                    @if($product->stock > 0)
                                        <a href="{{ route('customer.cart.add', $product->id) }}" class="btn w-100 add-to-cart-btn"
                                            style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); 
                                                   color:#fff; 
                                                   border:none; 
                                                   padding: 0.75rem;
                                                   border-radius: 10px;
                                                   font-weight: 600;
                                                   transition: all 0.3s ease;
                                                   box-shadow: 0 4px 8px rgba(0,36,85,0.2);">
                                            <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
                                        </a>
                                    @else
                                        <button class="btn w-100" disabled 
                                            style="background-color:#e9ecef; 
                                                   color:#6c757d; 
                                                   border:none;
                                                   padding: 0.75rem;
                                                   border-radius: 10px;
                                                   font-weight: 600;">
                                            <i class="fas fa-times-circle me-2"></i>Stok Habis
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>

    <style>
        /* Product Card Hover Effects */
        .product-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,36,85,0.2) !important;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-card:hover .quick-view-overlay {
            opacity: 1;
        }

        /* Button Hover Effects */
        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, #1B3C53 0%, #002455 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,36,85,0.3) !important;
        }

        .add-to-cart-btn:active {
            transform: translateY(0);
        }

        /* Pagination Styling */
        .pagination {
            gap: 0.5rem;
        }

        .pagination .page-link {
            color: #002455;
            border: 2px solid #002455;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #002455 0%, #1B3C53 100%);
            border-color: #002455;
            box-shadow: 0 4px 8px rgba(0,36,85,0.3);
        }

        .pagination .page-link:hover {
            background-color: #1B3C53;
            color: #fff;
            border-color: #1B3C53;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,36,85,0.2);
        }

        /* Search Input Focus State */
        .form-control:focus {
            border-color: #002455 !important;
            box-shadow: 0 0 0 0.25rem rgba(0, 36, 85, 0.15) !important;
            outline: none;
        }

        /* Search Button Hover */
        .input-group .btn:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        /* Badge Animation */
        .badge {
            animation: fadeInDown 0.5s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .h2 {
                font-size: 1.5rem;
            }
            
            .card-body {
                padding: 1rem !important;
            }
        }
    </style>
@endsection