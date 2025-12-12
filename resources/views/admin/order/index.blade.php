@extends('templates.admin')

@section('page-title', 'Orders Management')

@section('content-admin')
    <div class="container-fluid">
        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1" style="color:#002455;">
                    <i class="fas fa-shopping-cart me-2" style="color:#FFC107;"></i>
                    Manajemen Pesanan
                </h2>
                <p class="text-muted mb-0">Kelola dan pantau semua pesanan pelanggan</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn" 
                        style="background-color: transparent; color:#002455; border: 2px solid #002455; border-radius: 10px; padding: 0.625rem 1.5rem; font-weight: 600;">
                    <i class="fas fa-file-export me-2"></i>Export
                </button>
                <button class="btn" 
                        style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); color:#fff; border: none; border-radius: 10px; padding: 0.625rem 1.5rem; font-weight: 600; box-shadow: 0 4px 8px rgba(0,36,85,0.2);">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>
            </div>
        </div>

        {{-- Status Summary Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 4px solid #ffc107 !important;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3" 
                                 style="width: 50px; height: 50px; background: rgba(255,193,7,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clock fa-lg" style="color:#FFC107;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Pending</small>
                                <h4 class="fw-bold mb-0" style="color:#002455;">{{ $orders->where('status', 'pending')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 4px solid #17a2b8 !important;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3" 
                                 style="width: 50px; height: 50px; background: rgba(23,162,184,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-sync-alt fa-lg" style="color:#17a2b8;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Processing</small>
                                <h4 class="fw-bold mb-0" style="color:#002455;">{{ $orders->where('status', 'processing')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 4px solid #28a745 !important;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3" 
                                 style="width: 50px; height: 50px; background: rgba(40,167,69,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check-circle fa-lg" style="color:#28a745;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Completed</small>
                                <h4 class="fw-bold mb-0" style="color:#002455;">{{ $orders->where('status', 'completed')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 4px solid #dc3545 !important;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3" 
                                 style="width: 50px; height: 50px; background: rgba(220,53,69,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-times-circle fa-lg" style="color:#dc3545;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Cancelled</small>
                                <h4 class="fw-bold mb-0" style="color:#002455;">{{ $orders->where('status', 'cancelled')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Orders Table --}}
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-0" style="padding: 1.5rem; border-radius: 16px 16px 0 0;">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold" style="color:#002455;">
                        <i class="fas fa-list me-2" style="color:#FFC107;"></i>
                        Daftar Pesanan
                    </h5>
                    <div class="input-group" style="width: 300px;">
                        <span class="input-group-text bg-white border-end-0" style="border: 2px solid #e9ecef; border-right: none; border-radius: 10px 0 0 10px;">
                            <i class="fas fa-search" style="color:#002455;"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Cari order..." 
                               style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0;">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th class="border-0 px-4 py-3" style="color:#002455; font-weight: 600;">
                                    <i class="fas fa-hashtag me-2" style="color:#FFC107;"></i>Order ID
                                </th>
                                <th class="border-0 px-4 py-3" style="color:#002455; font-weight: 600;">
                                    <i class="fas fa-user me-2" style="color:#FFC107;"></i>Customer
                                </th>
                                <th class="border-0 px-4 py-3" style="color:#002455; font-weight: 600;">
                                    <i class="fas fa-money-bill-wave me-2" style="color:#FFC107;"></i>Total
                                </th>
                                <th class="border-0 px-4 py-3" style="color:#002455; font-weight: 600;">
                                    <i class="fas fa-info-circle me-2" style="color:#FFC107;"></i>Status
                                </th>
                                <th class="border-0 px-4 py-3" style="color:#002455; font-weight: 600;">
                                    <i class="fas fa-cogs me-2" style="color:#FFC107;"></i>Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="order-row" style="transition: all 0.3s ease;">
                                    <td class="px-4 py-3">
                                        <span class="fw-bold" style="color:#002455;">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="customer-avatar me-2" 
                                                 style="width: 40px; height: 40px; background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color:#002455; font-weight: 700; font-size: 0.875rem;">
                                                {{ strtoupper(substr($order->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold" style="color:#002455;">{{ $order->name ?? 'Unknown' }}</div>
                                                <small class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="fw-bold" style="color:#FFC107; font-size: 1.05rem;">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="status-form">
                                            @csrf
                                            @method('PUT')

                                            <div class="d-flex align-items-center gap-2">
                                                <select name="status" 
                                                        class="form-select form-select-sm status-select" 
                                                        style="border: 2px solid #e9ecef; border-radius: 8px; font-weight: 600; padding: 0.5rem; max-width: 150px;"
                                                        {{ in_array($order->status, ['completed', 'cancelled']) ? 'disabled' : '' }}
                                                        onchange="updateStatusStyle(this)">
                                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                        ⏳ Pending
                                                    </option>
                                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                        🔄 Processing
                                                    </option>
                                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                        ✅ Completed
                                                    </option>
                                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                        ❌ Cancelled
                                                    </option>
                                                </select>

                                                @if (!in_array($order->status, ['completed', 'cancelled']))
                                                    <button type="submit" 
                                                            class="btn btn-sm save-btn" 
                                                            style="background-color: #002455; color:#fff; border: none; border-radius: 8px; padding: 0.5rem 1rem; font-weight: 600; transition: all 0.3s ease;">
                                                        <i class="fas fa-save me-1"></i>Save
                                                    </button>
                                                @else
                                                    <span class="badge px-3 py-2" 
                                                          style="background-color: {{ $order->status == 'completed' ? '#28a745' : '#dc3545' }}; border-radius: 8px;">
                                                        <i class="fas fa-lock me-1"></i>Locked
                                                    </span>
                                                @endif
                                            </div>
                                        </form>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm action-btn" 
                                                    style="background-color: transparent; color:#002455; border: 2px solid #002455; border-radius: 8px; padding: 0.375rem 0.75rem; font-weight: 600; transition: all 0.3s ease;"
                                                    title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm action-btn" 
                                                    style="background-color: transparent; color:#dc3545; border: 2px solid #dc3545; border-radius: 8px; padding: 0.375rem 0.75rem; font-weight: 600; transition: all 0.3s ease;"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox fa-3x mb-3" style="color:#002455; opacity: 0.3;"></i>
                                            <h5 class="fw-bold mb-2" style="color:#002455;">Belum Ada Pesanan</h5>
                                            <p class="text-muted">Pesanan akan muncul di sini setelah pelanggan melakukan pembelian</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($orders->hasPages())
                <div class="card-footer bg-white border-0" style="padding: 1.5rem; border-radius: 0 0 16px 16px;">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Order Row Hover */
        .order-row:hover {
            background-color: rgba(0,36,85,0.02);
            transform: translateX(5px);
        }

        /* Status Select Styling */
        .status-select {
            transition: all 0.3s ease;
        }

        .status-select:focus {
            border-color: #002455 !important;
            box-shadow: 0 0 0 0.25rem rgba(0, 36, 85, 0.15) !important;
        }

        .status-select option[value="pending"] {
            color: #ffc107;
        }

        .status-select option[value="processing"] {
            color: #17a2b8;
        }

        .status-select option[value="completed"] {
            color: #28a745;
        }

        .status-select option[value="cancelled"] {
            color: #dc3545;
        }

        /* Save Button Hover */
        .save-btn:hover {
            background-color: #1B3C53 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,36,85,0.3);
        }

        /* Action Button Hover */
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .action-btn:first-child:hover {
            background-color: #002455 !important;
            color: #fff !important;
        }

        .action-btn:last-child:hover {
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        /* Customer Avatar Animation */
        .customer-avatar {
            transition: all 0.3s ease;
        }

        .order-row:hover .customer-avatar {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(255,193,7,0.3);
        }

        /* Pagination Styling */
        .pagination .page-link {
            color: #002455;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #002455 0%, #1B3C53 100%);
            border-color: #002455;
            box-shadow: 0 4px 8px rgba(0,36,85,0.3);
        }

        .pagination .page-link:hover {
            background-color: #002455;
            color: #fff;
            border-color: #002455;
            transform: translateY(-2px);
        }

        /* Search Input Focus */
        .input-group input:focus {
            border-color: #002455 !important;
            box-shadow: 0 0 0 0.25rem rgba(0, 36, 85, 0.15) !important;
        }

        /* Icon Wrapper Hover */
        .icon-wrapper {
            transition: all 0.3s ease;
        }

        .card:hover .icon-wrapper {
            transform: scale(1.1);
        }
    </style>

    <script>
        // Update status select styling based on value
        function updateStatusStyle(select) {
            const value = select.value;
            select.style.borderColor = getStatusColor(value);
            select.style.color = getStatusColor(value);
        }

        function getStatusColor(status) {
            const colors = {
                'pending': '#ffc107',
                'processing': '#17a2b8',
                'completed': '#28a745',
                'cancelled': '#dc3545'
            };
            return colors[status] || '#002455';
        }

        // Initialize status styling on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.status-select').forEach(select => {
                updateStatusStyle(select);
            });
        });
    </script>
@endsection