@extends(auth()->user()->role === 'seller' ? 'layouts.seller' : 'layouts.customer')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md  mt-2">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pengaturan Akun</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('/settings') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-gray-700 ">Nama</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" required
                    class="w-full mt-2 p-2 border border-gray-300  rounded-md focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" required
                    class="w-full mt-2 p-2 border border-gray-300  rounded-md focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6 relative">
                <label for="phone" class="block text-sm font-semibold text-gray-700">Nomor Telepon</label>
                <div class="flex items-center mt-2">
                    <input type="number" name="phone" id="phone" value="{{ Auth::user()->phone ?? '' }}" readonly
                        class="w-full p-2 border border-gray-300 rounded-l-md focus:ring-2 focus:ring-blue-500">
                        <button type="button" id="toggle-phone-edit" 
                        class=" px-4 flex items-center justify-center rounded-r-md transition">
                        <i class='bx bx-lock text-xl'></i>
                    </button>
                </div>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-700 ">Password Baru</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password baru"
                    class="w-full mt-2 p-2 border border-gray-300  rounded-md focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 ">Konfirmasi
                    Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Konfirmasi password baru"
                    class="w-full mt-2 p-2 border border-gray-300  rounded-md focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/modegt.js') }}"></script>
    <script>
        document.getElementById('toggle-phone-edit').addEventListener('click', function () {
            const phoneInput = document.getElementById('phone');
            const icon = this.querySelector('i');
            
            if (phoneInput.hasAttribute('readonly')) {
                phoneInput.removeAttribute('readonly');
                icon.classList.replace('bx-lock', 'bx-lock-open');
            } else {
                phoneInput.setAttribute('readonly', true);
                icon.classList.replace('bx-lock-open', 'bx-lock');
            }
        });
    </script>
@endsection
