<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Restoran</title>

    <!-- Boxicons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">

    <!-- ScrollReveal.js CDN -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans min-h-screen flex items-center justify-center bg-gradient-to-t from-gray-800 to-orange-800">

    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-4xl space-y-6">
        <div class="text-center mb-8" data-scroll>
            <i class="bx bx-dish text-red-600 text-6xl mb-4"></i>
            <h2 class="text-4xl font-bold text-red-600">Bergabung dengan Klub Kuliner Kami</h2>
            <p class="text-gray-600">Daftar sekarang untuk menjelajahi hidangan terbaik dan penawaran eksklusif di restoran kami.</p>
        </div>

        <form action="{{ url('register') }}" method="POST" class="space-y-6" data-scroll>
            @csrf

            <!-- Nama dan Email (Samping-sampingan) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-2 p-4 w-full border-b-2 border-red-300 focus:border-red-600 focus:outline-none focus:ring-0" placeholder="Nama Lengkap" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-2 p-4 w-full border-b-2 border-red-300 focus:border-red-600 focus:outline-none focus:ring-0" placeholder="Email" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Kata Sandi dan Konfirmasi Kata Sandi (Samping-sampingan) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <input type="password" name="password" id="password" class="mt-2 p-4 w-full border-b-2 border-red-300 focus:border-red-600 focus:outline-none focus:ring-0" placeholder="Kata Sandi" required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-2 p-4 w-full border-b-2 border-red-300 focus:border-red-600 focus:outline-none focus:ring-0" placeholder="Konfirmasi Kata Sandi" required>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Telepon dan Alamat (Samping-sampingan) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="mt-2 p-4 w-full border-b-2 border-red-300 focus:border-red-600 focus:outline-none focus:ring-0" placeholder="Telepon">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" class="mt-2 p-4 w-full border-b-2 border-red-300 focus:border-red-600 focus:outline-none focus:ring-0" placeholder="Alamat">
                    @error('address')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="w-full py-3 bg-red-600 text-white font-medium rounded-md hover:bg-red-700 transition duration-300 ease-in-out">
                Daftar <i class="bx bx-dish align-middle ml-2"></i>
            </button>

            @if(session('message'))
                <div class="text-red-600 mt-4 text-center">{{ session('message') }}</div>
            @endif
        </form>

        <div class="text-center mt-6">
            <p class="text-gray-600">Sudah punya akun? <a href="{{ url('login') }}" class="text-red-600 hover:underline">Masuk di sini</a></p>
        </div>
    </div>

    <script>
        // Konfigurasi ScrollReveal.js
        ScrollReveal().reveal('[data-scroll]', {
            duration: 1000,
            distance: '30px',
            origin: 'bottom',
            opacity: 0,
            reset: true,
            interval: 100
        });
    </script>
</body>

</html>
