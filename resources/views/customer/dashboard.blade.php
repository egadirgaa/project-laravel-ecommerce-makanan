@extends('layouts.customer')

@section('content')

    <!-- Ringkasan Statistik -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 m-8">
        <!-- Total Pesanan -->
        <div class="bg-white shadow-lg rounded-lg p-6 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Total Pesanan</h3>
                <p class="text-2xl font-bold text-indigo-600">{{ $totalOrders }}</p>
            </div>
            <div class="bg-indigo-100 p-4 rounded-full">
                <i class="bx bx-cart-alt text-indigo-600 text-3xl"></i>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="bg-white shadow-lg rounded-lg p-6 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Total Pengeluaran</h3>
                <p class="text-2xl font-bold text-green-600">Rp{{ number_format($totalSpent, 0, ',', '.') }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-full">
                <i class="bx bx-wallet text-green-600 text-3xl"></i>
            </div>
        </div>

        <!-- Pesanan Pending -->
        <div class="bg-white shadow-lg rounded-lg p-6 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Pesanan Pending</h3>
                <p class="text-2xl font-bold text-yellow-600">{{ $pendingOrders }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-full">
                <i class="bx bx-time text-yellow-600 text-3xl"></i>
            </div>
        </div>
    </section>

    <!-- Pesanan Terbaru -->
    <section class="m-8">
        <p class="text-lg text-gray-600 mb-4">pesanan terakhir Anda :</p>

        <!-- List Pesanan -->
        <div class="space-y-6">
            @foreach($recentOrders as $order)
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-2xl font-semibold text-gray-800">Pesanan #{{ $order->id }}</h3>
                        <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-gray-600">Status: 
                            <span class="font-semibold 
                                {{ $order->status == 'completed' ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </span>
                        <span class="text-sm text-gray-600">Total: Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>

                    <div class="mt-4">
                        <h4 class="text-lg font-semibold text-gray-800">Detail Pesanan:</h4>
                        <ul class="list-disc pl-5 text-gray-600">
                            @foreach($order->orderItems as $item)
                                <li>{{ $item->product_name }} - {{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('customer.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">Lihat Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
