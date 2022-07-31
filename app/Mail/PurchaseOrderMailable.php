<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseOrderMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $purchases;
    public $total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($purchases, $total)
    {
        $this->purchases = $purchases;
        $this->total = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.purchaseOrderMail');
    }
}
