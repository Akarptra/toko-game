<!-- products.index.blade.php -->
<div class="product-list">
    @foreach($products as $product)
        <div class="product-item">
            <h3>{{ $product->nama }}</h3>
            <p>{{ $product->deskripsi }}</p>
            <p>Harga: {{ number_format($product->harga, 0, ',', '.') }}</p>
            <img src="{{ Storage::url($product->foto) }}" alt="{{ $product->nama }}">
        </div>
    @endforeach
</div>

<!-- Pagination -->
{{ $products->links() }}
