<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Boxicons CDN -->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex">
        <aside class="w-64 min-h-screen p-6 pl-0 rounded-r-xl fixed left-0 top-0 hidden md:block">
            <h2 class="text-2xl py-4 font-semibold text-center mb-12 text-blue-800">
                <span class="text-4xl">
                    <i class='bx bxl-mailchimp'></i>
                </span>
                Hi {{ explode(' ', auth()->user()->name)[0] }}!
            </h2>
            <ul class="space-y-4">
                <li class="group">
                    <a href="{{ route('home') }}" class="flex items-center py-2 px-10 text-lg text-blue-800 shadow-md hover:text-white hover:bg-blue-600 rounded-r-3xl transition-all duration-300 transform -translate-x-4 hover:-translate-x-1">
                        <i class="bx bx-home text-xl mr-3"></i>
                        <span class="group-hover:inline">Home</span>
                    </a>
                </li>
                <hr class="border-t-2 my-4">
                <li class="group">
                    <a href="{{ route('seller.dashboard') }}" class="flex items-center py-2 px-10 text-lg text-blue-800 shadow-md hover:text-white hover:bg-blue-600 rounded-r-3xl transition-all duration-300 transform -translate-x-4 hover:-translate-x-1">
                        <i class="bx bx-home text-xl mr-3"></i>
                        <span class="group-hover:inline">Dashboard</span>
                    </a>
                </li>
                <li class="group hover:text-white">
                    <a href="{{ route('seller.orders.index') }}" class="flex items-center py-2 px-10 text-lg text-blue-800 shadow-md hover:text-white hover:bg-blue-600 rounded-r-3xl transition-all duration-300 transform -translate-x-4 hover:-translate-x-1">
                        <i class="bx bx-cart text-xl mr-3"></i>
                        <span class="group-hover:inline">Pesanan</span>
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('seller.products.index') }}" class="flex items-center py-2 px-10 text-lg text-blue-800 shadow-md hover:text-white hover:bg-blue-600 rounded-r-3xl transition-all duration-300 transform -translate-x-4 hover:-translate-x-1">
                        <i class="bx bx-heart text-xl mr-3"></i>
                        <span class="group-hover:inline">Produk</span>
                    </a>
                </li>
                <br>
                <hr class="border-t-2 border-gray-300 my-4">
                <br>
                <li class="group">
                    <a href="{{ route('auth.settings') }}" class="flex items-center py-2 px-10 text-lg text-green-400 shadow-md hover:text-white hover:bg-green-600 rounded-r-3xl transition-all duration-300 transform -translate-x-4 hover:-translate-x-1">
                        <i class="bx bx-user text-xl mr-3"></i>
                        <span class="group-hover:inline">Settings</span>
                    </a>
                </li>
                <li class="group">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center w-full py-2 px-10 text-lg text-red-400 shadow-md hover:text-white hover:bg-red-600 rounded-r-3xl transition-all duration-300 transform -translate-x-4 hover:-translate-x-1">
                            <i class="bx bx-log-out text-xl mr-3"></i>
                            <span class="group-hover:inline">Logout</span>
                        </button>
                    </form>
                </li>
                
            </ul>
            
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 ml-0 md:ml-64">
            @yield('content')
        </main>
    </div>

</body>
</html>
