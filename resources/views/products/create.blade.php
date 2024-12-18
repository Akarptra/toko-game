<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>


<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex mt-6 mb-6 items-center justify-between">
            <h2 class="font-semibold text-xl">Add Product</h2>
        </div>
        <div class="mt-4" x-data="{ imageUrl: '/noimage.png' }">
            <form enctype="multipart/form-data" method="post" action="{{ route('products.store') }}" class="flex gap-8">
                @csrf

            <div class="w-1/2">
                <img :src="imageUrl" class="rounded-md"/>
            </div>
            <div class="w-1/2">
                <!-- foto -->
                <div>
                    <x-input-label for="foto" :value="__('Photo')" />
                    <x-text-input accept="jpg.jpeg.png" id="foto" class="block mt-1 w-full border p-2" type="file" name="foto" :value="old('foto')" required 
                    @change="imageUrl = URL.createObjectURL($event.target.files[0])"/>
                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                </div>
                <!-- Nama -->
                <div>
                    <x-input-label for="nama" :value="__('Name')" />
                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                    <!-- Harga -->
                    <div class="mt-4">
                    <x-input-label for="harga" :value="__('Price')" />
                    <x-text-input id="harga" class="block mt-1 w-full" type="text" name="harga" :value="old('harga')" 
                    x-mask:dynamic="$money($input, ',')" required />
                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                </div>

                <!-- Deskripsi -->
                <div class="mt-4">
                    <x-input-label for="deskripsi" :value="__('Description')" />
                    <x-text-area id="deskripsi" class="block mt-1 w-full" type="text" name="deskripsi" :value="old('deskripsi')" />
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                </div>
                
                <x-primary-button class="justify-center mt-4">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
            </form>
        </div>
    </div>
</x-app-layout>
