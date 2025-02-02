@extends('layouts.seller')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-semibold text-gray-600 text-center mb-12" data-sr="enter from top and move 50px">Dashboard Penjual</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        <!-- Total Produk -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between box-card" data-sr="enter from bottom and move 50px">
            <div>
                <h2 class="text-xl font-semibold text-gray-700">Total Produk</h2>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts }}</p>
            </div>
            <div class="bg-blue-100 p-4 rounded-full">
                <i class="bx bx-package text-blue-500 text-4xl"></i>
            </div>
        </div>

        <!-- Total Pesanan -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between box-card" data-sr="enter from bottom and move 50px">
            <div>
                <h2 class="text-xl font-semibold text-gray-700">Total Pesanan</h2>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalOrders }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-full">
                <i class="bx bx-cart text-green-500 text-4xl"></i>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between box-card" data-sr="enter from bottom and move 50px">
            <div>
                <h2 class="text-xl font-semibold text-gray-700">Total Pendapatan</h2>
                <p class="text-3xl font-bold text-gray-800 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-full">
                <i class="bx bx-dollar text-yellow-500 text-4xl"></i>
            </div>
        </div>
    </div>

    <div class="mt-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6" data-sr="enter from top and move 50px">Pesanan Terbaru</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($recentOrders as $order)
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 box-card" data-sr="enter from bottom and move 50px">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Pesanan {{ $order->id }}</h3>
                <span class="px-3 py-1 rounded-full text-sm 
                    {{ $order->status === 'Completed' ? 'bg-green-100 text-green-600' : 
                       ($order->status === 'Pending' ? 'bg-yellow-100 text-yellow-600' : 
                       'bg-red-100 text-red-600') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <p class="text-sm text-gray-600">Pelanggan: {{ $order->customer_name }}</p>
            <p class="text-sm text-gray-600">Total: Rp {{ number_format($order->details->sum(fn($d) => $d->quantity * $d->price), 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500 mt-2">Tanggal: {{ $order->created_at->format('d M Y') }}</p>
        </div>
        @empty
        <div class="bg-white p-6 rounded-lg shadow-md text-center col-span-3">
            <p class="text-gray-500">Tidak ada pesanan terbaru.</p>
        </div>
        @endforelse
        
        </div>
    </div>
</div>

<!-- ScrollReveal JS -->
<script src="https://unpkg.com/scrollreveal"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Inisialisasi ScrollReveal
        ScrollReveal().reveal('.box-card', {
            duration: 500,
            distance: '50px',
            easing: 'ease-in-out',
            interval: 100,
            reset: false,
            opacity: 0,
            origin: 'top',
        });

        // Animasi untuk judul halaman
        ScrollReveal().reveal('h1', {
            duration: 700,
            distance: '100px',
            easing: 'ease-in-out',
            origin: 'top',
            delay: 200,
            reset: false,
            opacity: 0.5,
        });
    });
</script>
@endsection
