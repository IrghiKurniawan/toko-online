@extends('templates.admin')

@section('content-admin')
    <div class="container mt-4">
        <h4 class="mb-3">Orders</h4>

        <div class="card">
            <div class="card-body">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Nama Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->name }}</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST"
                                        class="d-flex gap-2">
                                        @csrf
                                        @method('PUT')

                                        <select name="status" class="form-select form-select-sm"
                                            {{ in_array($order->status, ['completed', 'cancelled']) ? 'disabled' : '' }}>

                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="processing"
                                                {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                Processing
                                            </option>

                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>

                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>

                                        @if (!in_array($order->status, ['completed', 'cancelled']))
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                Save
                                            </button>
                                        @endif
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
