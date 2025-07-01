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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan produk ke user (UMKM)
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // Harga, 10 digit total, 2 di belakang koma
            $table->string('image_url')->nullable(); // URL gambar produk
            $table->string('ecommerce_link')->nullable(); // Link ke e-commerce
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status konfirmasi admin
            $table->timestamps(); // created_at dan updated_at
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