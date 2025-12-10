@extends('templates.admin')

@section('content-admin')
    <div class="container-fluid page-wrapper mt-4">

        <div class="card shadow-sm" style="max-width: 700px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-4">Edit Produk</h5>

                <form action="{{ route('admin.product.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="name" value="{{ $products->name }}" required>
                    </div>

                    {{-- Harga --}}
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" name="price" value="{{ $products->price }}" required>
                    </div>

                    {{-- Stok --}}
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stock" value="{{ $products->stock }}" required>
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $products->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Produk</label>

                        <input type="file" class="form-control" name="image" id="imageInput" accept="image/*">

                        {{-- Wrapper Preview --}}
                        <div id="imageWrapper" class="mt-3 position-relative {{ $products->image ? '' : 'd-none' }}"
                            style="max-width:160px;">

                            <img id="previewImage" src="{{ $products->image ? asset('storage/' . $products->image) : '' }}"
                                class="rounded w-100">

                            <button type="button" id="removeImage"
                                class="btn btn-sm btn-danger position-absolute top-0 end-0">
                                ✕
                            </button>
                        </div>
                    </div>




                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" rows="3">{{ $products->description }}</textarea>
                    </div>

                    {{-- Button --}}
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">Update Produk</button>
                        <a href="{{ route('admin.product') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
    <script>
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('previewImage');
        const wrapper = document.getElementById('imageWrapper');
        const removeBtn = document.getElementById('removeImage');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
                wrapper.classList.remove('d-none'); // tampilkan wrapper
            }
        });

        removeBtn.addEventListener('click', function() {
            imageInput.value = ''; // reset file input
            preview.src = ''; // kosongin gambar
            wrapper.classList.add('d-none'); // sembunyikan wrapper (img + tombol)
        });
    </script>
@endsection
