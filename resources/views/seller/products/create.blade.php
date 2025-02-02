@extends('layouts.seller')

@section('content')
    <div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-center text-blue-800 mb-8" data-sr="enter left">Tambah Produk Baru</h2>

        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="flex flex-col space-y-4" data-sr="enter right">
                <label for="name" class="text-lg text-blue-800">Nama Produk</label>
                <input type="text" id="name" name="name" class="p-3 border border-gray-300 rounded-lg w-full" required>

                <label for="description" class="text-lg text-blue-800">Deskripsi Produk</label>
                <textarea id="description" name="description" class="p-3 border border-gray-300 rounded-lg w-full" rows="4"></textarea>

                <div class="flex justify-between">
                    <div class="w-1/2 pr-2">
                        <label for="price" class="text-lg text-blue-800">Harga</label>
                        <input type="number" id="price" name="price" class="p-3 border border-gray-300 rounded-lg w-full" required>
                    </div>

                    <div class="w-1/2 pl-2">
                        <label for="stock" class="text-lg text-blue-800">Stok</label>
                        <input type="number" id="stock" name="stock" class="p-3 border border-gray-300 rounded-lg w-full" required>
                    </div>
                </div>

                <label for="category_id" class="text-lg text-blue-800">Kategori Produk</label>
                <select name="category_id" id="category_id" class="p-3 border border-gray-300 rounded-lg w-full">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="image" class="text-lg text-blue-800">Gambar Produk</label>
                <input type="file" id="image" name="image" class="p-3 border border-gray-300 rounded-lg w-full">
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="px-8 py-3 bg-blue-800 text-white font-semibold rounded-lg hover:bg-blue-600 transition-all duration-300">
                    Tambah Produk
                </button>
            </div>
        </form>
    </div>
@endsection
