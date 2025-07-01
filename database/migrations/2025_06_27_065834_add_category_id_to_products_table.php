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
        Schema::table('products', function (Blueprint $table) {
            // Tambahkan kolom category_id
            $table->foreignId('category_id')
                  ->nullable() // Izinkan null sementara, jika ada produk lama tanpa kategori
                  ->after('user_id') // Tempatkan setelah kolom user_id
                  ->constrained() // Buat foreign key ke tabel categories
                  ->onDelete('set null'); // Jika kategori dihapus, set category_id produk jadi null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Hapus foreign key sebelum menghapus kolom
            $table->dropForeign(['category_id']);
            // Hapus kolom category_id
            $table->dropColumn('category_id');
        });
    }
};