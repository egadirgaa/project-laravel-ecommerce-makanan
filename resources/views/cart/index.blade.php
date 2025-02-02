@extends('layouts.customer')

@section('content')
    <!-- Konten -->
    <main class="max-w-4xl mx-auto p-6">
        <h2 class="text-xl font-bold mb-6">Produk dalam Keranjang</h2>
        <div class="space-y-6" id="cart">
            @forelse($carts as $cart)
                <div class="product flex items-center bg-white dark:bg-gray-800 rounded-lg shadow p-4" data-price="{{ $cart->product->price }}">
                    <img src="{{ asset('storage/' . $cart->product->image) }}" alt="Produk" class="w-24 h-24 rounded-lg">
                    <div class="flex-1 ml-4">
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">{{ $cart->product->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Harga satuan: Rp.{{ number_format($cart->product->price, 2) }}</p>
                        <div class="flex items-center mt-3 space-x-2">
                            <button class="decrement px-3 py-1 bg-gray-200 dark:bg-gray-600 rounded hover:bg-gray-300 dark:hover:bg-gray-500">-</button>
                            <span class="quantity font-semibold text-lg text-gray-900 dark:text-gray-100">{{ $cart->quantity }}</span>
                            <button class="increment px-3 py-1 bg-gray-200 dark:bg-gray-600 rounded hover:bg-gray-300 dark:hover:bg-gray-500">+</button>
                            <form action="{{ route('customer.cart.update', $cart->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" class="quantity-input" value="{{ $cart->quantity }}">
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-500">
                                    <i class="bx bx-save text-lg mr-2"></i> Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="subtotal text-lg font-bold text-green-500 dark:text-green-400">Rp.{{ number_format($cart->quantity * $cart->product->price, 2) }}</p>
                        <!-- Form untuk Hapus Produk -->
                        <form action="{{ route('customer.cart.destroy', $cart->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 dark:text-red-400 hover:bg-gray-200 mt-2 block">
                                <i class="bx bx-trash text-xl p-1"></i>
                            </button>
                        </form>
                    </div>
                    
                </div>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-400">Keranjang Anda kosong.</p>
            @endforelse
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex justify-between items-center">
                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">Total: <span id="total">Rp.{{ number_format($carts->sum(fn($cart) => $cart->quantity * $cart->product->price), 2) }}</span></p>
                <div class="">
                    <!-- Tombol Pesan Sekarang -->
                    <form action="{{ route('customer.cart.order') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 w-full">
                            Pesan Semua
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </main>

    <script src="{{ asset('js/keranjang.js') }}"></script>
</body>
@endsection
