<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex mt-6 mb-6 items-center justify-between">
            <h2 class="font-semibold text-xl">Information Game</h2>
        </div>
        <div class="mt-4" x-data="{ imageUrl: '{{ Storage::url($product->foto) ?? '/noimage.png' }}', showModal: false }">
            <div class="flex gap-8">
                <div class="w-1/2">
                    <img :src="imageUrl" class="rounded-md" alt="Product Image" />
                </div>

                <div class="w-1/2">
                    <!-- Nama -->
                    <div>
                        <x-input-label for="nama" :value="__('Name')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="$product->nama" readonly />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <!-- Harga -->
                    <div class="mt-4">
                        <x-input-label for="harga" :value="__('Price')" />
                        <x-text-input id="harga" class="block mt-1 w-full" type="text" name="harga" :value="$product->harga" readonly />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-4">
                        <x-input-label for="deskripsi" :value="__('Description')" />
                        <x-text-area id="deskripsi" class="block mt-1 w-full" name="deskripsi" readonly>{{ $product->deskripsi }}</x-text-area>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <!-- Tombol untuk memunculkan modal -->
                    <x-primary-button @click="showModal = true" class="justify-center mt-4">
                        {{ __('Purchase') }}
                    </x-primary-button>

                    <!-- Modal Pembelian -->
                    <div x-show="showModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                            <h3 class="text-xl font-semibold mb-4">Confirm Purchase</h3>
                            <p><strong>Name:</strong> {{ $product->nama }}</p>
                            <p><strong>Price:</strong> {{ number_format($product->harga, 0, ',', '.') }}</p>
                            <p><strong>Description:</strong> {{ $product->deskripsi }}</p>

                            <!-- Formulir untuk konfirmasi pembelian -->
                            <form method="POST" action="{{ route('products.confirmBuy', $product) }}">
                                @csrf
                                <div class="mt-4 flex justify-end gap-4">
                                    <!-- Tombol cancel untuk menutup modal -->
                                    <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                                    <!-- Tombol konfirmasi pembelian -->
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Confirm Purchase</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
