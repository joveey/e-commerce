<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Tambahkan ini

class AdminOrderController extends Controller
{
    public function index()
    {
        // Filter pesanan yang statusnya BUKAN 'completed'
        $orders = Order::with(['user', 'items.product'])
            ->where('status', '!=', Order::STATUS_COMPLETED) // Hanya tampilkan yang belum selesai
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function completedOrdersHistory()
    {
        // Ambil hanya pesanan yang statusnya 'completed'
        $orders = Order::with(['user', 'items.product'])
            ->where('status', Order::STATUS_COMPLETED) // Hanya ambil yang completed
            ->latest()
            ->paginate(10);

        return view('admin.orders.completed_history', compact('orders')); // Akan membuat view baru ini
    }
    
    public function updateStatus(Request $request, Order $order)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:' .
                            Order::STATUS_PENDING . ',' .
                            Order::STATUS_PROCESSING . ',' .
                            Order::STATUS_SHIPPED . ',' .
                            Order::STATUS_COMPLETED
            ]);

            // Pastikan nilai status yang divalidasi sudah benar
            Log::info('Attempting to update order status.', [
                'order_id' => $order->id,
                'old_status' => $order->status,
                'new_status_from_request' => $validated['status']
            ]);

            $order->update([
                'status' => $validated['status']
            ]);

            // Setelah update, ambil ulang data order dari DB untuk memastikan statusnya sudah berubah
            $order->refresh(); // Ini akan me-load ulang data order dari database
            Log::info('Order status updated.', [
                'order_id' => $order->id,
                'current_status_after_update' => $order->status
            ]);

            return back()->with('success', 'Status pesanan berhasil diperbarui.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap error validasi secara spesifik
            Log::error('Validation failed during order status update.', [
                'order_id' => $order->id,
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            // Tangkap error umum lainnya
            Log::error('Error updating order status.', [
                'order_id' => $order->id,
                'error_message' => $e->getMessage(),
                'error_trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            return back()->with('error', 'Gagal memperbarui status pesanan. Silakan coba lagi.');
        }
    }
}