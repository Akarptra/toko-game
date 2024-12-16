<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;  // Tambahkan ini
use Illuminate\Support\Facades\Storage;
use App\Models\Report;


class ProductController extends Controller
{
    // Gunakan trait ValidatesRequests
    use ValidatesRequests;

    public function index(Request $request)
    {
        // Ambil input pencarian dari form
        $search = $request->input('search');

        // Jika ada keyword pencarian, cari produk yang sesuai
        if ($search) {
            // Lakukan pencarian berdasarkan nama produk
            $products = Product::where('nama', 'like', '%' . $search . '%')->paginate(12);
        } else {
            // Jika tidak ada pencarian, tampilkan semua produk dengan pagination
            $products = Product::paginate(12);
        }

        // Kembalikan view dengan data produk
        return view('products.index', compact('products'));
        return view('dashboard', compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric', // Pastikan harga berupa angka
            'deskripsi' => 'required|string|max:1000',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240', // Maks 10MB
        ]);
    
        // Upload gambar

        $imagePath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('image/products', $fileName, env('FILESYSTEM_DISK', 's3'));
        }
        
       
        // Simpan data ke database
        Product::create([
            'nama' => $request->nama,
            'harga' => str_replace(".", "", $request->harga),
            'deskripsi' => $request->deskripsi,
            'foto' => $imagePath,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }
    

    public function edit(Product $product){
        return view('products.edit', compact('product'));
    }
    

public function update(Request $request, Product $product)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'harga' => 'required|numeric', // Pastikan harga berupa angka
        'deskripsi' => 'required|string|max:1000',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // Foto opsional, bisa kosong
    ]);

    // Update nama, harga, dan deskripsi
    $product->nama = $request->nama;
    $product->harga = str_replace(".", "", $request->harga); // Menghapus titik pada harga
    $product->deskripsi = $request->deskripsi;

    // Cek apakah ada file foto yang di-upload
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($product->foto) {
            if($product->foto !== "noimage.png"){
                Storage::disk('s3')->delete($product->foto);
            }
        }

        // Upload foto baru
        $foto = $request->file('foto');
        $fotoPath = $foto->store('image/products', 's3'); // Simpan foto baru ke AWS S3

        // Update foto di database
        $product->foto = $fotoPath;
    }

    // Simpan perubahan produk ke database
    $product->save(); // Gunakan `save()` karena kita sudah memodifikasi objek produk sebelumnya

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
}



    
public function destroy(Product $product){
    // Hapus foto jika bukan foto default
    if($product->foto !== "noimage.png"){
        Storage::disk('local')->delete('public/' . $product->foto);
    }

    // Hapus produk dari database
    $product->delete();
    
    // Redirect dengan pesan sukses
    return redirect()->route('products.index')->with('success', 'Delete Product Success');
}


    public function buy(Product $product)
    {
        // Simpan data pembelian ke tabel laporan
        Report::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'harga' => $product->harga,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Produk berhasil dibeli!');
    }
    
    public function showBuyPage(Product $product)
    {
        return view('buy', compact('product'));
    }

    // ProductController.php
    public function showWelcomePage(Request $request)
    {
        // Ambil input pencarian dari form
        $search = $request->input('search');

        // Jika ada keyword pencarian, cari produk yang sesuai
        if ($search) {
            // Lakukan pencarian berdasarkan nama produk
            $products = Product::where('nama', 'like', '%' . $search . '%')->get();
        } else {
            // Jika tidak ada pencarian, tampilkan semua produk
            $products = Product::all();
        }

        // Kirim data produk ke tampilan 'welcome'
        return view('welcome', compact('products'));
    }
        




}

