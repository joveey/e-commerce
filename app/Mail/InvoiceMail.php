<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $user;

    public function __construct($cart, $user)
    {
        $this->cart = $cart;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Invoice Pembelian Verse Beauty')
                    ->view('emails.invoice');
    }
}
