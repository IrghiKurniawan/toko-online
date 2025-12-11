@extends('templates.customer')

@section('content-customer')

    @php
        $statusDisplay = [
            'pending' => [
                'icon' => 'fas fa-clock',
                'text' => 'Menunggu Pembayaran',
                'color' => '#FFC107',
                'bg' => 'rgba(255,193,7,0.2)',
            ],
            'processing' => [
                'icon' => 'fas fa-sync-alt',
                'text' => 'Sedang Diproses',
                'color' => '#0D6EFD',
                'bg' => 'rgba(13,110,253,0.2)',
            ],
            'completed' => [
                'icon' => 'fas fa-check-circle',
                'text' => 'Selesai',
                'color' => '#198754',
                'bg' => 'rgba(25,135,84,0.2)',
            ],
            'cancelled' => [
                'icon' => 'fas fa-times-circle',
                'text' => 'Dibatalkan',
                'color' => '#DC3545',
                'bg' => 'rgba(220,53,69,0.2)',
            ],
        ];
    @endphp

    <div class="container py-5">
        {{-- Header --}}
        <div class="mb-5">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-history me-2" style="color:#002455; font-size: 1.5rem;"></i>
                        <h2 class="h3 mb-0 fw-bold" style="color:#002455;">Riwayat Pesanan</h2>
                    </div>
                    <p class="text-muted mb-0">Lihat semua pesanan yang telah Anda buat</p>
                </div>

                @if ($orders->count() > 0)
                    <div class="stats-badge px-4 py-2"
                        style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border-radius: 12px; box-shadow: 0 4px 12px rgba(0,36,85,0.2);">
                        <small class="text-white d-block mb-1" style="opacity: 0.8;">Total Pesanan</small>
                        <h4 class="mb-0 fw-bold" style="color:#FFC107;">{{ $orders->count() }}</h4>
                    </div>
                @endif
            </div>
        </div>

        @forelse ($orders as $order)
            @php $st = $statusDisplay[$order->status]; @endphp
            <div class="order-card card border-0 shadow-sm mb-4"
                style="border-radius: 16px; overflow: hidden; transition: all 0.3s ease;">

                {{-- Order Header --}}
                <div class="card-header"
                    style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border: none; padding: 1.25rem;">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="order-icon me-3"
                                    style="width: 50px; height: 50px; background-color: rgba(255,193,7,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-receipt fa-lg" style="color:#FFC107;"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold text-white">
                                        Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                    </h5>
                                    <small class="text-white" style="opacity: 0.8;">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <div class="d-flex flex-column align-items-md-end">
                                <small class="text-white mb-1" style="opacity: 0.8;">Total Pembayaran</small>
                                <h4 class="mb-0 fw-bold" style="color:#FFC107;">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Order Body --}}
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0" style="color:#002455;">
                            <i class="fas fa-box-open me-2" style="color:#FFC107;"></i>
                            Item Pesanan
                            <span class="badge ms-2" style="background-color: rgba(0,36,85,0.1); color:#002455;">
                                {{ $order->items->count() }} Items
                            </span>
                        </h6>

                        <button class="btn btn-sm toggle-items" onclick="toggleOrderItems({{ $order->id }})"
                            style="background-color: transparent; color:#002455; border: 2px solid #002455; border-radius: 8px; padding: 0.375rem 1rem; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-chevron-down me-1"></i>
                            <span>Lihat Detail</span>
                        </button>
                    </div>

                    {{-- Order Items (Collapsible) --}}
                    <div class="order-items-list" id="order-items-{{ $order->id }}" style="display: none;">
                        <div class="items-container p-3"
                            style="background-color: #f8f9fa; border-radius: 12px; border: 2px dashed #e9ecef;">
                            @foreach ($order->items as $item)
                                <div class="order-item-row d-flex justify-content-between align-items-center mb-2 pb-2"
                                    style="border-bottom: 1px solid #e9ecef;">
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <div class="item-bullet me-3"
                                            style="width: 8px; height: 8px; background-color: #FFC107; border-radius: 50%;">
                                        </div>
                                        <div>
                                            <span class="fw-semibold" style="color:#002455;">
                                                {{ $item->product->name }}
                                            </span>
                                            <small class="text-muted d-block">
                                                <i class="fas fa-tag me-1" style="font-size: 0.75rem;"></i>
                                                @Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge px-3 py-2"
                                            style="background-color: #002455; color:#fff; border-radius: 8px; font-weight: 600;">
                                            <i class="fas fa-times me-1"
                                                style="font-size: 0.75rem;"></i>{{ $item->quantity }}
                                        </span>
                                        <div class="mt-1">
                                            <small class="fw-bold" style="color:#FFC107;">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Order Summary --}}
                        <div class="order-summary mt-3 p-3"
                            style="background: linear-gradient(135deg, rgba(255,193,7,0.1) 0%, rgba(255,213,79,0.1) 100%); border-radius: 12px; border: 2px solid #FFC107;">
                            <div class="row">
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <small class="text-muted d-block mb-1">Total Item</small>
                                    <span class="fw-bold" style="color:#002455;">
                                        {{ $order->items->sum('quantity') }} Produk
                                    </span>
                                </div>
                                {{-- order status --}}
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <small class="text-muted d-block mb-1">Status Pesanan</small>
                                    <span class="badge px-3 py-2"
                                        style="background-color: {{ $st['bg'] }}; color: {{ $st['color'] }}; border-radius: 8px; font-weight: 600;">
                                        <i class="{{ $st['icon'] }} me-1"></i>{{ $st['text'] }}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <small class="text-muted d-block mb-1">Total Pembayaran</small>
                                    <span class="fw-bold fs-5" style="color:#FFC107;">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="empty-state text-center py-5">
                <div class="card border-0 shadow-sm"
                    style="border-radius: 16px; background: linear-gradient(135deg, rgba(0,36,85,0.02) 0%, rgba(27,60,83,0.02) 100%);">
                    <div class="card-body p-5">
                        <div class="empty-icon mb-4"
                            style="width: 120px; height: 120px; margin: 0 auto; background: linear-gradient(135deg, rgba(0,36,85,0.1) 0%, rgba(27,60,83,0.1) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-shopping-bag" style="font-size: 3.5rem; color:#002455; opacity: 0.4;"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color:#002455;">Belum Ada Pesanan</h4>
                        <p class="text-muted mb-4">
                            Anda belum memiliki riwayat pesanan.<br>
                            Mari mulai berbelanja dan temukan produk favorit Anda!
                        </p>
                        <a href="{{ route('customer.product') }}" class="btn px-5 py-3"
                            style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%);
                              color:#fff;
                              border: none;
                              border-radius: 12px;
                              font-weight: 700;
                              box-shadow: 0 4px 12px rgba(0,36,85,0.3);
                              transition: all 0.3s ease;">
                            <i class="fas fa-shopping-cart me-2"></i>Mulai Belanja Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endforelse

        {{-- Pagination if needed --}}
        @if ($orders->count() > 0)
            <div class="mt-4 d-flex justify-content-center">
                {{-- Add pagination links here if using paginate() --}}
            </div>
        @endif
    </div>

    <script>
        function toggleOrderItems(orderId) {
            const itemsList = document.getElementById(`order-items-${orderId}`);
            const toggleBtn = event.currentTarget;
            const icon = toggleBtn.querySelector('i');
            const text = toggleBtn.querySelector('span');

            if (itemsList.style.display === 'none') {
                itemsList.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                text.textContent = 'Sembunyikan';
                toggleBtn.style.backgroundColor = '#002455';
                toggleBtn.style.color = '#fff';
            } else {
                itemsList.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                text.textContent = 'Lihat Detail';
                toggleBtn.style.backgroundColor = 'transparent';
                toggleBtn.style.color = '#002455';
            }
        }
    </script>

    <style>
        /* Order Card Hover */
        .order-card {
            border-left: 4px solid transparent !important;
        }

        .order-card:hover {
            border-left-color: #FFC107 !important;
            box-shadow: 0 8px 20px rgba(0, 36, 85, 0.15) !important;
            transform: translateY(-3px);
        }

        /* Toggle Button Hover */
        .toggle-items:hover {
            background-color: #002455 !important;
            color: #fff !important;
            transform: scale(1.05);
        }

        /* Action Button Hover */
        .action-btn:hover {
            background-color: #002455 !important;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 36, 85, 0.2);
        }

        /* Order Items List Animation */
        .order-items-list {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Order Item Row Hover */
        .order-item-row:last-child {
            border-bottom: none !important;
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }

        .order-item-row:hover {
            padding-left: 10px;
            transition: padding-left 0.3s ease;
        }

        /* Stats Badge Animation */
        .stats-badge {
            transition: all 0.3s ease;
        }

        .stats-badge:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 36, 85, 0.3) !important;
        }

        /* Empty State Animation */
        .empty-state .card {
            transition: all 0.3s ease;
        }

        .empty-state .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 36, 85, 0.1) !important;
        }

        .empty-icon {
            transition: all 0.5s ease;
        }

        .empty-state:hover .empty-icon {
            transform: rotate(10deg) scale(1.1);
        }

        /* Start Shopping Button Hover */
        .empty-state .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 36, 85, 0.4) !important;
            background: linear-gradient(135deg, #1B3C53 0%, #002455 100%) !important;
        }

        /* Order Icon Pulse */
        .order-icon {
            animation: iconPulse 2s ease-in-out infinite;
        }

        @keyframes iconPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.4);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(255, 193, 7, 0);
            }
        }

        /* Item Bullet Animation */
        .item-bullet {
            transition: all 0.3s ease;
        }

        .order-item-row:hover .item-bullet {
            transform: scale(1.5);
            box-shadow: 0 0 0 4px rgba(255, 193, 7, 0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-badge {
                width: 100%;
                text-align: center;
            }

            .order-card .card-header .row {
                text-align: center;
            }

            .order-actions {
                flex-direction: column;
            }

            .action-btn {
                width: 100%;
            }

            .order-item-row {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .order-summary .row>div {
                text-align: center !important;
                margin-bottom: 1rem;
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

        /* Loading State */
        .order-card.loading {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
@endsection
