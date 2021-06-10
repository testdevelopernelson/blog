<?php

namespace App\Listeners;

use App\Mail\{QuoteSisoMail, QuoteCustomerMail};
use Mail;


class Quote {

		public function __construct() {
        //
    }

    public function created($order) {
        Mail::send(new QuoteCustomerMail($order));
        Mail::send(new QuoteSisoMail($order));

    }
}