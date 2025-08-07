<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class CartController extends Controller
{
    // ... (method add, update, remove, index, dan showCheckout Anda tetap sama) ...
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk menambahkan ke keranjang.');
        }

        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart = $user->cart()->firstOrCreate();
        $cartItem = $cart->items()->where('product_id', $id)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Jumlah total melebihi stok tersedia.');
            }
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, $itemId)
    {
        $item = CartItem::findOrFail($itemId);
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }
        $quantity = max(1, (int) $request->input('quantity'));
        if ($quantity > $item->product->stock) {
            return back()->with('error', 'Jumlah melebihi stok tersedia.');
        }
        $item->quantity = $quantity;
        $item->save();
        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function remove($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }
        $item->delete();
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat keranjang.');
        }
        $cart = $user->cart;
        $items = $cart ? $cart->items()->with('product')->get() : collect();
        return view('cart.index', compact('cart', 'items'));
    }

    public function showCheckout()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk checkout.');
        }

        if (empty($user->address)) {
            return redirect()->route('profile.edit')->with('error', 'Alamat pengiriman Anda masih kosong. Silakan lengkapi profil Anda terlebih dahulu.');
        }

        $cart = $user->cart()->with('items.product')->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $items = $cart->items;
        $subtotal = $items->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $shippingCost = 15000; 
        $total = $subtotal + $shippingCost;

        return view('checkout.index', compact('user', 'items', 'subtotal', 'shippingCost', 'total'));
    }

    public function processCheckout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Sesi Anda berakhir, silakan login kembali.');
        }

        $cart = $user->cart()->with('items.product')->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $totalPrice = 0;

        $order = $user->orders()->create([
            'total_price' => 0,
            'pesan' => $request->input('pesan')
        ]);

        foreach ($cart->items as $item) {
            $product = $item->product;
            if ($product->stock < $item->quantity) {
                $order->delete(); 
                return redirect()->route('cart.index')->with('error', "Stok tidak cukup untuk {$product->name}");
            }
            $product->stock -= $item->quantity;
            $product->save();
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $item->quantity,
                'price' => $product->price,
            ]);
            $totalPrice += $product->price * $item->quantity;
        }

        $shippingCost = 15000;
        $finalTotal = $totalPrice + $shippingCost;
        $order->update(['total_price' => $finalTotal]);

        // ## PERUBAHAN DI SINI: Mengirim objek $order yang lengkap ##
        $order->load('user', 'items.product'); // Memuat relasi
        Mail::to($user->email)->send(new InvoiceMail($order));

        $cart->items()->delete();

        return redirect('/')->with('success', 'Checkout berhasil! Invoice telah dikirim ke email Anda.');
    }

    public function checkoutSingle($id)
    {
        $product = Product::findOrFail($id);
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk checkout.');
        }
        if (empty($user->address)) {
            return redirect()->route('profile.edit')->with('error', 'Alamat pengiriman Anda masih kosong. Silakan lengkapi profil Anda terlebih dahulu.');
        }
        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $product->stock -= 1;
        $product->save();
        $order = $user->orders()->create(['total_price' => $product->price]);
        $order->items()->create([
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        // ## PERUBAHAN DI SINI: Mengirim objek $order yang lengkap ##
        $order->load('user', 'items.product'); // Memuat relasi
        Mail::to($user->email)->send(new InvoiceMail($order));

        return redirect('/')->with('success', 'Checkout berhasil! Invoice dikirim ke email.');
    }

    public function updateAjax(Request $request, $itemId)
    {
        $item = CartItem::findOrFail($itemId);
        if ($item->cart->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        $quantity = max(1, (int) $request->input('quantity'));
        if ($quantity > $item->product->stock) {
            $quantity = $item->product->stock;
        }
        $item->quantity = $quantity;
        $item->save();
        $subtotal = $item->product->price * $item->quantity;
        return response()->json([
            'success' => true,
            'quantity' => $item->quantity,
            'subtotal_formatted' => number_format($subtotal, 0, ',', '.')
        ]);
    }
}
