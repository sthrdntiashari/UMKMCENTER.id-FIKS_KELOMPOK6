<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str; // Pastikan ini ada

class PublicController extends Controller
{
    /**
     * Display the public home page with approved products, optionally filtered by search or category.
     */
     public function index(Request $request)
    {
        // dd($request->all()); // Biarkan ini di-comment dulu

        $query = Product::where('status', 'approved');

        // Filter berdasarkan pencarian (ini sudah berfungsi)
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('user', function ($q2) use ($searchTerm) {
                      $q2->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Filter berdasarkan kategori (ini yang belum berfungsi)
        if ($request->filled('category_slug')) {
            $categorySlug = $request->input('category_slug');

            // dd($categorySlug, $category); // <<< AKTIFKAN BARIS INI (HAPUS // di depannya)

            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            } else {
                $query->whereRaw('0=1');
            }
        }

        $products = $query->with('user', 'category')->paginate(12);
        $categories = Category::all();

        return view('welcome', compact('products', 'categories'));
    }
    /**
     * Display the specified product details publicly.
     */
    public function show(string $id)
    {
        // Cari produk secara manual
        $product = Product::find($id);

        // Jika produk tidak ditemukan, atau statusnya bukan 'approved', alihkan
        if (!$product || $product->status !== 'approved') {
            return redirect()->route('home')->with('error', 'Produk tidak tersedia atau tidak ditemukan.');
        }

        // Jika produk ditemukan dan statusnya 'approved', tampilkan view
        return view('products.show', compact('product'));
    }
}