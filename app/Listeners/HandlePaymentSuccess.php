<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PaymentSucceeded;

class HandlePaymentSuccess
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentSucceeded $event): void
    {
        \Log::info("Payment Success for Order ID: " . $event->payment->order_id);
    }
	
}
