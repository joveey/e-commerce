<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // 1. Import Request
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    // 2. Tambahkan Request $request sebagai parameter
    public function history(Request $request) 
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat pesanan.');
        }

        // 3. Bangun query dasar
        $query = $user->orders()->with('items.product')->latest();

        // 4. Ambil status dari URL dan terapkan filter jika ada
        $statusFilter = $request->query('status');
        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        // 5. Gunakan paginate untuk performa yang lebih baik
        $orders = $query->paginate(5); // Menampilkan 5 pesanan per halaman

        return view('orders.history', compact('orders'));
    }
}
