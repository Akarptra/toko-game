<!-- resources/views/welcome.blade.php -->
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center items-center mb-14 py-2 w-full h-full">
                <!-- Search Bar -->
                <div class="mb-4 w-full">
                    <form method="GET" action="{{ route('welcome') }}" class="flex w-full max-w-4xl mx-auto">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request()->input('search') }}" 
                            placeholder="Search Produk..."
                            class="px-4 py-2 border rounded-md mr-4 flex-grow"
                        />
                        <button type="submit" class="bg-[#C0C0C0] px-6 py-2 font-semibold rounded-md">Search</button>
                    </form>
                </div>
            </div>

            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-xl">List Produk</h2>
                @auth
                    <a href="{{ route('products.index') }}">
                        <button class="bg-[#C0C0C0] px-10 py-2 font-semibold rounded-md">Lihat Produk</button>
                    </a>
                @endauth
            </div>

            <!-- Modal Alert Box -->
            <div x-data="{ open: true }" x-show="open" x-cloak>
                <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
                    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl w-full relative">
                        <!-- Close Button -->
                        <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        <!-- Content -->
                        <div class="text-center">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                                @auth
                                    Selamat datang di Toko-Game, {{ Auth::user()->name }}!
                                @else
                                    Selamat datang di Toko-Game, Pengunjung!
                                @endauth
                            </h2>
                            <p class="text-lg text-gray-600 mb-4">
                                Toko-Game adalah tempat dimana anda akan menemukan game yang lengkap dengan harga yang murah
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                @copyright10122232
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Judul -->
                    <h1 class="text-2xl font-semibold text-gray-800 mb-4">
                        @auth
                            Selamat datang di Toko Kami, {{ Auth::user()->name }}
                        @else
                            Selamat datang di Toko Kami, Pengunjung
                        @endauth
                    </h1>

                    <!-- Deskripsi atau informasi tambahan -->
                    <p class="text-gray-600 mb-6">
                        Temukan produk terbaik di sini. Silakan cari produk yang Anda inginkan.
                    </p>

                    <!-- Daftar Produk -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                        @foreach($products as $product)
                            <div class="bg-white p-4 border rounded-lg shadow-md">
                                <img src="{{ Storage::url($product->foto) }}" class="w-full h-48 object-cover rounded-md mb-4" />
                                <div class="my-2">
                                    <p class="font-light text-lg">{{ $product->nama }}</p>
                                    <p class="text-gray-500">Rp. {{ number_format($product->harga) }}</p>
                                </div>

                                <!-- Tombol Beli -->
                                @auth
                                    <a href="{{ route('products.buy', $product) }}">
                                        <button class="bg-gray-100 px-10 py-2 font-semibold w-full">Beli</button>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}">
                                        <button class="bg-gray-100 px-10 py-2 font-semibold w-full">Beli</button>
                                    </a>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
