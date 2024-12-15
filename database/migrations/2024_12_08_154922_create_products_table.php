<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');  // Pastikan kolom 'nama' ada di sini
            $table->integer('harga');  // Pastikan tipe data harga sesuai
            $table->text('deskripsi');  // Pastikan kolom deskripsi ada
            $table->string('foto')->default('noimage.png');  // Pastikan kolom deskripsi ada
            $table->timestamps();  // Kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
