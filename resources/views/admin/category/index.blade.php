@extends('templates.admin')

@section('page-title', 'Categories Management')

@section('content-admin')
    <div class="container-fluid">
        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1" style="color:#002455;">
                    <i class="fas fa-layer-group me-2" style="color:#FFC107;"></i>
                    Manajemen Kategori
                </h2>
                <p class="text-muted mb-0">Kelola kategori produk di toko Anda</p>
            </div>
            <a href="{{ route('admin.category.create') }}" class="btn btn-add"
                style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%);
                      color:#fff;
                      border: none;
                      border-radius: 10px;
                      padding: 0.75rem 1.5rem;
                      font-weight: 600;
                      box-shadow: 0 4px 8px rgba(0,36,85,0.2);
                      transition: all 0.3s ease;">
                <i class="fas fa-plus-circle me-2"></i>Tambah Kategori
            </a>
        </div>

        {{-- Statistics Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100"
                    style="border-radius: 12px; border-left: 4px solid #002455 !important;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3"
                                style="width: 50px; height: 50px; background: rgba(0,36,85,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-layer-group fa-lg" style="color:#002455;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Total Kategori</small>
                                <h4 class="fw-bold mb-0" style="color:#002455;">{{ $categories->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categories Table --}}
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-0" style="padding: 1.5rem; border-radius: 16px 16px 0 0;">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <h5 class="mb-0 fw-bold" style="color:#002455;">
                        <i class="fas fa-list me-2" style="color:#FFC107;"></i>
                        Daftar Kategori
                    </h5>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="input-group" style="width: 250px;">
                            <span class="input-group-text bg-white border-end-0"
                                style="border: 2px solid #e9ecef; border-right: none; border-radius: 10px 0 0 10px;">
                                <i class="fas fa-search" style="color:#002455;"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="searchInput"
                                placeholder="Cari kategori..."
                                style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @if ($categories->isEmpty())
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-layer-group fa-4x mb-3" style="color:#002455; opacity: 0.2;"></i>
                        <h5 class="fw-bold mb-2" style="color:#002455;">Belum Ada Kategori</h5>
                        <p class="text-muted mb-4">Mulai dengan menambahkan kategori pertama Anda</p>
                        <a href="{{ route('admin.category.create') }}" class="btn"
                            style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); color:#fff; border: none; border-radius: 10px; padding: 0.75rem 2rem; font-weight: 600;">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Kategori
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th class="border-0 px-4 py-3" style="color:#002455; font-weight: 600; width: 80px;">
                                        <i class="fas fa-hashtag me-2" style="color:#FFC107;"></i>No
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color:#002455; font-weight: 600;">
                                        <i class="fas fa-tag me-2" style="color:#FFC107;"></i>Nama Kategori
                                    </th>
                                    <th class="border-0 px-4 py-3 text-end"
                                        style="color:#002455; font-weight: 600; width: 200px;">
                                        <i class="fas fa-cogs me-2" style="color:#FFC107;"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="categoryTableBody">
                                @foreach ($categories as $index => $item)
                                    <tr class="category-row" style="transition: all 0.3s ease;">
                                        <td class="px-4 py-3">
                                            <div class="number-badge"
                                                style="width: 35px; height: 35px; background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; color:#FFC107; font-weight: 700;">
                                                {{ $index + 1 }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="category-icon me-3"
                                                    style="width: 45px; height: 45px; background: linear-gradient(135deg, rgba(255,193,7,0.1) 0%, rgba(255,213,79,0.1) 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-folder" style="color:#FFC107; font-size: 1.25rem;"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold category-name"
                                                        style="color:#002455; font-size: 1.05rem;">
                                                        {{ $item->name }}
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        Dibuat: {{ $item->created_at->format('d M Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.category.edit', $item->id) }}"
                                                    class="btn btn-sm action-btn edit-btn"
                                                    style="background-color: transparent; color:#002455; border: 2px solid #002455; border-radius: 8px 0 0 8px; padding: 0.5rem 1rem; font-weight: 600; transition: all 0.3s ease;">
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </a>

                                                <button type="button" class="btn btn-sm action-btn delete-btn"
                                                    onclick="confirmDelete({{ $item->id }})"
                                                    style="background-color: transparent; color:#dc3545; border: 2px solid #dc3545; border-left: none; border-radius: 0 8px 8px 0; padding: 0.5rem 1rem; font-weight: 600; transition: all 0.3s ease;">
                                                    <i class="fas fa-trash-alt me-1"></i>Delete
                                                </button>
                                            </div>

                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('admin.category.destroy', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: none;">
                <div class="modal-header border-0"
                    style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 16px 16px 0 0;">
                    <h5 class="modal-title fw-bold text-white">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <i class="fas fa-trash-alt fa-3x mb-3" style="color:#dc3545; opacity: 0.5;"></i>
                    <h5 class="fw-bold mb-2" style="color:#002455;">Apakah Anda yakin?</h5>
                    <p class="text-muted mb-0">
                        Kategori yang dihapus tidak dapat dikembalikan.<br>
                        Semua produk dalam kategori ini akan terpengaruh.
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
        /* Add Button Hover */
        .btn-add:hover {
            background: linear-gradient(135deg, #1B3C53 0%, #002455 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 36, 85, 0.3) !important;
        }

        /* Category Row Hover */
        .category-row:hover {
            background-color: rgba(0, 36, 85, 0.02);
            transform: translateX(5px);
        }

        .category-row:hover .category-icon {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.2);
        }

        /* Number Badge Animation */
        .number-badge {
            transition: all 0.3s ease;
        }

        .category-row:hover .number-badge {
            transform: scale(1.1) rotate(5deg);
        }

        /* Action Button Hover */
        .edit-btn:hover {
            background-color: #002455 !important;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 36, 85, 0.3);
        }

        .delete-btn:hover {
            background-color: #dc3545 !important;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
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

        /* Modal Animation */
        .modal.fade .modal-dialog {
            transform: scale(0.8);
            transition: transform 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            transform: scale(1);
        }
    </style>

    <script>
        let deleteFormId = null;

        function confirmDelete(categoryId) {
            deleteFormId = categoryId;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteFormId) {
                document.getElementById('delete-form-' + deleteFormId).submit();
            }
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#categoryTableBody tr');

            rows.forEach(row => {
                const categoryName = row.querySelector('.category-name').textContent.toLowerCase();
                if (categoryName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
