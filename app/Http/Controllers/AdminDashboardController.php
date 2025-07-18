<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CartItem;
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
        $orders = \App\Models\Order::with(['items.product', 'user'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10); // paginate agar tidak berat
        return view('admin.users.index', compact('users'));
    }
}
