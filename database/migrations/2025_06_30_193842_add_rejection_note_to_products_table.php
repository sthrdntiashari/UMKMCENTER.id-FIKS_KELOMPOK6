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
            // Menambahkan kolom 'rejection_note' sebagai string yang bisa kosong (nullable)
            // Setelah kolom 'status'
            $table->text('rejection_note')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Menghapus kolom 'rejection_note' jika migrasi di-rollback
            $table->dropColumn('rejection_note');
        });
    }
};