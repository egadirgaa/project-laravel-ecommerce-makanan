<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <script>
        tailwind.config = {
            darkMode: 'class',
        };
    </script>

    <title>Keranjang Belanja</title>
</head>
<body class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 transition-colors duration-300">
    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Keranjang Belanja</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ route('allmenu') }}" class="text-blue-500 hover:underline dark:text-blue-400">Kembali ke Menu</a>
                <button id="theme-toggle" class="flex items-center text-gray-800 dark:text-gray-200 px-4 py-2 rounded">
                    <i id="theme-icon" class="bx bx-sun text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Navbar -->
    <nav class="bg-gray-200 dark:bg-gray-700 p-4">
        <div class="max-w-7xl mx-auto flex justify-around items-center">
            <a href="{{ route('customer.cart.index') }}" class="text-gray-800 dark:text-gray-200 hover:underline">Keranjang</a>
            <a href="{{ route('customer.orders.index', auth()->user()->id ) }}" class="text-gray-800 dark:text-gray-200 hover:underline">Pesanan Saya</a>
            <a href="{{ route('auth.settings') }}" class="text-gray-800 dark:text-gray-200 hover:underline">Pengaturan Profil</a>
            <form action="{{ route('logout') }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" 
                    class="text-sm font-medium text-gray-800 dark:text-gray-200 hover:underline hover:text-red-500 transition duration-200">
                    Logout
                </button>
            </form>
            
        </div>
    </nav>

        <!-- Main Content -->
        <main class="flex-1 ">
            @yield('content')
        </main>
    </div>

</body>
</html>
