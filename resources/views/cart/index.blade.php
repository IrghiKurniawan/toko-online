@extends('templates.app')

@section('content-dinamis')
    <div class="container py-4">
        <h4 class="fw-bold">Cart</h4>
        <small class="text-muted">Review items before checkout</small>

        <div class="row mt-4 g-4">
            {{-- CART ITEMS --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">Cart items</h6>

                        @if ($cart && $cart->items->count() > 0)
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart->items as $item)
                                            <tr>
                                                {{-- PRODUCT --}}
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                                            class="rounded border me-2" width="60" height="60">
                                                        <span class="fw-semibold">
                                                            {{ $item->product->name }}
                                                        </span>
                                                    </div>
                                                </td>

                                                {{-- PRICE --}}
                                                <td class="text-center">
                                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                                </td>

                                                {{-- QTY --}}
                                                <td class="text-center">
                                                    <div class="input-group input-group-sm justify-content-center"
                                                        style="width: 120px;">
                                                        <button class="btn btn-outline-secondary"
                                                            onclick="updateQty('{{ route('cart.decrease', $item->id) }}')">-</button>

                                                        <input type="text" class="form-control text-center"
                                                            value="{{ $item->quantity }}" readonly>

                                                        <button class="btn btn-outline-secondary"
                                                            onclick="updateQty('{{ route('cart.increase', $item->id) }}')">+</button>
                                                    </div>
                                                </td>

                                                {{-- SUBTOTAL --}}
                                                <td class="text-end fw-semibold">
                                                    Rp
                                                    {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">Keranjang masih kosong</p>
                        @endif



                        {{-- END ITEM --}}
                    </div>
                </div>
            </div>

            {{-- RIGHT : SUMMARY --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">Summary</h6>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="text-muted">Calculated at checkout</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold mb-3">
                            <span>Total</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        <small class="text-muted d-block mb-3">
                            Taxes and discounts calculated at checkout.
                        </small>

                        <a href="{{ route('checkout') }}" class="btn btn-primary w-100">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function updateQty(url) {
        fetch(url, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {
                location.reload(); // reload sebagian / full
            });
    }
</script>
