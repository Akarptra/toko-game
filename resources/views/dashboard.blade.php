<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center items-center mb-14 py-2 w-full h-full">
                <!-- Search Bar -->
                <div class="mb-4 w-full">
                    <form method="GET" action="{{ route('dashboard') }}" class="flex w-full max-w-4xl mx-auto">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request()->input('search') }}" 
                            placeholder="Search Game..."
                            class="px-4 py-2 border rounded-md mr-4 flex-grow"
                        />
                        <button type="submit" class="bg-[#C0C0C0] px-6 py-2 font-semibold rounded-md">Search</button>
                    </form>
                </div>
            </div>

            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-xl">List Game</h2>

                @if (Auth::user()->role === 'admin')
                    <!-- Add Product Button -->
                    <a href="{{ 'products' }}">
                        <button class="bg-[#C0C0C0] px-10 py-2 font-semibold rounded-md">Admin Menu</button>
                    </a>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Judul Dashboard -->
                    <h1 class="text-2xl font-semibold text-gray-800 mb-4">
                        @if (Auth::user()->role === 'admin')
                            <span class="text-blue-500">Selamat datang Admin</span>, {{ Auth::user()->name }}
                        @elseif (Auth::user()->role == 'user')
                            <span class="text-green-500">Selamat Datang</span>, {{ Auth::user()->name }}
                        @endif
                    </h1>
                    <!-- Deskripsi atau informasi tambahan -->
                    <p class="text-gray-600 mb-6">
                        Selamat datang di dashboard Anda. Anda bisa melihat berbagai produk yang tersedia di sini.
                    </p>

                    <!-- Daftar Produk -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                        @foreach($products as $product)
                            <div class="bg-white p-4 border rounded-lg shadow-md">
                                <img src="{{ Storage::url($product->foto) fo}}" class="w-full h-48 object-cover rounded-md mb-4" />
                                <div class="my-2">
                                    <p class="font-light text-lg">{{ $product->nama }}</p>
                                    <p class="text-gray-500">Rp. {{ number_format($product->harga) }}</p>
                                </div>

                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('products.buy', $product) }}">
                                        <button class="bg-gray-100 px-10 py-2 font-semibold w-full">Beli</button>
                                    </a>
                                
                                @elseif (Auth::user()->role == 'user')
                                    <a href="{{ route('products.buy', $product) }}">
                                        <button class="bg-gray-100 px-10 py-2 font-semibold w-full">Beli</button>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
