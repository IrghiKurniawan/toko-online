@extends('templates.admin')

@section('page-title', 'Edit Product')

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
                    <a href="{{ route('admin.product') }}" style="color:#002455; text-decoration: none;">
                        <i class="fas fa-box me-1"></i>Products
                    </a>
                </li>
                <li class="breadcrumb-item active" style="color:#FFC107;">Edit Product</li>
            </ol>
        </nav> --}}

        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
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
                                    <h4 class="mb-1 fw-bold">Edit Produk</h4>
                                    <p class="mb-0" style="opacity: 0.9; font-size: 0.95rem;">
                                        Perbarui informasi produk Anda
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('admin.product') }}" 
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
                        {{-- Current Product Info --}}
                        <div class="alert border-0 mb-4" 
                             style="background: linear-gradient(135deg, rgba(0,36,85,0.05) 0%, rgba(27,60,83,0.05) 100%); border-left: 4px solid #002455 !important; border-radius: 10px;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-lg me-3" style="color:#FFC107;"></i>
                                <div>
                                    <strong style="color:#002455;">Produk yang sedang diedit:</strong>
                                    <span class="ms-2" style="color:#002455;">{{ $products->name }}</span>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('admin.product.update', $products->id) }}" method="POST" enctype="multipart/form-data" id="editProductForm">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                {{-- Left Column --}}
                                <div class="col-md-8">
                                    {{-- Product Name --}}
                                    <div class="form-group mb-4">
                                        <label for="name" class="form-label fw-semibold mb-2" style="color:#002455;">
                                            <i class="fas fa-box me-2" style="color:#FFC107;"></i>
                                            Nama Produk
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text border-end-0" 
                                                  style="background-color: #f8f9fa; border: 2px solid #e9ecef; border-right: none; border-radius: 10px 0 0 10px;">
                                                <i class="fas fa-tag" style="color:#002455;"></i>
                                            </span>
                                            <input type="text" 
                                                   class="form-control border-start-0" 
                                                   id="name"
                                                   name="name" 
                                                   value="{{ old('name', $products->name) }}"
                                                   placeholder="Masukkan nama produk"
                                                   style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0; padding: 0.75rem;"
                                                   required>
                                        </div>
                                    </div>

                                    {{-- Price & Stock --}}
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="price" class="form-label fw-semibold mb-2" style="color:#002455;">
                                                <i class="fas fa-money-bill-wave me-2" style="color:#FFC107;"></i>
                                                Harga
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" 
                                                      style="background-color: #f8f9fa; border: 2px solid #e9ecef; border-right: none; border-radius: 10px 0 0 10px;">
                                                    Rp
                                                </span>
                                                <input type="number" 
                                                       class="form-control border-start-0" 
                                                       id="price"
                                                       name="price" 
                                                       value="{{ old('price', $products->price) }}"
                                                       placeholder="0"
                                                       style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0; padding: 0.75rem;"
                                                       min="0"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="stock" class="form-label fw-semibold mb-2" style="color:#002455;">
                                                <i class="fas fa-boxes me-2" style="color:#FFC107;"></i>
                                                Stok
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0" 
                                                      style="background-color: #f8f9fa; border: 2px solid #e9ecef; border-right: none; border-radius: 10px 0 0 10px;">
                                                    <i class="fas fa-warehouse" style="color:#002455;"></i>
                                                </span>
                                                <input type="number" 
                                                       class="form-control border-start-0" 
                                                       id="stock"
                                                       name="stock" 
                                                       value="{{ old('stock', $products->stock) }}"
                                                       placeholder="0"
                                                       style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0; padding: 0.75rem;"
                                                       min="0"
                                                       required>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Category --}}
                                    <div class="form-group mb-4">
                                        <label for="category_id" class="form-label fw-semibold mb-2" style="color:#002455;">
                                            <i class="fas fa-layer-group me-2" style="color:#FFC107;"></i>
                                            Kategori
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text border-end-0" 
                                                  style="background-color: #f8f9fa; border: 2px solid #e9ecef; border-right: none; border-radius: 10px 0 0 10px;">
                                                <i class="fas fa-folder" style="color:#002455;"></i>
                                            </span>
                                            <select name="category_id" 
                                                    id="category_id"
                                                    class="form-select border-start-0" 
                                                    style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 10px 10px 0; padding: 0.75rem;"
                                                    required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $products->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="form-group mb-4">
                                        <label for="description" class="form-label fw-semibold mb-2" style="color:#002455;">
                                            <i class="fas fa-align-left me-2" style="color:#FFC107;"></i>
                                            Deskripsi Produk
                                        </label>
                                        <textarea class="form-control" 
                                                  id="description"
                                                  name="description" 
                                                  rows="5"
                                                  placeholder="Tulis deskripsi lengkap produk Anda..."
                                                  style="border: 2px solid #e9ecef; border-radius: 10px; padding: 0.75rem;">{{ old('description', $products->description) }}</textarea>
                                        <small class="text-muted mt-2 d-block">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Deskripsi yang detail membantu pembeli memahami produk Anda
                                        </small>
                                    </div>
                                </div>

                                {{-- Right Column --}}
                                <div class="col-md-4">
                                    {{-- Image Upload --}}
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-semibold mb-2" style="color:#002455;">
                                            <i class="fas fa-image me-2" style="color:#FFC107;"></i>
                                            Gambar Produk
                                        </label>
                                        
                                        {{-- Image Preview Wrapper --}}
                                        <div id="imageWrapper" 
                                             class="mb-3 {{ $products->image ? '' : 'd-none' }}"
                                             style="position: relative; border-radius: 12px; overflow: hidden; border: 3px dashed #e9ecef;">
                                            <img id="previewImage" 
                                                 src="{{ $products->image ? asset('storage/' . $products->image) : '' }}"
                                                 class="w-100"
                                                 style="display: block; min-height: 200px; object-fit: cover;">
                                            
                                            <button type="button" 
                                                    id="removeImage"
                                                    class="btn btn-sm position-absolute top-0 end-0 m-2"
                                                    style="background-color: #dc3545; color:#fff; border: none; border-radius: 8px; padding: 0.5rem 0.75rem; font-weight: 600; box-shadow: 0 2px 4px rgba(220,53,69,0.3);">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>

                                        {{-- Upload Button --}}
                                        <label for="imageInput" 
                                               class="btn w-100 upload-btn"
                                               style="background: linear-gradient(135deg, rgba(0,36,85,0.05) 0%, rgba(27,60,83,0.05) 100%); color:#002455; border: 2px dashed #002455; border-radius: 10px; padding: 1rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                                            <i class="fas fa-cloud-upload-alt fa-2x mb-2 d-block"></i>
                                            <span id="uploadText">Klik untuk Upload Gambar</span>
                                            <small class="d-block mt-2 text-muted">JPG, PNG, atau WEBP (Max 2MB)</small>
                                        </label>
                                        <input type="file" 
                                               class="d-none" 
                                               name="image" 
                                               id="imageInput" 
                                               accept="image/*">

                                        <small class="text-muted mt-2 d-block">
                                            <i class="fas fa-lightbulb me-1"></i>
                                            Gunakan gambar berkualitas tinggi untuk hasil terbaik
                                        </small>
                                    </div>

                                    {{-- Product Info Card --}}
                                    <div class="card border-0" 
                                         style="background: linear-gradient(135deg, rgba(255,193,7,0.1) 0%, rgba(255,213,79,0.1) 100%); border-radius: 12px;">
                                        <div class="card-body p-3">
                                            <h6 class="fw-bold mb-3" style="color:#002455;">
                                                <i class="fas fa-info-circle me-2" style="color:#FFC107;"></i>
                                                Informasi Produk
                                            </h6>
                                            <div class="d-flex justify-content-between mb-2">
                                                <small class="text-muted">Created:</small>
                                                <small class="fw-semibold" style="color:#002455;">
                                                    {{ $products->created_at->format('d M Y') }}
                                                </small>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <small class="text-muted">Last Update:</small>
                                                <small class="fw-semibold" style="color:#002455;">
                                                    {{ $products->updated_at->format('d M Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="row mt-4 pt-3" style="border-top: 2px dashed #e9ecef;">
                                <div class="col-12">
                                    <div class="d-flex gap-2 justify-content-between flex-wrap">
                                        <a href="{{ route('admin.product') }}" 
                                           class="btn btn-cancel"
                                           style="background-color: transparent; color:#6c757d; border: 2px solid #6c757d; border-radius: 10px; padding: 0.75rem 1.5rem; font-weight: 600; transition: all 0.3s ease;">
                                            <i class="fas fa-times me-2"></i>Batal
                                        </a>
                                        
                                        <div class="d-flex gap-2">
                                            <button type="button" 
                                                    class="btn btn-reset"
                                                    onclick="resetForm()"
                                                    style="background-color: transparent; color:#002455; border: 2px solid #002455; border-radius: 10px; padding: 0.75rem 1.5rem; font-weight: 600; transition: all 0.3s ease;">
                                                <i class="fas fa-redo me-2"></i>Reset
                                            </button>
                                            
                                            <button type="submit" 
                                                    class="btn btn-save"
                                                    style="background: linear-gradient(135deg, #002455 0%, #1B3C53 100%); color:#fff; border: none; border-radius: 10px; padding: 0.75rem 2rem; font-weight: 700; box-shadow: 0 4px 12px rgba(0,36,85,0.3); transition: all 0.3s ease;">
                                                <i class="fas fa-save me-2"></i>Update Produk
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        .form-select:focus,
        .input-group-text:has(+ .form-control:focus),
        .input-group-text:has(+ .form-select:focus) {
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
            background-color: #6c757d !important;
            color: #fff !important;
            transform: translateY(-2px);
        }

        /* Reset Button Hover */
        .btn-reset:hover {
            background-color: #002455 !important;
            color: #fff !important;
            transform: translateY(-2px);
        }

        /* Upload Button Hover */
        .upload-btn:hover {
            background: linear-gradient(135deg, rgba(0,36,85,0.1) 0%, rgba(27,60,83,0.1) 100%) !important;
            border-color: #002455 !important;
            transform: scale(1.02);
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

        /* Remove Image Button Hover */
        #removeImage:hover {
            background-color: #c82333 !important;
            transform: scale(1.1);
        }

        /* Breadcrumb Links */
        .breadcrumb-item a:hover {
            color: #FFC107 !important;
        }
    </style>

    <script>
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('previewImage');
        const wrapper = document.getElementById('imageWrapper');
        const removeBtn = document.getElementById('removeImage');
        const uploadText = document.getElementById('uploadText');

        // Image Preview
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                // Check file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('⚠️ Ukuran file terlalu besar! Maksimal 2MB.');
                    this.value = '';
                    return;
                }

                // Check file type
                if (!file.type.match('image.*')) {
                    alert('⚠️ File harus berupa gambar (JPG, PNG, atau WEBP)');
                    this.value = '';
                    return;
                }

                preview.src = URL.createObjectURL(file);
                wrapper.classList.remove('d-none');
                uploadText.textContent = file.name;
            }
        });

        // Remove Image
        removeBtn.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus gambar?')) {
                imageInput.value = '';
                preview.src = '';
                wrapper.classList.add('d-none');
                uploadText.textContent = 'Klik untuk Upload Gambar';
            }
        });

        // Reset Form
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset form? Semua perubahan yang belum disimpan akan hilang.')) {
                document.getElementById('editProductForm').reset();
                
                // Reset image preview to original
                @if($products->image)
                    preview.src = "{{ asset('storage/' . $products->image) }}";
                    wrapper.classList.remove('d-none');
                @else
                    preview.src = '';
                    wrapper.classList.add('d-none');
                @endif
                
                uploadText.textContent = 'Klik untuk Upload Gambar';
            }
        }

        // Form Validation
        document.getElementById('editProductForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const price = document.getElementById('price').value;
            const stock = document.getElementById('stock').value;
            const category = document.getElementById('category_id').value;

            if (!name) {
                e.preventDefault();
                alert('❌ Nama produk tidak boleh kosong!');
                document.getElementById('name').focus();
                return false;
            }

            if (price < 0) {
                e.preventDefault();
                alert('❌ Harga tidak boleh negatif!');
                document.getElementById('price').focus();
                return false;
            }

            if (stock < 0) {
                e.preventDefault();
                alert('❌ Stok tidak boleh negatif!');
                document.getElementById('stock').focus();
                return false;
            }

            if (!category) {
                e.preventDefault();
                alert('❌ Silakan pilih kategori!');
                document.getElementById('category_id').focus();
                return false;
            }
        });
    </script>
@endsection