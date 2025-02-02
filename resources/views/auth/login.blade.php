<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Klub Foodie's</title>

    <!-- Boxicons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">

    <!-- ScrollReveal.js CDN -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-t from-gray-800 to-orange-800 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md space-y-6">
            <!-- Ikon dan Judul -->
            <div class="text-center mb-8">
                <i class="bx bx-restaurant text-orange-600 text-6xl mb-4"></i>
                <h2 class="text-3xl font-bold text-orange-600">Selamat Datang di Foodie's Club!</h2>
                <p class="text-gray-600">Masuk untuk menikmati penawaran eksklusif dan hidangan terbaik di restoran kami.</p>
            </div>

            <!-- Form Login -->
            <form action="{{ url('login') }}" method="POST" data-scroll>
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <input type="email" name="email" id="email" placeholder="Alamat Email" value="{{ old('email') }}" class="mt-2 p-2 w-full border-b-2 border-orange-500 focus:outline-none focus:border-orange-700" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <input type="password" name="password" id="password" placeholder="Kata Sandi" class="mt-2 p-2 w-full border-b-2 border-orange-500 focus:outline-none focus:border-orange-700" required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input type="checkbox" name="remember" id="remember" class="h-5 w-5 text-orange-600 focus:ring-orange-400">
                    <label for="remember" class="ml-2 text-gray-700">Ingat Saya</label>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="w-full py-3 bg-orange-600 text-white rounded-md hover:bg-orange-700 transition ease-in-out duration-300">
                    Masuk <i class="bx bx-log-in-circle align-middle ml-2"></i>
                </button>
            </form>

            <!-- Opsi Tambahan -->
            <div class="text-center">
                <p class="text-gray-700">Belum punya akun? <a href="{{ url('register') }}" class="text-orange-600 hover:underline">Daftar</a></p>
            </div>
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