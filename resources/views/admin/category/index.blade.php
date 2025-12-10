@extends('templates.admin')

@section('content-admin')
    <div class="container py-5">
        <div class="card shadow-sm w-100" style="border-radius:12px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Categories</h5>
                    <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-outline-primary">Add category</a>
                </div>

                <table class="table table-borderless mb-0">
                    <thead>
                        <tr class="text-muted text-uppercase small">
                            <th>Name</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.category.edit', $item->id) }}"
                                        class="btn btn-link btn-sm p-0 me-2">Edit</a>
                                    <form action="{{ route('admin.category.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-link btn-sm p-0 text-danger" onclick="return confirm('Are you sure?');">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
