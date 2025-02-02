@extends('layouts.customer')

@section('content')
    <!-- Konten -->
    <main class="max-w-4xl mx-auto p-6">
        <h2 class="text-xl font-bold mb-6">Daftar Pesanan</h2>
        <div class="space-y-6" id="orders">
            @forelse($orders as $order)
                <div class="order bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">Pesanan {{ $order->id }}</h3>
                    <div class="space-y-4 mt-4">
                        @foreach($order->orderDetails as $orderDetail)
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $orderDetail->product->image) }}" alt="Produk" class="w-24 h-24 rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $orderDetail->product->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Harga satuan: Rp.{{ number_format($orderDetail->product->price, 2) }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah: {{ $orderDetail->quantity }}</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Subtotal: Rp.{{ number_format($orderDetail->quantity * $orderDetail->product->price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <p class="text-lg font-bold text-gray-900 dark:text-gray-100">Total Pesanan: Rp.{{ number_format($order->orderDetails->sum(fn($detail) => $detail->quantity * $detail->product->price), 2) }}</p>
                        <p class="text-sm mt-2 font-semibold">
                            Status: 
                            <span class="{{ $order->status === 'completed' ? 'text-green-600' : ($order->status === 'cancelled' ? 'text-red-600' : 'text-yellow-600') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        @if ($order->status === 'pending')
                        <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                                Batalkan Pesanan
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-400">Anda belum memiliki pesanan.</p>
            @endforelse
        </div>
    </main>

    <script src="{{ asset('js/keranjang.js') }}"></script>
@endsection
