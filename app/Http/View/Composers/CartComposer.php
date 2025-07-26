<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart; // Kita akan gunakan Model Cart Anda

class CartComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Nilai default jika user tidak login atau keranjang kosong
        $cartItemCount = 0;

        // Cek dulu apakah user sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // Cari keranjang (cart) milik user yang sedang login.
            // Ini mengasumsikan ada relasi 'cart' di model User Anda.
            $cart = $user->cart;

            // Jika keranjang ditemukan
            if ($cart) {
                // Hitung JUMLAH TOTAL KUANTITAS item di dalam keranjang.
                // Ini mengasumsikan ada relasi 'cartItems' di model Cart Anda
                // dan ada kolom 'quantity' di tabel cart_items.
                $cartItemCount = $cart->items()->sum('quantity');
            }
        }

        // Kirim variabel $cartItemCount ke semua view
        $view->with('cartItemCount', $cartItemCount);
    }
}