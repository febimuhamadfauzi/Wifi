<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Article;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $articles = Article::all();

        return view('index', compact('products', 'articles'));
    }
}
