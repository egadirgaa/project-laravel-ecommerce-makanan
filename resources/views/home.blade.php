<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

        <!--========== CSS ==========-->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>RestoranKu</title>
    </head>
    <body>

        <!--========== SCROLL TOP ==========-->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

        <!--========== HEADER ==========-->
        <header class="l-header" id="header">
            <nav class="nav bd-container">
                <a href="#" class="nav__logo">DapurSederhana</a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        @if ( auth()->check() && auth()->user()->role === 'seller' )
                        <li class="nav__item">
                            <a href="{{ route('seller.dashboard') }}" class="nav__link active-link">
                                    <i class="bx bx-store "></i>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        @endif
                        
                        @if ( !auth()->check() )
                            <li class="nav__item"><a href="{{ route('showLoginForm') }}" class="nav__link active-link">Login</a></li>
                        @endif               
                            <li class="nav__item"><a href="#home" class="nav__link active-link">Beranda</a></li>
                        @if ( auth()->check() && auth()->user()->role === 'customer')
                            <li class="nav__item">
                                <a href="{{ route('customer.cart.index') }}" class="text-[#069C54] "><i class='bx bx-cart'></i></a>
                            </li>
                        @endif
                        <li>
                            <i class='bx bx-moon change-theme' id="theme-button"></i>
                        </li>
                    </ul>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>

        <main class="l-main">
            <!--========== HOME ==========-->
            <section class="home" id="home">
                <div class="home__container bd-container bd-grid">
                    <div class="home__data">
                        <h1 class="home__title">Makanan Lezat</h1>
                        <h2 class="home__subtitle">Coba makanan terbaik minggu ini.</h2>
                        <a href="{{ route('allmenu') }}" class="button">Lihat Menu</a>
                    </div>
    
                    <img src="{{ asset('img/home.png') }}" alt="" class="home__img">
                </div>
            </section>
            
            <!--========== ABOUT ==========-->
            <section class="about section bd-container" id="about">
                <div class="about__container  bd-grid">
                    <div class="about__data">
                        <span class="section-subtitle about__initial">Tentang Kami</span>
                        <h2 class="section-title about__initial">Kami memasak makanan terbaik</h2>
                        <p class="about__description">Kami memasak makanan terbaik di seluruh kota, dengan pelayanan pelanggan yang luar biasa, makanan terbaik, dan harga terbaik. Kunjungi kami.</p>
                        <a href="#" class="button">Jelajahi Sejarah</a>
                    </div>

                    <img src="{{ asset('img/about.jpg') }}" alt="" class="about__img">
                </div>
            </section>

            <!--========== SERVICES ==========-->
            <section class="services section bd-container" id="services">
                <span class="section-subtitle">Menawarkan</span>
                <h2 class="section-title">Layanan Menakjubkan Kami</h2>

                <div class="services__container  bd-grid">
                    <div class="services__content">
                        <i class="fa-solid fa-utensils fa-5x text-green-500"></i>
                        <h3 class="services__title">Makanan Berkualitas</h3>
                        <p class="services__description">Kami menawarkan layanan berkualitas dengan makanan terbaik dan lezat di kota selama bertahun-tahun.</p>
                    </div>

                    <div class="services__content">
                        <i class="fa-solid fa-burger fa-5x text-green-500"></i>
                        <h3 class="services__title">Makanan Cepat Saji</h3>
                        <p class="services__description">Kami menawarkan layanan makanan cepat saji dengan kualitas terbaik dan lezat di kota.</p>
                    </div>

                    <div class="services__content">
                        <i class="fa-solid fa-truck fa-5x text-green-500"></i>
                        <h3 class="services__title">Pengiriman</h3>
                        <p class="services__description">Kami menawarkan pengiriman makanan yang cepat dan aman ke lokasi Anda.</p>
                    </div>
                </div>
            </section>

            <!--========== MENU ==========-->
            <section class="menu section bd-container" id="menu">
                <span class="section-subtitle">Spesial</span>
                <h2 class="section-title">Menu Minggu Ini</h2>
            
                <div class="menu__container bd-grid">
                    @foreach ($topProducts as $product)
                        <div class="menu__content">
                            <img src="{{ asset('storage/' . $product->image ?? 'img/default.png') }}" alt="{{ $product->name }}" class="menu__img">
                            <h3 class="menu__name">{{ $product->name }}</h3>
                            <span class="menu__detail">{{ $product->description ?? 'Hidangan lezat' }}</span>
                            <span class="menu__preci">Rp.{{ number_format($product->price, 2) }}</span>
                            <a href="#" class="button menu__button"><i class='bx bx-cart-alt'></i></a>
                        </div>
                    @endforeach
                </div>
            </section>

            <!--===== APP =======-->
            {{-- <section class="app section bd-container">
                <div class="app__container bd-grid">
                    <div class="app__data">
                        <span class="section-subtitle app__initial">Aplikasi</span>
                        <h2 class="section-title app__initial">Aplikasi Tersedia</h2>
                        <p class="app__description">Temukan aplikasi kami dan unduh. Anda dapat melakukan reservasi, memesan makanan, melihat pengiriman, dan banyak lagi.</p>
                        <div class="app__stores">
                            <a href="#"><img src="{{ asset('img/app1.png') }}" alt="" class="app__store"></a>
                            <a href="#"><img src="{{ asset('img/app2.png') }}" alt="" class="app__store"></a>
                        </div>
                    </div>

                    <img src="{{ asset('img/movil-app.png') }}" alt="" class="app__img">
                </div>
            </section> --}}

            <!--========== CONTACT US ==========-->
            <section class="contact section bd-container" id="contact">
                <div class="contact__container bd-grid">
                    <div class="contact__data">
                        <span class="section-subtitle contact__initial">Hubungi Kami</span>
                        <h2 class="section-title contact__initial">Kontak Kami</h2>
                        <p class="contact__description">Jika Anda ingin melakukan reservasi di restoran kami, hubungi kami dan kami akan melayani Anda dengan cepat melalui layanan chat 24/7 kami.</p>
                    </div>

                    <div class="contact__button">
                        <a href="#" class="button">Hubungi Kami Sekarang</a>
                    </div>
                </div>
            </section>
        </main>

        <!--========== FOOTER ==========-->
        <footer class="text-gray-300 py-10 mt-16">
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
                    <p>© 2025. All rights reserved. Dibuat oleh <a href="https://www.instagram.com/egdrga" class="text-blue-400 hover:underline">egadirga</a>.</p>
                </div>
            </div>
        </footer>

        <!-- ========== SCROLL REVEAL ========== -->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!--========== MAIN JS ==========-->
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
