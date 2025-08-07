<?php

namespace App\Mail;

use App\Models\Order; // 1. Ganti parameter menjadi Order
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf; // 2. Import library PDF

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order; // 3. Properti sekarang adalah objek Order

    /**
     * Create a new message instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order) // 4. Constructor menerima objek Order
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // 5. Membuat PDF dari view 'pdf.invoice'
        $pdf = Pdf::loadView('pdf.invoice', ['order' => $this->order]);

        // 6. Membuat email dan melampirkan PDF yang sudah dibuat
        return $this->subject('Invoice Pembelian Verse Beauty #' . $this->order->id)
                    ->view('emails.invoice') // Ini adalah view untuk badan email
                    ->with([
                        'order' => $this->order,
                    ])
                    ->attachData($pdf->output(), "invoice-{$this->order->id}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
    }
}
