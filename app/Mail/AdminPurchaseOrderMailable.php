<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPurchaseOrderMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $purchases;
    public $mail;
    public $total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($purchases, $total, $mail)
    {
        $this->purchases = $purchases;
        $this->total = $total;
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.adminPurchaseOrderMail');
    }
}
