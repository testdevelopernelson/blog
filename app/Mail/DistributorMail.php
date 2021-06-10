<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DistributorMail extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data) {
        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
     public function build() {    
          // dd($this->data);
          $message = $this->to($this->getTo(config('settings.email_distributor')))
               ->subject('Formulario quiero ser distribuidor '. config('app.name') . ' ['.date('d-m-Y H:i').']')
               ->view('emails.distributor');
          return $message;
     }

     private function getTo($array_emails){
        $email=str_replace(' ', '', $array_emails);
        $array = explode(',', $email);
        return $array;
     }
}
