@extends('layouts.seller')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Pesanan</h1>

    <!-- Card untuk detail pesanan -->
    <div class="bg-white shadow-lg rounded-lg p-6 space-y-6">
        <div class="flex justify-between items-center border-b pb-4">
            <div class="text-gray-700 font-semibold">ID Pesanan:</div>
            <div class="text-blue-500 font-semibold">{{ $order->id }}</div>
        </div>

        <div class="text-gray-700 font-semibold">Tanggal Pesanan: {{ $order->created_at->format('d-m-Y') }}</div>

        <!-- Daftar Produk yang Dipesan -->
        <h2 class="text-2xl font-semibold text-gray-700 mt-4">Produk yang Dipesan</h2>
        @foreach ($order->orderDetails as $orderDetail)
            <div class="bg-gray-50 p-4 mb-6 rounded-lg shadow-md">
                <div class="flex items-center space-x-6">
                    <!-- Gambar Produk -->
                    <img src="{{ asset('storage/' . $orderDetail->product->image) }}" 
                         alt="{{ $orderDetail->product->name }}" 
                         class="w-24 h-24 object-cover rounded-lg border border-gray-200">

                    <div class="flex-1">
                        <div class="text-lg font-medium text-gray-800">{{ $orderDetail->product->name }}</div>
                    </div>
                </div>
                
                <div class="mt-4 grid grid-cols-1 gap-4">
                    <div class="text-gray-800 font-semibold">Jumlah: {{ $orderDetail->quantity }}</div>
                    <div>
                        <div class="text-gray-700 font-medium">Harga Satuan:</div>
                        <div class="text-gray-800">Rp {{ number_format($orderDetail->price, 2) }}</div>
                    </div>
                    <hr>
                    <div>
                        <div class="text-gray-700 font-medium">Total Harga:</div>
                        <div class="text-gray-800">Rp {{ number_format($orderDetail->quantity * $orderDetail->price, 2) }}</div>
                    </div>    
                </div>
            </div>
        @endforeach

        <!-- Form untuk mengubah status pesanan -->
        
        @if ( $order->status !== 'completed' && $order->status !== 'cancelled' )
        <div class="mt-6">
            <form action="{{ route('seller.orders.updateStatus', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex items-center justify-between">
                    <div class="text-gray-700 font-semibold">Status Pesanan:</div>
                    <div>
                        <select name="status" class="border-gray-300 rounded-md">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>

                        <button type="submit" class="inline-block bg-green-500 text-white py-1 px-4 rounded hover:bg-green-600 ml-2">
                            Update Status
                        </button>
                    </div>
                    
                </div>
            </form>
        </div>
        @endif

        <!-- Tombol Kembali -->
        <div class="mt-4 text-center">
            <a href="{{ route('seller.orders.index') }}" 
               class="inline-block bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-300">
                Kembali ke Daftar Pesanan
            </a>
        </div>
    </div>
</div>
@endsection
