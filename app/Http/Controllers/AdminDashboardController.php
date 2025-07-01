<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category; // Pastikan ini ada
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada
use Illuminate\Validation\Rule; // Pastikan ini ada

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil semua produk dengan status 'pending' (menunggu konfirmasi)
        $pendingProducts = Product::where('status', 'pending')->get();

        // Ambil semua produk (termasuk yang approved, pending, rejected)
        $allProducts = Product::all();

        // Anda bisa menambahkan data lain yang relevan untuk ringkasan admin di sini, contoh:
        $totalUsers = User::count(); // Jumlah total user terdaftar
        $totalApprovedProducts = Product::where('status', 'approved')->count(); // Jumlah produk terpublikasi

        return view('dashboard.admin.index', compact(
            'pendingProducts',
            'allProducts',
            'totalUsers',
            'totalApprovedProducts'
        ));
    }

    public function show(Product $product)
    {
        // Untuk melihat detail produk oleh admin
        return view('dashboard.admin.products.show', compact('product'));
    }

    public function approve(Request $request, Product $product)
    {
        // Pastikan admin bisa melakukan aksi ini (sudah dihandle oleh middleware 'admin')

        // Validasi catatan penolakan (opsional, bisa kosong)
        $request->validate([
            'rejection_note' => 'nullable|string|max:1000',
        ]);

        $product->status = 'approved';
        $product->rejection_note = null; // Hapus catatan penolakan jika disetujui
        $product->save();
        return redirect()->back()->with('success', 'Produk berhasil disetujui dan akan ditampilkan ke publik!');
    }

    public function reject(Request $request, Product $product)
    {
        // Pastikan admin bisa melakukan aksi ini (sudah dihandle oleh middleware 'admin')

        // Validasi catatan penolakan (opsional, bisa kosong)
        $request->validate([
            'rejection_note' => 'nullable|string|max:1000',
        ]);

        $product->status = 'rejected';
        $product->rejection_note = $request->rejection_note; // SIMPAN CATATAN PENOLAKAN
        $product->save();
        return redirect()->back()->with('error', 'Produk telah ditolak.');
    }

    /**
     * Display a list of all products for admin management.
     */
    public function allProductsIndex()
    {
        $products = Product::all(); // Mengambil semua produk. Bisa juga Product::paginate(15); untuk paginasi.
        return view('dashboard.admin.products.index_all', compact('products'));
    }

    /**
     * Show the form for editing a product by admin.
     */
    public function editManagedProduct(Product $product)
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('dashboard.admin.products.edit_managed', compact('product', 'categories'));
    }

    /**
     * Update a product by admin.
     */
    public function updateManagedProduct(Request $request, Product $product)
    {
        // Admin bisa mengubah status dan juga catatan penolakan
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'image_file' => ['nullable', 'image', 'max:2048'], // 'nullable' untuk update
            'ecommerce_link' => ['nullable', 'url', 'max:255'],
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])], // Admin bisa mengubah status
            'rejection_note' => ['nullable', 'string', 'max:1000'],
        ],
        [
            'name.required' => 'Nama produk wajib diisi.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'image_file.image' => 'File harus berupa gambar.',
            'image_file.max' => 'Ukuran gambar maksimal 2MB.',
            'ecommerce_link.url' => 'Link E-commerce harus berupa URL yang valid.',
            'status.required' => 'Status produk wajib dipilih.',
            'status.in' => 'Status produk tidak valid.',
        ]);

        $imagePath = $product->image_url;
        if ($request->hasFile('image_file')) {
            // Hapus gambar lama jika ada dan bukan placeholder
            if ($product->image_url && !Str::contains($product->image_url, 'placeholder.com')) {
                Storage::disk('public')->delete(Str::replaceFirst('/storage/', '', $product->image_url));
            }
            $newImagePath = $request->file('image_file')->store('products', 'public');
            $imagePath = Storage::url($newImagePath);
        }

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'price' => $validatedData['price'],
            'image_url' => $imagePath,
            'ecommerce_link' => $validatedData['ecommerce_link'],
            'status' => $validatedData['status'],
            'rejection_note' => ($validatedData['status'] === 'rejected') ? $validatedData['rejection_note'] : null,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate oleh admin!');
    }

    /**
     * Remove a product by admin.
     */
    public function destroyManagedProduct(Product $product)
    {
        // Admin menghapus produk dan gambar terkait
        if ($product->image_url && !Str::contains($product->image_url, 'placeholder.com')) {
            Storage::disk('public')->delete(Str::replaceFirst('/storage/', '', $product->image_url));
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus oleh admin!');
    }
}