@extends('templates.admin')

@section('page-title', 'Edit Category')

@section('content-admin')
    <div class="container-fluid">
        {{-- Breadcrumb
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" style="color:#002455; text-decoration: none;">
                        <i class="fas fa-home me-1"></i>Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.category') }}" style="color:#002455; text-decoration: none;">
                        <i class="fas fa-layer-group me-1"></i>Categories
                    </a>
                </li>
                <li class="breadcrumb-item active" style="color:#FFC107;">Edit Category</li>
            </ol>
        </nav> --}}

        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                {{-- Form Card --}}
                <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                    {{-- Card Header --}}
                    <div class="card-header text-white position-relative" 
                         style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); border: none; padding: 2rem;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="icon-box me-3" 
                                     style="width: 60px; height: 60px; background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(255,193,7,0.3);">
                                    <i class="fas fa-edit fa-2x" style="color:#002455;"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold">Edit Kategori</h4>
                                    <p class="mb-0" style="opacity: 0.9; font-size: 0.95rem;">
                                        Perbarui informasi kategori
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('admin.category') }}" 
                               class="btn btn-sm"
                               style="background-color: rgba(255,255,255,0.2); color:#fff; border: 2px solid rgba(255,255,255,0.3); border-radius: 8px; padding: 0.5rem 1rem; font-weight: 600; transition: all 0.3s ease;">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                        </div>

                        {{-- Decorative Wave --}}
                        <div class="wave-bottom">
                            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" 
                                      style="stroke: none; fill: #fff;"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-4" style="padding-top: 2.5rem !important;">
                        {{-- Current Category Info --}}
                        <div class="alert border-0 mb-4" 
                             style="background: linear-gradient(135deg, rgba(0,36,85,0.05) 0%, rgba(27,60,83,0.05) 100%); border-left: 4px solid #002455 !important; border-radius: 10px;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-lg me-3" style="color:#FFC107;"></i>
                                <div>
                                    <strong style="color:#002455;">Kategori Saat Ini:</strong>
                                    <span class="ms-2" style="color:#002455;">{{ $category->name }}</span>
                                </div>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4" 
                                 style="border-radius: 12px; background-color: #d4edda; border-left: 4px solid #28a745 !important;">
                                <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center mb-4" 
                                 style="border-radius: 12px; background-color: #f8d7da; border-left: 4px solid #dc3545 !important;">
                                <i class="fas fa-exclamation-circle me-2" style="color: #dc3545;"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" id="editCategoryForm">
                            @csrf
                            @method('PUT')
                            
                            {{-- Category Name Input --}}
                            <div class="form-group mb-4">
                                <label for="name" class="form-label fw-semibold mb-2" style="color:#002455;">
                                    <i class="fas fa-tag me-2" style="color:#FFC107;"></i>
                                    Nama Kategori
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0" 
                                          style="background-color: #f8f9fa; border: 2px solid #e9ecef; border-right: none; border-radius: 10px 0 0 10px;">
                                        <i class="fas fa-folder" style="color:#002455;"></i>
                                    </span>
                                    <input type="text"
                                           class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                           id="name"
                                           name="name" 
                                           value="{{ old('name', $category->name) }}"
                                           placeholder="Masukkan nama kategori"
                                           style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0; padding: 0.75rem;"
                                           required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block mt-2" style="display: flex; align-items: center;">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted mt-2 d-block">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Gunakan nama yang jelas dan mudah dipahami
                                </small>
                            </div>

                            {{-- Character Counter --}}
                            <div class="mb-4 p-3" 
                                 style="background-color: #f8f9fa; border-radius: 10px; border: 2px dashed #e9ecef;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small style="color:#002455; font-weight: 600;">
                                        <i class="fas fa-keyboard me-2" style="color:#FFC107;"></i>
                                        Jumlah Karakter
                                    </small>
                                    <span id="charCount" class="badge px-3 py-2" 
                                          style="background-color: #002455; color:#FFC107; border-radius: 8px; font-weight: 700;">
                                        {{ strlen($category->name) }} / 50
                                    </span>
                                </div>
                                <div class="progress mt-2" style="height: 6px; background-color: #e9ecef; border-radius: 3px;">
                                    <div class="progress-bar" 
                                         id="charProgress"
                                         role="progressbar" 
                                         style="width: {{ (strlen($category->name) / 50) * 100 }}%; background: linear-gradient(90deg, #002455 0%, #1B3C53 100%); border-radius: 3px;"></div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" 
                                        class="btn btn-save"
                                        style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); 
                                               color:#fff; 
                                               border: none; 
                                               border-radius: 12px; 
                                               padding: 0.875rem; 
                                               font-weight: 700; 
                                               font-size: 1.05rem;
                                               box-shadow: 0 4px 12px rgba(0,36,85,0.3);
                                               transition: all 0.3s ease;">
                                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.category') }}" 
                                   class="btn btn-cancel"
                                   style="background-color: transparent; 
                                          color:#002455; 
                                          border: 2px solid #002455; 
                                          border-radius: 12px; 
                                          padding: 0.875rem; 
                                          font-weight: 700;
                                          text-decoration: none;
                                          transition: all 0.3s ease;">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>

                            {{-- Delete Section --}}
                            <div class="text-center mt-4 pt-3" style="border-top: 2px dashed #e9ecef;">
                                <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                    Ingin menghapus kategori ini?
                                </p>
                                <button type="button" 
                                        class="btn btn-sm"
                                        onclick="confirmDelete()"
                                        style="background-color: transparent; color:#dc3545; border: 2px solid #dc3545; border-radius: 8px; padding: 0.5rem 1.5rem; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-trash-alt me-2"></i>Hapus Kategori
                                </button>
                            </div>
                        </form>

                        {{-- Hidden Delete Form --}}
                        <form id="delete-form" 
                              action="{{ route('admin.category.destroy', $category->id) }}" 
                              method="POST" 
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Wave Animation */
        .wave-bottom {
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 60px;
            overflow: hidden;
            line-height: 0;
        }

        /* Input Focus States */
        .form-control:focus,
        .input-group-text:has(+ .form-control:focus) {
            border-color: #002455 !important;
            box-shadow: 0 0 0 0.25rem rgba(0, 36, 85, 0.15) !important;
        }

        /* Save Button Hover */
        .btn-save:hover {
            background: linear-gradient(135deg, #1B3C53 0%, #002455 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,36,85,0.4) !important;
        }

        /* Cancel Button Hover */
        .btn-cancel:hover {
            background-color: #002455 !important;
            color: #fff !important;
            transform: translateY(-2px);
        }

        /* Delete Button Hover */
        button[onclick="confirmDelete()"]:hover {
            background-color: #dc3545 !important;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220,53,69,0.3);
        }

        /* Back Button Hover */
        .card-header .btn-sm:hover {
            background-color: rgba(255,255,255,0.3) !important;
            border-color: rgba(255,255,255,0.5) !important;
        }

        /* Icon Box Animation */
        .icon-box {
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 4px 12px rgba(255,193,7,0.3);
            }
            50% {
                box-shadow: 0 4px 20px rgba(255,193,7,0.5);
            }
        }

        /* Breadcrumb Links */
        .breadcrumb-item a:hover {
            color: #FFC107 !important;
        }

        /* Alert Animation */
        .alert {
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

        /* Card Animation */
        .card {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        // Character Counter
        const nameInput = document.getElementById('name');
        const charCount = document.getElementById('charCount');
        const charProgress = document.getElementById('charProgress');
        const maxChars = 50;

        nameInput.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length} / ${maxChars}`;
            
            const percentage = (length / maxChars) * 100;
            charProgress.style.width = `${percentage}%`;
            
            // Change color based on length
            if (percentage > 90) {
                charProgress.style.background = 'linear-gradient(90deg, #dc3545 0%, #c82333 100%)';
                charCount.style.backgroundColor = '#dc3545';
            } else if (percentage > 70) {
                charProgress.style.background = 'linear-gradient(90deg, #ffc107 0%, #ffb300 100%)';
                charCount.style.backgroundColor = '#ffc107';
                charCount.style.color = '#002455';
            } else {
                charProgress.style.background = 'linear-gradient(90deg, #002455 0%, #1B3C53 100%)';
                charCount.style.backgroundColor = '#002455';
                charCount.style.color = '#FFC107';
            }
        });

        // Confirm Delete
        function confirmDelete() {
            if (confirm('⚠️ Apakah Anda yakin ingin menghapus kategori ini?\n\nPeringatan: Semua produk dalam kategori ini akan terpengaruh!')) {
                document.getElementById('delete-form').submit();
            }
        }

        // Form Validation
        document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
            const nameValue = nameInput.value.trim();
            
            if (nameValue.length === 0) {
                e.preventDefault();
                alert('Nama kategori tidak boleh kosong!');
                nameInput.focus();
                return false;
            }
            
            if (nameValue.length > maxChars) {
                e.preventDefault();
                alert(`Nama kategori terlalu panjang! Maksimal ${maxChars} karakter.`);
                nameInput.focus();
                return false;
            }
        });
    </script>
@endsection