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

        // Cek apakah stok mencukupi
        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Stok produk habis.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Cek apakah penambahan tidak melebihi stok
            if ($cart[$id]['quantity'] + 1 > $product->stock) {
                return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia.');
            }

            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
            ];
        }

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

        // Kurangi stok
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                if ($product->stock < $item['quantity']) {
                    return redirect()->route('cart.index')->with('error', 'Stok tidak mencukupi untuk produk ' . $product->name);
                }
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        // Kirim email
        Mail::to($user->email)->send(new InvoiceMail($cart, $user));

        // Kosongkan keranjang
        session()->forget('cart');

        return redirect('/')->with('success', 'Checkout berhasil! Invoice telah dikirim ke email.');
    }

    public function checkoutSingle($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();

        // Cek stok
        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Kurangi stok
        $product->stock -= 1;
        $product->save();

        // Kirim invoice satu produk (bisa dijadikan array)
        $item = [
            $product->id => [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
            ]
        ];

        Mail::to($user->email)->send(new InvoiceMail($item, $user));

        return redirect('/')->with('success', 'Checkout berhasil! Invoice dikirim ke email.');
    }
}
