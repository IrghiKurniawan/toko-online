@extends('templates.customer')

@section('content-customer')
    <div class="max-w-7xl mx-auto py-10 px-4">

        <h2 class="text-3xl font-bold mb-8 text-gray-800">Produk Terbaru</h2>

        {{-- Search Bar --}}
        <form action="" method="GET" class="mb-8">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari Produk ..."
                class="w-full md:w-1/2 px-4 py-3 border rounded-lg shadow-sm
                      focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($products as $product)
                <div
                    class="bg-white rounded-2xl shadow-lg border overflow-hidden
                        transition duration-300 hover:shadow-2xl hover:-translate-y-2">

                    {{-- Gambar Produk --}}
                    <div class="relative w-full h-56 overflow-hidden group rounded-t-2xl">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>

                        <span
                            class="absolute top-3 left-3 bg-white/90 text-gray-900 text-xs font-semibold px-3 py-1 rounded-full shadow">
                            Stok: {{ $product->stock }}
                        </span>
                    </div>

                    {{-- Info Produk --}}
                    <div class="p-4 flex flex-col justify-between h-48">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
                            <p class="text-blue-600 font-bold text-lg mt-2">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <a href="{{ route('customer.cart.add' , $product->id) }}"
                            class="mt-4 block w-full text-center bg-blue-600 text-white py-2 rounded-lg
                              font-medium shadow hover:bg-blue-700 hover:shadow-md transition">
                            Add to Cart
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $products->links() }}
        </div>

    </div>
@endsection
