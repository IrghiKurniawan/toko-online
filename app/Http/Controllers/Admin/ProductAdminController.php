<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductAdminController extends Controller
{
    public function adminIndex(Request $request)
    {
        $search = $request->query('search');

        $products = Product::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', '%'.$search.'%');
        })->latest()->paginate(10);

        return view('admin.product.index', compact('products', 'search'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|min:3',
            'price' => 'required|numeric|min:100|max:1000000000',
            'stock' => 'required|integer|min:0|max:99999',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'nullable|string|max:2000',
        ], [
            // Custom error messages
            'category_id.required' => 'Pilih kategori produk.',
            'category_id.exists' => 'Kategori tidak valid.',

            'name.required' => 'Nama produk wajib diisi.',
            'name.min' => 'Nama produk minimal 3 karakter.',
            'name.max' => 'Nama produk maksimal 255 karakter.',

            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal Rp 100.',
            'price.max' => 'Harga terlalu besar.',

            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus bilangan bulat.',
            'stock.min' => 'Stok tidak boleh minus.',
            'stock.max' => 'Stok terlalu besar.',

            'image.required' => 'Gambar produk wajib diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus: jpeg, png, jpg, gif, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',

            'description.max' => 'Deskripsi maksimal 2000 karakter.',
        ]);

        // Upload image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/products', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $path,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.product')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.product.edit', compact('products', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|min:3',
            'price' => 'required|numeric|min:100|max:1000000000',
            'stock' => 'required|integer|min:0|max:99999',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'nullable|string|max:2000',
        ], [
            // Custom error messages
            'category_id.required' => 'Pilih kategori produk.',
            'category_id.exists' => 'Kategori tidak valid.',

            'name.required' => 'Nama produk wajib diisi.',
            'name.min' => 'Nama produk minimal 3 karakter.',
            'name.max' => 'Nama produk maksimal 255 karakter.',

            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal Rp 100.',
            'price.max' => 'Harga terlalu besar.',

            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus bilangan bulat.',
            'stock.min' => 'Stok tidak boleh minus.',
            'stock.max' => 'Stok terlalu besar.',

            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus: jpeg, png, jpg, gif, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',

            'description.max' => 'Deskripsi maksimal 2000 karakter.',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ];

        // Update image if new one uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $request->file('image')->store('images/products', 'public');
            $data['image'] = $path;
        }

        $product->update($data);

        return redirect()->route('admin.product')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Cek apakah produk masih ada di keranjang atau pesanan
        // (opsional, tergantung kebutuhan)

        // Delete image from storage if exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.product')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
