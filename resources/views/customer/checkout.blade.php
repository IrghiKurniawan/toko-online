@extends('templates.customer')

@section('content-customer')
    <div class="container py-5">
        {{-- Header --}}
        <div class="mb-4">
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-credit-card me-2" style="color:#002455; font-size: 1.5rem;"></i>
                <h2 class="h3 mb-0 fw-bold" style="color:#002455;">Checkout</h2>
            </div>
            <p class="text-muted mb-0">Selesaikan pesanan Anda dengan aman</p>

            {{-- Progress Steps --}}
            <div class="checkout-steps mt-4">
                <div class="d-flex justify-content-between align-items-center position-relative">
                    <div class="step-line"
                        style="position: absolute; top: 20px; left: 0; right: 0; height: 2px; background-color: #e9ecef; z-index: 0;">
                    </div>
                    <div class="step-line-active"
                        style="position: absolute; top: 20px; left: 0; width: 66%; height: 2px; background-color: #FFC107; z-index: 1;">
                    </div>

                    <div class="step-item text-center position-relative" style="z-index: 2;">
                        <div class="step-circle mx-auto mb-2"
                            style="width: 40px; height: 40px; background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(0,36,85,0.3);">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <small class="fw-bold" style="color:#002455;">Keranjang</small>
                    </div>

                    <div class="step-item text-center position-relative" style="z-index: 2;">
                        <div class="step-circle mx-auto mb-2"
                            style="width: 40px; height: 40px; background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(255,193,7,0.4);">
                            <i class="fas fa-credit-card" style="color:#002455;"></i>
                        </div>
                        <small class="fw-bold" style="color:#002455;">Checkout</small>
                    </div>

                    <div class="step-item text-center position-relative" style="z-index: 2;">
                        <div class="step-circle mx-auto mb-2"
                            style="width: 40px; height: 40px; background-color: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check-circle" style="color:#6c757d;"></i>
                        </div>
                        <small class="text-muted">Selesai</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- LEFT: ORDER ITEMS --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
                    <div class="card-header"
                        style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border: none; padding: 1.25rem;">
                        <h5 class="mb-0 fw-bold text-white">
                            <i class="fas fa-box-open me-2"></i>Item Pesanan
                            <span class="badge rounded-pill ms-2" style="background-color:#FFC107; color:#002455;">
                                {{ $cart->items->count() }} Items
                            </span>
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @foreach ($cart->items as $item)
                            <div class="order-item-card d-flex justify-content-between align-items-center mb-3 p-3"
                                style="background-color: #f8f9fa; border-radius: 12px; border: 2px solid transparent; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="item-icon me-3"
                                        style="width: 50px; height: 50px; background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(0,36,85,0.2);">
                                        <i class="fas fa-box text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold" style="color:#002455;">
                                            {{ $item->product->name }}
                                        </h6>
                                        <small class="text-muted">
                                            <i class="fas fa-times me-1"></i>Jumlah: {{ $item->quantity }}
                                        </small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="fw-bold fs-5" style="color:#FFC107;">
                                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                    </span>
                                    <br>
                                    <small class="text-muted">
                                        @Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                    </small>
                                </div>
                            </div>
                        @endforeach

                        {{-- Back to Cart Button --}}
                        <div class="mt-4 pt-3 border-top">
                            <a href="{{ route('customer.cart') }}" class="btn"
                                style="background-color: transparent; color:#002455; border: 2px solid #002455; border-radius: 10px; padding: 0.625rem 1.5rem; font-weight: 600; transition: all 0.3s ease;">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: SUMMARY --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-summary" style="border-radius: 16px; overflow: hidden;">
                    <div class="card-header"
                        style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border: none; padding: 1.25rem;">
                        <h5 class="mb-0 fw-bold text-white">
                            <i class="fas fa-file-invoice-dollar me-2"></i>Ringkasan Pembayaran
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        {{-- Summary Details --}}
                        <div class="summary-detail mb-3 pb-3" style="border-bottom: 2px dashed #e9ecef;">
                            <div class="d-flex justify-content-between mb-2">
                                <span style="color:#002455; font-weight: 500;">
                                    <i class="fas fa-box me-2" style="color:#FFC107; font-size: 0.9rem;"></i>
                                    Subtotal Produk
                                </span>
                                <span class="fw-bold" style="color:#002455;">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span style="color:#002455; font-weight: 500;">
                                    <i class="fas fa-shipping-fast me-2" style="color:#FFC107; font-size: 0.9rem;"></i>
                                    Biaya Pengiriman
                                </span>
                                <span class="text-success fw-semibold">
                                    GRATIS
                                </span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span style="color:#002455; font-weight: 500;">
                                    <i class="fas fa-tags me-2" style="color:#FFC107; font-size: 0.9rem;"></i>
                                    Diskon
                                </span>
                                <span class="text-muted">
                                    Rp 0
                                </span>
                            </div>
                        </div>

                        {{-- Total --}}
                        <div class="total-section p-3 mb-4"
                            style="background: linear-gradient(135deg, rgba(255,193,7,0.1) 0%, rgba(255,213,79,0.1) 100%); border-radius: 12px; border: 2px solid #FFC107;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block mb-1">Total Pembayaran</small>
                                    <span class="fw-bold" style="color:#002455; font-size: 1.1rem;">
                                        <i class="fas fa-money-check-alt me-2"></i>Grand Total
                                    </span>
                                </div>
                                <div class="text-end">
                                    <span class="fw-bold d-block" style="color:#FFC107; font-size: 1.8rem; line-height: 1;">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Place Order Form --}}
                        <form action="{{ route('customer.checkout.process') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-100 mb-3 place-order-btn" style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%);
                                           color:#fff;
                                           border: none;
                                           border-radius: 12px;
                                           padding: 1rem;
                                           font-weight: 700;
                                           font-size: 1.1rem;
                                           box-shadow: 0 4px 12px rgba(0,36,85,0.3);
                                           transition: all 0.3s ease;">
                                <i class="fas fa-check-circle me-2"></i>Konfirmasi Pesanan
                            </button>
                        </form>

                        {{-- Security Info --}}
                        <div class="alert mb-0"
                            style="background-color: #E8F4F8; border: none; border-left: 4px solid #002455; border-radius: 8px;">
                            <small style="color:#002455;">
                                <i class="fas fa-lock me-2"></i>
                                <strong>Transaksi 100% Aman</strong>
                                <br>
                                <span class="text-muted" style="font-size: 0.85rem;">
                                    Data Anda dilindungi dengan enkripsi SSL
                                </span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Order Item Card Hover */
    .order-item-card:hover {
        border-color: #002455 !important;
        background-color: #fff !important;
        box-shadow: 0 4px 12px rgba(0, 36, 85, 0.1);
        transform: translateX(5px);
    }

    /* Payment Method Hover */
    .payment-method:hover {
        border-color: #002455 !important;
        background-color: #f8f9fa !important;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 36, 85, 0.15);
    }

    /* Place Order Button Hover */
    .place-order-btn:hover {
        background: linear-gradient(135deg, #1B3C53 0%, #002455 100%) !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 36, 85, 0.4) !important;
    }

    .place-order-btn:active {
        transform: translateY(-1px);
    }

    /* Back Button Hover */
    .btn[href*="customer.cart"]:hover {
        background-color: #002455 !important;
        color: #fff !important;
        transform: translateX(-5px);
    }

    /* Sticky Summary */
    .sticky-summary {
        position: sticky;
        top: 20px;
    }

    /* Summary Detail Animation */
    .summary-detail>div {
        transition: all 0.3s ease;
    }

    .summary-detail>div:hover {
        padding-left: 10px;
    }

    /* Total Section Pulse */
    .total-section {
        animation: subtlePulse 2s ease-in-out infinite;
    }

    @keyframes subtlePulse {

        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.4);
        }

        50% {
            box-shadow: 0 0 0 8px rgba(255, 193, 7, 0);
        }
    }

    /* Step Progress Animation */
    .step-circle {
        transition: all 0.3s ease;
    }

    .step-item:hover .step-circle {
        transform: scale(1.1);
    }

    /* Trust Badges Animation */
    .trust-badges i {
        transition: all 0.3s ease;
    }

    .trust-badges i:hover {
        transform: scale(1.2) rotate(10deg);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sticky-summary {
            position: relative;
            top: 0;
        }

        .order-item-card {
            flex-direction: column;
            text-align: center;
        }

        .order-item-card .d-flex {
            flex-direction: column;
            margin-bottom: 1rem;
        }

        .item-icon {
            margin: 0 auto 1rem !important;
        }

        .checkout-steps .step-item small {
            font-size: 0.7rem;
        }
    }

    /* Loading State for Form Submit */
    .place-order-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
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
