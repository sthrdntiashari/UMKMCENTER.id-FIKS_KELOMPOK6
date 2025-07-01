<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Product; 
use App\Models\Category; 
use Illuminate\Support\Str; 
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Storage; 
class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Untuk saat ini, kita mengarahkan user.products.index ke dashboard user utama.
        // Anda bisa mengubah ini jika Anda ingin halaman terpisah untuk daftar produk UMKM.
        return redirect()->route('user.dashboard');
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori dari database
        return view('dashboard.user.products.create', compact('categories'));
    }
    /**
     * Store a newly created product in storage.
     */
 public function store(Request $request)
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'], // TAMBAHKAN INI UNTUK VALIDASI KATEGORI
            'price' => ['required', 'numeric', 'min:0.01'],
            'image_file' => ['nullable', 'image', 'max:2048'],
            'ecommerce_link' => ['nullable', 'url', 'max:255'],
        ],
        // Custom messages untuk validasi
        [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 255 karakter.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'category_id.required' => 'Kategori produk wajib dipilih.', // Pesan validasi kategori
            'category_id.exists' => 'Kategori yang dipilih tidak valid.', // Pesan validasi kategori
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal 0.01.',
            'image_file.image' => 'File harus berupa gambar (jpg, jpeg, png, bmp, gif, svg, webp).',
            'image_file.max' => 'Ukuran gambar maksimal 2MB.',
            'ecommerce_link.url' => 'Link E-commerce harus berupa URL yang valid.',
        ]);

        // 2. Unggah Gambar (jika ada)
        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('products', 'public'); // Gunakan disk 'public'
        }

        // 3. Buat Entri Produk Baru di Database
        Product::create([
            'user_id' => Auth::id(),
            'category_id' => $validatedData['category_id'], // TAMBAHKAN INI KE PENYIMPANAN
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image_url' => $imagePath ? Storage::url($imagePath) : null,
            'ecommerce_link' => $validatedData['ecommerce_link'],
            'status' => 'pending',
        ]);

        // 4. Redirect dengan Pesan Sukses
        return redirect()->route('user.dashboard')->with('success', 'Produk Anda berhasil diajukan! Menunggu konfirmasi admin.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id) // Gunakan Product $product jika ingin Route Model Binding
    {
        // Karena kita menggunakan except(['show']) di web.php,
        // metode ini tidak akan diakses melalui rute default resource.
        // Jika Anda butuh halaman detail produk user, Anda bisa hapus except(['show'])
        // dan tambahkan logika di sini.
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product) // Pastikan menggunakan Product $product (Route Model Binding)
    {
        // Pastikan produk yang akan diedit adalah milik user yang sedang login
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Pastikan produk hanya bisa diedit jika statusnya 'pending' atau 'rejected'
        if ($product->status === 'approved') {
            return redirect()->route('user.dashboard')->with('error', 'Produk yang sudah terpublikasi tidak bisa diedit secara langsung. Harap hubungi admin jika ada perubahan.');
        }

        $categories = Category::all(); // Ambil semua kategori dari database
        return view('dashboard.user.products.edit', compact('product', 'categories'));
    }

   
    public function update(Request $request, Product $product)
    {
        // Pastikan produk yang akan diupdate adalah milik user yang sedang login
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Pastikan produk hanya bisa diedit jika statusnya 'pending' atau 'rejected'
        if ($product->status === 'approved') {
            return redirect()->route('user.dashboard')->with('error', 'Produk yang sudah terpublikasi tidak bisa diedit secara langsung. Harap hubungi admin jika ada perubahan.');
        }

        // 1. Validasi Data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'], // TAMBAHKAN INI UNTUK VALIDASI KATEGORI
            'price' => ['required', 'numeric', 'min:0.01'],
            'image_file' => ['nullable', 'image', 'max:2048'],
            'ecommerce_link' => ['nullable', 'url', 'max:255'],
        ],
        [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 255 karakter.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'category_id.required' => 'Kategori produk wajib dipilih.', // Pesan validasi kategori
            'category_id.exists' => 'Kategori yang dipilih tidak valid.', // Pesan validasi kategori
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal 0.01.',
            'image_file.image' => 'File harus berupa gambar (jpg, jpeg, png, bmp, gif, svg, webp).',
            'image_file.max' => 'Ukuran gambar maksimal 2MB.',
            'ecommerce_link.url' => 'Link E-commerce harus berupa URL yang valid.',
        ]);

        // 2. Unggah Gambar Baru (jika ada) dan Hapus Gambar Lama
        $imagePath = $product->image_url;
        if ($request->hasFile('image_file')) {
            if ($product->image_url && !Str::contains($product->image_url, 'placeholder.com')) {
                Storage::disk('public')->delete(Str::replaceFirst('/storage/', '', $product->image_url));
            }
            $newImagePath = $request->file('image_file')->store('products', 'public');
            $imagePath = Storage::url($newImagePath);
        }

        // 3. Perbarui Entri Produk di Database
        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'], // TAMBAHKAN INI KE UPDATE
            'price' => $validatedData['price'],
            'image_url' => $imagePath,
            'ecommerce_link' => $validatedData['ecommerce_link'],
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Produk Anda berhasil diperbarui!');
    }
    /**
     * Remove the specified product from storage.
     */
 public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus gambar terkait jika ada dan bukan placeholder
        if ($product->image_url && !Str::contains($product->image_url, 'placeholder.com')) {
            // UBAH BARIS INI: Pastikan penghapusan menggunakan disk 'public'
            Storage::disk('public')->delete(Str::replaceFirst('/storage/', '', $product->image_url));
        }

        $product->delete();

        return redirect()->route('user.dashboard')->with('success', 'Produk Anda berhasil dihapus!');
    }
}