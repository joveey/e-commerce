<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // 1. Import library PDF

class OrderController extends Controller
{
    public function history(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat pesanan.');
        }

        $query = $user->orders()->with('items.product')->latest();

        $statusFilter = $request->query('status');
        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        $orders = $query->paginate(5);

        return view('orders.history', compact('orders'));
    }

    /**
     * 2. TAMBAHKAN METHOD BARU INI
     * Generate and download the invoice as a PDF.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function downloadInvoice(Order $order)
    {
        // Keamanan: Pastikan pengguna yang login adalah pemilik pesanan
        if (auth()->id() !== $order->user_id) {
            abort(403, 'Akses Ditolak.');
        }

        // Memuat relasi yang diperlukan untuk ditampilkan di PDF
        $order->load('user', 'items.product');

        // Membuat PDF dari view 'pdf.invoice' yang sudah Anda buat
        $pdf = Pdf::loadView('pdf.invoice', ['order' => $order]);

        // Mengunduh file PDF dengan nama yang dinamis
        return $pdf->download("invoice-verse-beauty-{$order->id}.pdf");
    }
}
