<?php
	
	namespace App\Listeners;
	
	use Illuminate\Contracts\Queue\ShouldQueue;
	use Illuminate\Queue\InteractsWithQueue;
	use App\Events\OrderPlaced;
	
	class SendOrderNotification
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
		public function handle(OrderPlaced $event): void
		{
			\Log::info("Order Placed: ID " . $event->order->id);
		}
	}
