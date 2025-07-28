<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan data untuk halaman utama dasbor admin.
     */
    public function index()
    {
        // --- 1. DATA UNTUK KARTU STATISTIK ---
        $userCount = User::count();
        
        // ## PERUBAHAN DI SINI ##
        // Menghitung jumlah order dengan status 'pending'
        $pendingOrdersCount = Order::where('status', Order::STATUS_PENDING)->count(); 
        
        $totalProducts = Product::count();
        $monthlyRevenue = Order::where('status', Order::STATUS_COMPLETED)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        // --- 2. DATA UNTUK GRAFIK PENJUALAN & PRODUK TERLARIS ---
        $salesThisMonth = OrderItem::select(
                'product_id', 
                DB::raw('SUM(quantity) as total_quantity_sold')
            )
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', Order::STATUS_COMPLETED)
            ->whereMonth('orders.created_at', now()->month)
            ->whereYear('orders.created_at', now()->year)
            ->groupBy('product_id')
            ->with('product')
            ->orderBy('total_quantity_sold', 'desc')
            ->get();

        $productNames = $salesThisMonth->pluck('product.name');
        $quantities = $salesThisMonth->pluck('total_quantity_sold');
        $topProducts = $salesThisMonth->take(5);

        // --- 3. DATA UNTUK AKTIVITAS TERBARU ---
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // --- 4. MENGIRIM SEMUA DATA KE VIEW ---
        return view('admin.dashboard', [
            'userCount' => $userCount,
            'pendingOrdersCount' => $pendingOrdersCount, // Mengirim data order pending
            'totalProducts' => $totalProducts,
            'monthlyRevenue' => $monthlyRevenue,
            'productNames' => $productNames,
            'quantities' => $quantities,
            'topProducts' => $topProducts,
            'recentOrders' => $recentOrders,
        ]);
    }


    /**
     * Menampilkan halaman daftar pesanan aktif.
     */
    public function orders()
    {
        $usersWithActiveOrders = User::whereHas('orders', function ($query) {
            $query->where('status', '!=', 'completed');
        })
        ->with(['orders' => function ($query) {
            $query->where('status', '!=', 'completed')
                  ->with('items.product')
                  ->latest();
        }])
        ->paginate(20);

        return view('admin.orders.index', compact('usersWithActiveOrders'));
    }

    /**
     * Menampilkan halaman daftar pengguna.
     */
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * (Fungsi ini sebaiknya ada di AdminOrderController)
     * Memperbarui status pesanan.
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed'
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
