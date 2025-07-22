<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        $categories = \App\Models\Category::all();
        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function landing() 
    {
        $products = Product::all();
        $categories = \App\Models\Category::all();
        return view('landing', compact('products', 'categories'));
    }

    public function byCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();
        return view('products.index', [
            'products' => $products,
            'category' => $category->name
        ]);
    }
}