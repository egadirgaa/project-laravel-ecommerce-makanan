@extends('layouts.seller')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Produk</h1>

    <a href="{{ route('seller.products.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded mb-4 shadow hover:bg-blue-600">Tambah Produk</a>

    <div class="overflow-x-auto">
        <ul class="space-y-4">
            @foreach ($products as $product)
                <li class="flex items-center justify-between bg-white p-4 shadow rounded-lg border border-gray-200 rawr">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded mr-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-700">{{ $product->name }}</h2>
                            <p class="text-gray-600">Rp {{ number_format($product->price, 2) }}</p>
                            <p class="text-gray-600">Kategori: {{ $product->category->name ?? 'Tidak ada' }}</p>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('seller.products.edit', $product->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
<!-- ScrollReveal JS -->
<script src="https://unpkg.com/scrollreveal"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Inisialisasi ScrollReveal
        ScrollReveal().reveal('.rawr', {
            duration: 500,
            distance: '50px',
            easing: 'ease-in-out',
            interval: 100,
            reset: false,
            opacity: 0,
            origin: 'left',
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
