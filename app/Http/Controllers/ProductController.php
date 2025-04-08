<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk dengan fitur pencarian
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $products = $query->paginate(3); // Menggunakan pagination
        return view('admin.products.index', compact('products'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('admin.products.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'speed' => 'required',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Paket berhasil ditambahkan');
    }

    // Menampilkan detail produk
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Menampilkan form edit produk
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Menyimpan perubahan produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'speed' => 'required',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Paket berhasil diperbarui');
    }

    // Menghapus produk
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Paket berhasil dihapus');
    }
}
