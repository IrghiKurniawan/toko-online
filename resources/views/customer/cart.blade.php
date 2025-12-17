@extends('templates.customer')

@section('content-customer')
    <div class="container py-5">
        {{-- Header --}}
        <div class="mb-4">
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-shopping-cart me-2" style="color:#002455; font-size: 1.5rem;"></i>
                <h2 class="h3 mb-0 fw-bold" style="color:#002455;">Keranjang Belanja</h2>
            </div>
            <p class="text-muted mb-0">Tinjau item sebelum melanjutkan ke pembayaran</p>
        </div>

        <div class="row g-4">
            {{-- CART ITEMS --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                    <div class="card-header" style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border: none; padding: 1.25rem;">
                        <h5 class="mb-0 fw-bold text-white">
                            <i class="fas fa-list-ul me-2"></i>Item Keranjang
                            @if ($cart && $cart->items->count() > 0)
                                <span class="badge rounded-pill ms-2" style="background-color:#FFC107; color:#002455;">
                                    {{ $cart->items->count() }} Items
                                </span>
                            @endif
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @if ($cart && $cart->items->count() > 0)
                            <div class="cart-items">
                                @foreach ($cart->items as $item)
                                    <div class="cart-item-card mb-3 p-3" style="background-color: #f8f9fa; border-radius: 12px; border: 2px solid transparent; transition: all 0.3s ease;">
                                        <div class="row align-items-center g-3">
                                            {{-- PRODUCT IMAGE & NAME --}}
                                            <div class="col-md-5">
                                                <div class="d-flex align-items-center">
                                                    <div class="product-image-wrapper me-3" style="position: relative;">
                                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                                            class="rounded border"
                                                            style="width: 80px; height: 80px; object-fit: cover; box-shadow: 0 4px 8px rgba(0,36,85,0.1);"
                                                            alt="{{ $item->product->name }}">
                                                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                                             style="background: rgba(0,36,85,0.8); opacity: 0; transition: opacity 0.3s; border-radius: 4px;">
                                                            <i class="fas fa-search-plus text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1 fw-bold" style="color:#002455;">
                                                            {{ $item->product->name }}
                                                        </h6>
                                                        <small class="text-muted">
                                                            <i class="fas fa-box me-1"></i>Stok: {{ $item->product->stock }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- PRICE --}}
                                            <div class="col-md-2 text-center">
                                                <small class="text-muted d-block mb-1">Harga</small>
                                                <p class="mb-0 fw-bold" style="color:#002455;">
                                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                                </p>
                                            </div>

                                            {{-- QTY CONTROLS --}}
                                            <div class="col-md-3 text-center">
                                                <small class="text-muted d-block mb-2">Jumlah</small>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <button class="btn btn-qty"
                                                            style="background-color:#002455; color:#fff; width: 36px; height: 36px; border-radius: 8px; border: none; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
                                                            onclick="updateQty('{{ route('customer.cart.decrease', $item->id) }}')">
                                                        <i class="fas fa-minus"></i>
                                                    </button>

                                                    <input type="text" class="form-control text-center mx-2 fw-bold"
                                                           style="width: 60px; border: 2px solid #002455; border-radius: 8px; color:#002455;"
                                                           value="{{ $item->quantity }}" readonly>

                                                    <button class="btn btn-qty"
                                                            style="background-color:#002455; color:#fff; width: 36px; height: 36px; border-radius: 8px; border: none; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
                                                            onclick="updateQty('{{ route('customer.cart.increase', $item->id) }}')">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- SUBTOTAL --}}
                                            <div class="col-md-2 text-end">
                                                <small class="text-muted d-block mb-1">Subtotal</small>
                                                <p class="mb-0 fw-bold fs-5" style="color:#FFC107;">
                                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Continue Shopping Button --}}
                            <div class="mt-4 pt-3 border-top">
                                <a href="{{ route('customer.product') }}" class="btn"
                                   style="background-color: transparent; color:#002455; border: 2px solid #002455; border-radius: 10px; padding: 0.625rem 1.5rem; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                                </a>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-shopping-cart" style="font-size: 4rem; color:#002455; opacity: 0.3;"></i>
                                </div>
                                <h5 class="mb-2" style="color:#002455;">Keranjang Belanja Kosong</h5>
                                <p class="text-muted mb-4">Belum ada produk yang ditambahkan ke keranjang</p>
                                <a href="{{ route('customer.product') }}" class="btn"
                                   style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); color:#fff; border: none; border-radius: 10px; padding: 0.75rem 2rem; font-weight: 600;">
                                    <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- SUMMARY --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-summary" style="border-radius: 16px; overflow: hidden;">
                    <div class="card-header" style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border: none; padding: 1.25rem;">
                        <h5 class="mb-0 fw-bold text-white">
                            <i class="fas fa-receipt me-2"></i>Ringkasan Pesanan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="summary-row d-flex justify-content-between mb-3 pb-3" style="border-bottom: 2px dashed #e9ecef;">
                            <span style="color:#002455; font-weight: 500;">
                                <i class="fas fa-shopping-bag me-2" style="color:#FFC107;"></i>Subtotal
                            </span>
                            <span class="fw-bold" style="color:#002455;">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="summary-row d-flex justify-content-between mb-3 pb-3" style="border-bottom: 2px dashed #e9ecef;">
                            <span style="color:#002455; font-weight: 500;">
                                <i class="fas fa-truck me-2" style="color:#FFC107;"></i>Pengiriman
                            </span>
                            <span class="text-muted fst-italic" style="font-size: 0.9rem;">
                                Dihitung saat checkout
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4 p-3"
                             style="background: linear-gradient(135deg, rgba(0,36,85,0.05) 0%, rgba(27,60,83,0.05) 100%); border-radius: 10px;">
                            <span class="fw-bold" style="color:#002455; font-size: 1.1rem;">
                                <i class="fas fa-calculator me-2"></i>Total
                            </span>
                            <span class="fw-bold" style="color:#FFC107; font-size: 1.5rem;">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </span>
                        </div>

                        @if ($cart && $cart->items->count() > 0)
                            <a href="{{ route('customer.checkout') }}" class="btn w-100 mb-3 checkout-btn"
                               style="background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%);
                                      color:#002455;
                                      border: none;
                                      border-radius: 12px;
                                      padding: 1rem;
                                      font-weight: 700;
                                      font-size: 1.1rem;
                                      box-shadow: 0 4px 12px rgba(255,193,7,0.4);
                                      transition: all 0.3s ease;">
                                <i class="fas fa-lock me-2"></i>Lanjut ke Pembayaran
                            </a>
                        @else
                            <button class="btn w-100" disabled
                                    style="background-color:#e9ecef;
                                           color:#6c757d;
                                           border: none;
                                           border-radius: 12px;
                                           padding: 1rem;
                                           font-weight: 700;">
                                <i class="fas fa-lock me-2"></i>Keranjang Kosong
                            </button>
                        @endif

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-shield-alt me-1" style="color:#002455;"></i>
                                Transaksi aman dan terpercaya
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function updateQty(url) {
        fetch(url, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {
                location.reload();
            });
    }
</script>

<style>
    /* Cart Item Card Hover */
    .cart-item-card {
        transition: all 0.3s ease;
    }

    .cart-item-card:hover {
        border-color: #002455 !important;
        background-color: #fff !important;
        box-shadow: 0 4px 12px rgba(0,36,85,0.1);
        transform: translateX(5px);
    }

    /* Product Image Hover */
    .product-image-wrapper:hover .position-absolute {
        opacity: 1 !important;
    }

    /* Quantity Button Hover */
    .btn-qty:hover {
        background-color: #1B3C53 !important;
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0,36,85,0.3);
    }

    .btn-qty:active {
        transform: scale(0.95);
    }

    /* Checkout Button Hover */
    .checkout-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255,193,7,0.5) !important;
        background: linear-gradient(135deg, #FFD54F 0%, #FFC107 100%) !important;
    }

    .checkout-btn:active {
        transform: translateY(-1px);
    }

    /* Continue Shopping Button Hover */
    .btn[href*="customer.index"]:hover {
        background-color: #002455 !important;
        color: #fff !important;
        transform: translateX(-5px);
    }

    /* Sticky Summary */
    .sticky-summary {
        position: sticky;
        top: 20px;
    }

    /* Summary Row Animation */
    .summary-row {
        transition: all 0.3s ease;
    }

    .summary-row:hover {
        padding-left: 10px;
    }

    /* Loading Animation for Update */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sticky-summary {
            position: relative;
            top: 0;
        }

        .cart-item-card .row > div {
            text-align: center !important;
        }

        .cart-item-card .d-flex {
            flex-direction: column;
            text-align: center;
        }

        .product-image-wrapper {
            margin: 0 auto 1rem !important;
        }
    }

    /* Smooth Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #002455;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #1B3C53;
    }
</style>
