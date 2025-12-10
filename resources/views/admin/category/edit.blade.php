@extends('templates.admin')

@section('content-admin')
    <div class="container py-5 d-flex justify-content-center">

        <div class="card shadow-sm" style="width: 500px; border-radius: 12px;">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Edit Category</h4>
                </div>

                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text"class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Enter category name">
                        @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100" style="border-radius: 8px;">
                        Save Category
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
