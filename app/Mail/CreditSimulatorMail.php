<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Headquarter;

class CreditSimulatorMail extends Mailable {
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
        $agency = Headquarter::where('id', $this->data['agency'])->first();
        $this->data['agency'] = $agency->title;
        $message = $this->to($this->getTo(config('settings.email_credit_simulator')))
            ->subject('Simulador de crédito '. config('app.name') . ' ['.date('d-m-Y H:i').']')
            ->view('emails.credit_simulator');
            if (!empty($agency->email)) {
             $message->cc($agency->email);
            }
        return $message;
     }

     private function getTo($array_emails){
        $email=str_replace(' ', '', $array_emails);
        $array = explode(',', $email);
        return $array;
     }
}
