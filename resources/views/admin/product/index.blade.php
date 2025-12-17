@extends('templates.admin')

@section('page-title', 'Products Management')

@section('content-admin')
    <div class="container-fluid">
        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h2 class="fw-bold mb-1" style="color:#002455;">
                    <i class="fas fa-box me-2" style="color:#FFC107;"></i>
                    Manajemen Produk
                </h2>
                <p class="text-muted mb-0">Kelola semua produk di toko Anda</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.product.create') }}" class="btn"
                    style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); color:#fff; border: none; border-radius: 10px; padding: 0.625rem 1.5rem; font-weight: 600; box-shadow: 0 4px 8px rgba(0,36,85,0.2);">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Produk
                </a>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100"
                    style="border-radius: 12px; border-left: 4px solid #28a745 !important;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3"
                                style="width: 50px; height: 50px; background: rgba(40,167,69,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check-circle fa-lg" style="color:#28a745;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Stok Tersedia</small>
                                <h4 class="fw-bold mb-0" style="color:#002455;">{{ $products->sum('stock') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100"
                    style="border-radius: 12px; border-left: 4px solid #FFC107 !important;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3"
                                style="width: 50px; height: 50px; background: rgba(255,193,7,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-layer-group fa-lg" style="color:#FFC107;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Kategori</small>
                                <h4 class="fw-bold mb-0" style="color:#002455;">
                                    {{ $products->pluck('category_id')->unique()->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100"
                    style="border-radius: 12px; border-left: 4px solid #dc3545 !important;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3"
                                style="width: 50px; height: 50px; background: rgba(220,53,69,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-exclamation-triangle fa-lg" style="color:#dc3545;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Stok Habis</small>
                                <h4 class="fw-bold mb-0" style="color:#002455;">{{ $products->where('stock', 0)->count() }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search & View Toggle --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-body p-3">
                <div class="row align-items-center g-3">
                    <div class="col-lg-6">
                        <form method="GET" class="d-flex">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"
                                    style="border: 2px solid #e9ecef; border-right: none; border-radius: 10px 0 0 10px;">
                                    <i class="fas fa-search" style="color:#002455;"></i>
                                </span>
                                <input type="search" name="search" value="{{ request('search') }}"
                                    class="form-control border-start-0 border-end-0"
                                    placeholder="Cari nama produk, kategori, harga..."
                                    style="border: 2px solid #e9ecef; border-left: none; border-right: none;">
                                <button class="btn" type="submit"
                                    style="background-color:#002455; color:#fff; border: 2px solid #002455; border-left: none; border-radius: 0 10px 10px 0;">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if ($products->isEmpty())
            <div class="empty-state text-center py-5">
                <div class="card border-0 shadow-sm"
                    style="border-radius: 16px; background: linear-gradient(135deg, rgba(0,36,85,0.02) 0%, rgba(27,60,83,0.02) 100%);">
                    <div class="card-body p-5">
                        <div class="mb-4">
                            <i class="fas fa-box-open" style="font-size: 5rem; color:#002455; opacity: 0.2;"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color:#002455;">
                            {{ request('search') ? 'Produk Tidak Ditemukan' : 'Belum Ada Produk' }}
                        </h4>
                        <p class="text-muted mb-4">
                            {{ request('search') ? 'Coba gunakan kata kunci pencarian yang berbeda' : 'Mulai dengan menambahkan produk pertama Anda' }}
                        </p>
                        @if (!request('search'))
                            <a href="{{ route('admin.product.create') }}" class="btn"
                                style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); color:#fff; border: none; border-radius: 10px; padding: 0.75rem 2rem; font-weight: 600;">
                                <i class="fas fa-plus-circle me-2"></i>Tambah Produk Pertama
                            </a>
                        @else
                            <a href="{{ route('admin.product') }}" class="btn"
                                style="background-color: transparent; color:#002455; border: 2px solid #002455; border-radius: 10px; padding: 0.75rem 2rem; font-weight: 600;">
                                <i class="fas fa-arrow-left me-2"></i>Lihat Semua Produk
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="row g-4" id="productsGrid">
                @foreach ($products as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card product-card h-100 border-0 shadow-sm"
                            style="border-radius: 16px; overflow: hidden; transition: all 0.3s ease;">
                            {{-- Product Image --}}
                            <div class="product-image-wrapper position-relative"
                                style="height: 220px; overflow: hidden; background: linear-gradient(135deg, #002455 0%, #1B3C53 100%);">
                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="w-100 h-100" style="object-fit: cover;">
                                {{-- Stock Badge --}}
                                @if ($item->stock > 0)
                                    <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2"
                                        style="background-color: #28a745; color:#fff; font-weight: 600; border-radius: 8px;">
                                        <i class="fas fa-box me-1"></i>Stok: {{ $item->stock }}
                                    </span>
                                @else
                                    <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2"
                                        style="background-color: #dc3545; color:#fff; font-weight: 600; border-radius: 8px;">
                                        <i class="fas fa-times-circle me-1"></i>Habis
                                    </span>
                                @endif

                                {{-- Quick View Overlay --}}
                                <div class="quick-view-overlay position-absolute bottom-0 start-0 end-0 p-3"
                                    style="background: linear-gradient(to top, rgba(0,36,85,0.95), transparent); opacity: 0; transition: opacity 0.3s ease;">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button class="btn btn-sm"
                                            style="background-color:#fff; color:#002455; border: none; border-radius: 8px; padding: 0.5rem 1rem; font-weight: 600;">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Product Info --}}
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-2"
                                    style="color:#002455;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    min-height: 3em;
                                    line-height: 1.5;">
                                    {{ $item->name }}
                                </h6>

                                <div class="mb-3">
                                    <p class="fw-bold mb-0" style="color:#FFC107; font-size: 1.25rem;">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                    <small class="text-muted">Harga per unit</small>
                                </div>

                                {{-- Category Badge --}}
                                @if ($item->category)
                                    <span class="badge mb-2"
                                        style="background-color: rgba(0,36,85,0.1); color:#002455; border-radius: 8px; padding: 0.5rem 0.75rem; font-weight: 600;">
                                        <i class="fas fa-tag me-1"></i>{{ $item->category->name }}
                                    </span>
                                @endif
                            </div>

                            {{-- Card Footer Actions --}}
                            <div class="card-footer bg-white border-0 p-3 pt-0">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.product.edit', $item->id) }}" class="btn btn-sm edit-btn"
                                        style="background-color: transparent; color:#002455; border: 2px solid #002455; border-radius: 10px; padding: 0.625rem; font-weight: 600; transition: all 0.3s ease;">
                                        <i class="fas fa-edit me-1"></i>Edit Produk
                                    </a>
                                    <button type="button" onclick="confirmDelete({{ $item->id }})"
                                        class="btn btn-sm delete-btn"
                                        style="background-color: transparent; color:#dc3545; border: 2px solid #dc3545; border-radius: 10px; padding: 0.625rem; font-weight: 600; transition: all 0.3s ease;">
                                        <i class="fas fa-trash-alt me-1"></i>Hapus
                                    </button>
                                </div>

                                <form id="delete-form-{{ $item->id }}"
                                    action="{{ route('admin.product.destroy', $item->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: none;">
                <div class="modal-header border-0"
                    style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 16px 16px 0 0;">
                    <h5 class="modal-title fw-bold text-white">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Konfirmasi Hapus Produk
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <i class="fas fa-box fa-3x mb-3" style="color:#dc3545; opacity: 0.5;"></i>
                    <h5 class="fw-bold mb-2" style="color:#002455;">Apakah Anda yakin?</h5>
                    <p class="text-muted mb-0">
                        Produk yang dihapus tidak dapat dikembalikan.<br>
                        Tindakan ini bersifat permanen.
                    </p>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: transparent; color:#002455; border: 2px solid #002455; border-radius: 10px; padding: 0.625rem 1.5rem; font-weight: 600;">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="button" id="confirmDeleteBtn" class="btn"
                        style="background-color: #dc3545; color:#fff; border: none; border-radius: 10px; padding: 0.625rem 1.5rem; font-weight: 600; box-shadow: 0 4px 8px rgba(220,53,69,0.3);">
                        <i class="fas fa-trash-alt me-2"></i>Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Product Card Hover */
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 36, 85, 0.15) !important;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-card:hover .quick-view-overlay {
            opacity: 1;
        }

        /* Edit Button Hover */
        .edit-btn:hover {
            background-color: #002455 !important;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 36, 85, 0.3);
        }

        /* Delete Button Hover */
        .delete-btn:hover {
            background-color: #dc3545 !important;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* View Toggle */
        .view-toggle {
            transition: all 0.3s ease;
        }

        .view-toggle.active {
            background-color: #002455 !important;
            color: #fff !important;
            border: 2px solid #002455 !important;
        }

        .view-toggle:not(.active):hover {
            background-color: #002455 !important;
            color: #fff !important;
        }

        /* Icon Wrapper Hover */
        .icon-wrapper {
            transition: all 0.3s ease;
        }

        .card:hover .icon-wrapper {
            transform: scale(1.1);
        }

        /* Search Input Focus */
        .input-group input:focus {
            border-color: #002455 !important;
            box-shadow: 0 0 0 0.25rem rgba(0, 36, 85, 0.15) !important;
        }

        /* Pagination */
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
            box-shadow: 0 4px 8px rgba(0, 36, 85, 0.3);
        }

        .pagination .page-link:hover {
            background-color: #002455;
            color: #fff;
            border-color: #002455;
            transform: translateY(-2px);
        }
    </style>

    <script>
        let deleteFormId = null;

        function confirmDelete(productId) {
            deleteFormId = productId;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteFormId) {
                document.getElementById('delete-form-' + deleteFormId).submit();
            }
        });

        // View Toggle
        document.querySelectorAll('.view-toggle').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.view-toggle').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const view = this.dataset.view;
                // Implement view change logic here
                console.log('Switched to ' + view + ' view');
            });
        });
    </script>
@endsection
