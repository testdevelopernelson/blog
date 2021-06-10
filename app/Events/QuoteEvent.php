<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuoteEvent
{

 	use Dispatchable, InteractsWithSockets, SerializesModels;
	public $order;
	
	function __construct($order)
	{
		$this->order = $order;
	}
	
}