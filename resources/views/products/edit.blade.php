<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex mt-6 mb-6 items-center justify-between">
            <h2 class="font-semibold text-xl">Edit Product</h2>
            @include('products.partials.delete-product')
        </div>
        <div class="mt-4" x-data="{ imageUrl: '{{ Storage::url($product->foto) ?? '/noimage.png' }}' }">
            <form enctype="multipart/form-data" method="post" action="{{ route('products.update', $product) }}" class="flex gap-8">
                @csrf
                @method('PUT')

                <div class="w-1/2">
                    <!-- Menampilkan gambar yang ada jika ada -->
                    <img :src="imageUrl" class="rounded-md" alt="Product Image" />
                </div>
                <div class="w-1/2">
                    <!-- Foto -->
                    <div>
                        <x-input-label for="foto" :value="__('Photo')" />
                        <x-text-input accept="image/*" id="foto" class="block mt-1 w-full border p-2" type="file" name="foto" 
                            :value="$product->foto" 
                            @change="imageUrl = URL.createObjectURL($event.target.files[0])"/>
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>

                    <!-- Nama -->
                    <div>
                        <x-input-label for="nama" :value="__('Name')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="$product->nama" required />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <!-- Harga -->
                    <div class="mt-4">
                        <x-input-label for="harga" :value="__('Price')" />
                        <x-text-input id="harga" class="block mt-1 w-full" type="text" name="harga" :value="$product->harga"
                        x-mask:dynamic="$money($input, ',')" required />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-4">
                        <x-input-label for="deskripsi" :value="__('Description')" />
                        <x-text-area id="deskripsi" class="block mt-1 w-full" type="text" name="deskripsi" :value="$product->deskripsi">{{ old('deskripsi', $product->deskripsi) }}</x-text-area>
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
