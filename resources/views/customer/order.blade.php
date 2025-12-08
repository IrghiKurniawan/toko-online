@extends('templates.customer')

@section('content-customer')
<div class="container py-4">
    <h4 class="fw-bold">Order History</h4>

    @forelse ($orders as $order)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <p class="mb-1"><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p class="mb-1"><strong>Total:</strong> Rp {{ number_format($order->total_price,0,',','.') }}</p>

                <ul class="mt-2">
                    @foreach ($order->items as $item)
                        <li>
                            {{ $item->product->name }} (x{{ $item->quantity }})
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada order.</p>
    @endforelse
</div>
@endsection
