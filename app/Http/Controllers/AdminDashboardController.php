<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CartItem;
use App\Models\Order; // Pastikan model Order di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $users = User::select('id', 'name')->get();
        $cartItems = CartItem::with(['product', 'cart.user'])->get();

        // Ambil data penjualan bulan ini
        $salesThisMonth = CartItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('product_id')
            ->with('product')
            ->get();

        // Ambil nama produk & jumlah
        $productNames = $salesThisMonth->pluck('product.name');
        $quantities = $salesThisMonth->pluck('total_quantity');

        return view('admin.dashboard', [
            'userCount' => $userCount,
            'users' => $users,
            'cartItems' => $cartItems,
            'productNames' => $productNames,
            'quantities' => $quantities,
        ]);
    }

    public function orders()
    {
        // --- QUERY BARU UNTUK MENGATASI MASALAH ---

        // 1. Ambil semua ID user yang memiliki pesanan aktif
        $activeOrderUserIds = Order::where('status', '!=', 'completed')
                                    ->pluck('user_id')
                                    ->unique();

        // 2. Ambil data user berdasarkan ID tersebut, lalu paginasi
        $usersWithActiveOrders = User::whereIn('id', $activeOrderUserIds)
            ->with(['orders' => function ($query) {
                // Eager load HANYA pesanan yang aktif untuk setiap user
                $query->where('status', '!=', 'completed')
                    ->with('items.product')
                    ->latest();
            }])
            ->paginate(20);

        return view('admin.orders.index', compact('usersWithActiveOrders'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed'
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}