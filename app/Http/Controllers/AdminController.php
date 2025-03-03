<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        return view('admin.dashboard', compact('totalProducts'));
    }

    // API untuk mendapatkan total produk secara real-time
    public function getTotalProducts()
    {
        return response()->json(['total' => Product::count()]);
    }
}
