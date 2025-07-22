<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function landing() 
    {
        $products = Product::all();
        return view('landing', compact('products'));
    }

    public function byCategory($category)
    {
        $products = Product::where('category', $category)->get();
        return view('products.index', compact('products', 'category'));
    }
}