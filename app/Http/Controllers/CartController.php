<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class CartController extends Controller
{
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $cart[$id] = [
            "name" => $product->name,
            "quantity" => isset($cart[$id]) ? $cart[$id]['quantity'] + 1 : 1,
            "price" => $product->price,
            "image" => $product->image,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $user = auth()->user();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        Mail::to($user->email)->send(new InvoiceMail($cart, $user));

        session()->forget('cart');

        return redirect('/')->with('success', 'Checkout berhasil! Invoice telah dikirim ke email.');
    }
    public function checkoutSingle($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();

        // Kirim invoice hanya 1 produk
        Mail::to($user->email)->send(new InvoiceMail([$product], $user));

        return redirect('/')->with('success', 'Checkout berhasil! Invoice dikirim ke email.');
    }

}
