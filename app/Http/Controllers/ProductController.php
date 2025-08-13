<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductRating; // 1. Import model ProductRating
use Illuminate\Http\Request;
use Illuminate\Support\Str; // 2. Import Str helper

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

        // 3. Tambahkan query untuk mengambil ulasan terbaik
        $topReviews = ProductRating::where('rating', 5)
            ->with(['user', 'product']) // Mengambil info user & produk terkait
            ->latest()                  // Mengurutkan dari yang terbaru
            ->take(3)                   // Membatasi hanya 3 ulasan
            ->get();

        // 4. Kirim variabel $topReviews ke view
        return view('landing', compact('products', 'categories', 'topReviews'));
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
    
    public function search(Request $request)
    {
        // Validasi input, pastikan ada query yang dikirim
        $request->validate([
            'query' => 'required|string|min:2',
        ]);

        $query = $request->input('query');

        // Lakukan pencarian di database pada kolom 'name' dan 'description'
        $products = Product::where('name', 'LIKE', "%{$query}%")
                           ->orWhere('description', 'LIKE', "%{$query}%")
                           ->paginate(10); // Gunakan paginate untuk hasil yang banyak

        // Kirim hasil ke view baru
        return view('products.search-results', compact('products', 'query'));
    }
}
