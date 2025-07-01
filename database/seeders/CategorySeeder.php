<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Illuminate\Support\Str; // Tambahkan ini

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Makanan & Minuman',
            'Fashion',
            'Kerajinan',
        ];

        foreach ($categories as $categoryName) {
            DB::table('categories')->insert([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName), // Membuat slug dari nama kategori
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}