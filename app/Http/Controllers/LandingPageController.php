<?php

namespace App\Http\Controllers;

use App\Models\Product;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(8)->get(); // tampilkan 8 produk terakhir
        return view('landing', compact('products'));
    }
}
