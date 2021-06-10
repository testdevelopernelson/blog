<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteCustomerMail extends Mailable {
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
        $message = $this->to($this->getTo(config('settings.email_quote')))
            ->subject('Cotización solicitada en '. config('app.name') . ' ['.date('d-m-Y H:i').']')
            ->view('emails.quote_customer');
          //   dd($message);
        return $message;
    }

    private function getTo($array_emails){
        $email=str_replace(' ', '', $array_emails);
        $array = explode(',', $email);
        return $array;
     }
}
