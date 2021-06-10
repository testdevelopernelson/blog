<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteSisoMail extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;

    public function __construct($order) {
        $this->order = $order;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
     public function build() {
          $message = $this->to($this->order->address->email)
              ->subject('Cotización de un cliente en  '. config('app.name') . ' ['.date('d-m-Y H:i').']')
              ->view('emails.quote_siso'); 
          return $message;
     }
}
