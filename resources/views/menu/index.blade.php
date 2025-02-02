<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | RestoranKu</title>

    <!--========== Fonts ==========-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!--========== CSS ==========-->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-[#FBFEFD] text-[#707070] font-sans transition-colors duration-300 text-sm" id="body" style="font-family: 'Poppins', sans-serif">

<!-- Header -->
<header id="navbar" class="fixed top-0 left-0 w-full bg-white py-4 transition-shadow duration-300 z-50 text-lg font-semibold reveal">
    <nav class="max-w-7xl mx-auto flex justify-between items-center px-4">
        <a href="#" class="text-[#069C54] font-medium text-xl">DapurSederhana</a>

        <div class="hidden md:flex items-center space-x-6">
            @if ( auth()->check() && auth()->user()->role === 'seller' )                
            <a href="{{ route('seller.dashboard') }}" class="text-[#069C54] ">
                    <i class="bx bx-store "></i>
                <span class="ml-2">Dashboard</span>
            </a>
            @endif
            <a href="{{ route('home') }}" class="text-[#069C54] ">Beranda</a>
            
            @if ( auth()->check() && auth()->user()->role === 'customer')
            <a href="{{ route('customer.cart.index') }}" class="text-[#069C54] "><i class='bx bx-cart'></i></a>
            @endif
            
            <!-- Dark/Light Mode Toggle -->
            <button id="theme-toggle" class="text-[#069C54] hover:text-[#048654] transition duration-300">
                <i class="bx bx-sun text-xl" id="sun-icon"></i>
                <i class="bx bx-moon text-xl hidden" id="moon-icon"></i>
            </button>
        </div>

        <div class="md:hidden">
            <a href="{{ route('home') }}"><i class='bx bx-home'></a></i>
        </div>
    </nav>
</header>

<!-- Menu Section -->
<section id="menu" class="py-16 my-10 reveal">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 px-4">
        @foreach($products as $product)
            <div class="bg-white shadow-lg rounded-lg p-6 relative overflow-hidden group max-w-sm mx-auto reveal">
                <div class="w-full aspect-w-1 aspect-h-1">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-md transition-transform duration-300 group-hover:scale-105">
                </div>
                <h3 class="text-lg font-semibold text-green-700 mb-2 group-hover:text-green-600 transition duration-300 mt-2">{{ $product->name }}</h3>
                <p class="text-sm text-[#707070] mb-3">{{ $product->description }}</p>
                <p class="font-semibold text-[#069C54]">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            
                <!-- Button with cart icon at the bottom-right corner -->
                @if ( auth()->check() && auth()->user()->role !== 'seller')
                <form action="{{ route('customer.cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="absolute bottom-0 right-0 p-3 inline-block rounded-tl-xl text-white bg-green-500 hover:bg-green-700 transition-transform duration-300 translate-y-2 group-hover:translate-y-0">
                        <i class="bx bx-cart text-2xl"></i>
                    </button>
                </form>
                {{-- @else
                    <button type="submit" class="absolute bottom-0 right-0 p-3 inline-block rounded-tl-xl text-white bg-green-500 hover:bg-green-700 transition-transform duration-300 translate-y-2 group-hover:translate-y-0">
                        <i class='bx bx-smile text-lg'></i>
                    </button>
                </form> --}}
                @endif

            </div>
        @endforeach
    </div>
</section>

<!--========== FOOTER ==========-->
<footer class="text-gray-300 py-10 mt-16 reveal">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        
        <!-- Garis Pemisah -->
        <div class="border-t border-gray-700 my-5"></div>
        <!-- Bagian Atas Footer -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <!-- Tentang -->
            <div>
                <h4 class="text-gray-400 text-xl font-semibold mb-4">Tentang Kami</h4>
                <p class="text-sm leading-relaxed">
                    Kami menyediakan layanan terbaik untuk kebutuhan Anda. Hubungi kami untuk informasi lebih lanjut.
                </p>
            </div>
            <!-- Tautan Cepat -->
            <div>
                <h4 class="text-gray-400 text-xl font-semibold mb-4">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:underline">Beranda</a></li>
                    <li><a href="#" class="hover:underline">Layanan</a></li>
                    <li><a href="#" class="hover:underline">Kontak</a></li>
                    <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <!-- Media Sosial -->
            <div>
                <h4 class="text-gray-400 text-xl font-semibold mb-4">Ikuti Kami</h4>
                <div class="flex justify-center md:justify-start space-x-4">
                    <a href="#" class="hover:text-blue-500" aria-label="Facebook">
                        <i class="bx bxl-facebook-square text-2xl"></i>
                    </a>
                    <a href="#" class="hover:text-blue-400" aria-label="Twitter">
                        <i class="bx bxl-twitter text-2xl"></i>
                    </a>
                    <a href="#" class="hover:text-pink-500" aria-label="Instagram">
                        <i class="bx bxl-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="hover:text-red-500" aria-label="YouTube">
                        <i class="bx bxl-youtube text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
    
        <!-- Garis Pemisah -->
        <div class="border-t border-gray-700 my-5 w-0"></div>
    
        <!-- Bagian Bawah Footer -->
        <div class="text-end text-sm">
            <p>© 2025. All rights reserved. Dibuat oleh <a href="https://www.instagram.com/egdrga" class="text-blue-400 hover:underline">egdrga</a>.</p>
        </div>
    </div>
</footer>

<!--========== ScrollReveal.js ==========-->
<script src="https://unpkg.com/scrollreveal"></script>

<!--========== MAIN JS ==========-->
<script src="{{ asset('js/menu.js') }}"></script>

</body>
</html>
