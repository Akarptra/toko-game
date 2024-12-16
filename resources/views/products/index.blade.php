<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
        @if(session()->has('success'))
            <x-alert message="{{ session('success') }}"/>
        @endif
        
        <div class="flex justify-center items-center mb-6 py-14 w-full h-full">
            <!-- Search Form -->
            <form method="GET" action="{{ route('products.index') }}" class="flex w-full max-w-4xl"> <!-- Menambahkan max-w-4xl untuk lebar maksimal -->
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search Product..." 
                    class="px-4 py-2 border rounded-md mr-4 w-[700px]" <!-- Membuat input lebih lebar -->
                <button type="submit" class="bg-[#C0C0C0] px-10 py-2 font-semibold rounded-md">Search</button>
            </form>
        </div>


        <!-- Search Bar -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl">List Game</h2>
            
            
            
            <!-- Add Product Button -->
            @if (Auth::user()->role === 'admin')
            <a href="{{ route('products.create') }}">
                <button class="bg-[#C0C0C0] px-10 py-2 font-semibold rounded-md">Add Product</button>
            </a>
            @endif
        </div>

        <!-- Product List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @foreach($products as $product)
                <div class="bg-white p-4 border rounded-lg shadow-md">
                    <img src="{{ Storage::url($product->foto) }}" class="w-full h-48 object-cover rounded-md mb-4" />
                    <div class="my-2">
                        <p class="font-light text-lg">{{ $product->nama }}</p>
                        <p class="text-gray-500">Rp. {{ number_format($product->harga) }}</p>
                    </div>
                    @if (Auth::user()->role === 'admin')
                    <a href="{{ route('products.edit', $product) }}">
                        <button class="bg-gray-100 px-10 py-2 font-semibold w-full">Edit</button>
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
</x-app-layout>
