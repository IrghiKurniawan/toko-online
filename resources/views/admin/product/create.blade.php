@extends('templates.admin')

@section('content-admin')
    <style>
        .page-wrapper {
            margin-top: 80px;
        }

        .form-card {
            border-radius: 16px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
        }

        .image-preview {
            width: 100%;
            height: 180px;
            border: 2px dashed #dee2e6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            overflow: hidden;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

    <div class="container page-wrapper d-flex justify-content-center">

        <div class="card form-card shadow-sm" style="width: 520px;">
            <div class="card-body p-4">

                <div class="mb-4 text-center">
                    <h4 class="fw-bold mb-1">Add Product</h4>
                    <small class="text-muted">Masukkan data produk baru</small>
                </div>

                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.product.store') }}">
                    @csrf

                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Image</label>
                        <div class="image-preview mb-2" id="preview">
                            Preview Image
                        </div>
                        <input type="file" class="form-control" id="image" name="image"
                            onchange="previewImage(event)">
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan nama produk">
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Stok</label>
                        <input type="number" class="form-control" name="stock" placeholder="Masukkan stok">
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga</label>
                        <input type="number" class="form-control" name="price" placeholder="Masukkan harga">
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Deskripsi produk"></textarea>
                    </div>

                    <!-- Button -->
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        Save Product
                    </button>
                </form>

            </div>
        </div>

    </div>
@endsection
{{-- Image Preview Script --}}
@push('scripts')
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[0]);
            preview.appendChild(img);
        }
    </script>
@endpush
