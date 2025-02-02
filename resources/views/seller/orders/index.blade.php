@extends('layouts.seller')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pesanan</h1>

    <div class="bg-white shadow rounded-lg p-4 space-y-4">
        @foreach ($orders as $orderDetail)
            <div class="flex items-center justify-between border-b pb-4">
                <div class="flex items-center">
                    <div class="text-gray-700 font-semibold mr-6">ID Pesanan: 
                        <span class="text-blue-500">{{ $orderDetail->order->id }}</span>
                    </div>
                    <div class="text-gray-700">Nama Pelanggan: 
                        <span class="text-blue-500">{{ $orderDetail->order->customer->name }}</span>
                    </div>
                </div>
                <div class="text-gray-700">Total Harga: Rp {{ number_format($orderDetail->total_price, 2) }}</div>
                <div class="text-gray-700">Tanggal: {{ $orderDetail->created_at->format('d-m-Y') }}</div>
                <div class="text-gray-700">
                    <span class="px-2 py-1 rounded 
                        @if($orderDetail->order->status == 'pending') bg-yellow-300 text-yellow-800
                        @elseif($orderDetail->order->status == 'processing') bg-blue-300 text-blue-800
                        @elseif($orderDetail->order->status == 'completed') bg-green-300 text-green-800
                        @endif">
                        {{ ucfirst($orderDetail->order->status) }}
                    </span>
                </div>
                <div class="ml-4">
                    <!-- Tombol Show -->
                    <a href="{{ route('seller.orders.show', $orderDetail->order->id) }}" 
                       class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @endforeach

        @if ($orders->isEmpty())
            <p class="text-center text-gray-500">Belum ada pesanan.</p>
        @endif
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
