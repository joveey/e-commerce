<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User; // <--- Make sure you import the User model!

class OrderController extends Controller
{
    public function history()
    {
        /** @var \App\Models\User $user */ // <--- Add this type hint
        $user = auth()->user();

        if (!$user) {
            // Optional: Handle case where user is not logged in, similar to CartController
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat pesanan.');
        }

        // Intelephense will now understand $user is an App\Models\User and has an orders() method
        $orders = $user->orders()->with('items.product')->latest()->get();

        return view('orders.history', compact('orders'));
    }
}
