@extends('templates.admin')
@section('content-admin')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0">
                    {{-- Header dengan warna biru tua --}}
                    <div class="card-header text-white py-3" style="background-color: #1a237e;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1 fw-bold">
                                    <i class="fas fa-file-invoice me-2"></i>Detail Order
                                </h4>
                                <p class="mb-0 opacity-75 small">Order #{{ $order->id }}</p>
                            </div>
                            <a href="{{ route('admin.orders') }}" class="btn btn-light btn-sm shadow-sm">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        {{-- Informasi Order & Customer digabung --}}
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="p-3 bg-light rounded-3 h-100 border-start border-4" style="border-left-color: #1a237e !important;">
                                    <h6 class="mb-3 fw-bold" style="color: #1a237e;">
                                        <i class="fas fa-info-circle me-2"></i>Informasi Order & Customer
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column gap-3">
                                                <div>
                                                    <small class="text-muted d-block">Order ID</small>
                                                    <span class="fw-bold fs-5">#{{ $order->id }}</span>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Tanggal Order</small>
                                                    <span
                                                        class="fw-semibold">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Status</small>
                                                    <span
                                                        class="badge px-3 py-2"
                                                        style="background-color: {{ $order->status == 'completed' ? '#2e7d32' : ($order->status == 'pending' ? '#f57c00' : '#0288d1') }}; color: white;">
                                                        <i class="fas fa-circle me-1 small"></i>{{ ucfirst($order->status) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column gap-3">
                                                <div>
                                                    <small class="text-muted d-block">Customer</small>
                                                    <span class="fw-semibold">
                                                        @if ($order->user && $order->user->name)
                                                            {{ $order->user->name }}
                                                        @else
                                                            <span class="text-muted fst-italic">Tidak ada data
                                                                customer</span>
                                                        @endif
                                                    </span>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Total Order</small>
                                                    <span class="fw-bold fs-5" style="color: #1a237e;">
                                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                                @if ($order->user && $order->user->email)
                                                    <div>
                                                        <small class="text-muted d-block">Email</small>
                                                        <span class="fw-semibold">
                                                            <i class="fas fa-envelope me-1"></i>{{ $order->user->email }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Quick Stats dengan biru tua --}}
                            <div class="col-md-4">
                                <div class="p-3 text-white rounded-3 h-100" style="background-color: #283593;">
                                    <h6 class="mb-3 fw-bold">
                                        <i class="fas fa-chart-bar me-2"></i>Ringkasan
                                    </h6>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex justify-content-between">
                                            <span>Jumlah Produk</span>
                                            <span class="fw-bold">{{ $order->items->count() }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Total Item</span>
                                            <span class="fw-bold">{{ $order->items->sum('quantity') }}</span>
                                        </div>
                                        <hr class="my-2 opacity-25">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>Total Bayar</span>
                                            <span class="fw-bold fs-5">Rp
                                                {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Detail Produk --}}
                        <div class="mb-3">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="fas fa-boxes me-2" style="color: #1a237e;"></i>Detail Produk
                            </h5>
                        </div>

                        <div class="table-responsive border rounded-3">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr style="background-color: #1a237e; color: white;">
                                        <th class="text-center" width="5%">No</th>
                                        <th>Produk</th>
                                        <th class="text-center" width="15%">Jumlah</th>
                                        <th class="text-end" width="15%">Harga Satuan</th>
                                        <th class="text-end" width="15%">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($order->items as $index => $item)
                                        <tr>
                                            <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($item->product && $item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                                            alt="{{ $item->product->name }}" class="rounded shadow-sm me-3"
                                                            style="width: 60px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <div class="rounded bg-light d-flex align-items-center justify-content-center me-3"
                                                            style="width: 60px; height: 60px;">
                                                            <i class="fas fa-box text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="fw-bold text-dark mb-1">
                                                            {{ $item->product ? $item->product->name : $item->name }}
                                                        </div>
                                                        @if ($item->product && $item->product->sku)
                                                            <small class="text-muted">
                                                                <i
                                                                    class="fas fa-barcode me-1"></i>{{ $item->product->sku }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge px-3 py-2" style="background-color: #1a237e; color: white;">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-end fw-semibold">Rp
                                                {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="text-end fw-bold" style="color: #1a237e;">
                                                Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-5">
                                                <i class="fas fa-box-open fa-3x mb-3 opacity-50"></i>
                                                <p class="mb-0">Tidak ada produk dalam order ini</p>
                                            </td>
                                        </tr>
                                    @endforelse

                                    {{-- Total Row --}}
                                    @if ($order->items->count() > 0)
                                        <tr style="background-color: #f5f5f5;">
                                            <td colspan="3"></td>
                                            <td class="text-end fw-bold">Total:</td>
                                            <td class="text-end fw-bold fs-5" style="color: #1a237e;">
                                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Catatan --}}
                        @if ($order->notes)
                            <div class="mt-4">
                                <h6 class="fw-bold text-dark mb-2">
                                    <i class="fas fa-sticky-note me-2" style="color: #1a237e;"></i>Catatan Order
                                </h6>
                                <div class="alert border-0 shadow-sm" style="background-color: #e8eaf6; border-left: 4px solid #1a237e !important;">
                                    <i class="fas fa-info-circle me-2" style="color: #1a237e;"></i>{{ $order->notes }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-header {
            background-color: #1a237e !important;
        }

        .table thead tr {
            background-color: #1a237e;
            color: white;
            border: none;
        }

        .border-start {
            border-left-color: #1a237e !important;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(26, 35, 126, 0.05);
        }

        .text-primary-custom {
            color: #1a237e !important;
        }

        .bg-primary-custom {
            background-color: #1a237e !important;
        }

        @media print {

            .card-header .btn,
            .card-footer,
            .btn-print {
                display: none !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            .table thead {
                background-color: #f8f9fa !important;
                color: #000 !important;
            }
        }
    </style>
@endsection
