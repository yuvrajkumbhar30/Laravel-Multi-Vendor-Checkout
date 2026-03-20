<?php
	
	namespace App\Services;
	
	use App\Models\Order;
	use App\Models\OrderItem;
	use App\Models\Payment;
	use App\Models\Product;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Validation\ValidationException;
	use App\Events\OrderPlaced;
	
	class CheckoutService
	{
		public function checkout($userId, $cartItems)
		{
			return DB::transaction(function () use ($userId, $cartItems) {
				
				// 1. Group by vendor
				$grouped = $cartItems->groupBy(function ($item) {
					return $item->product->vendor_id;
				});
				
				$orders = [];
				
				foreach ($grouped as $vendorId => $items) {
					
					// 2. Create Order
					$order = Order::create([
                    'user_id' => $userId,
                    'vendor_id' => $vendorId,
                    'total_amount' => 0,
                    'status' => 'pending'
					]);
					
					$total = 0;
					
					foreach ($items as $item) {
						
						$product = Product::find($item->product_id);
						
						// 3. Validate stock again (IMPORTANT)
						//if ($item->quantity > $product->stock) {
                        //throw new \Exception("Stock not available for {$product->name}");
						//}
						
						//proper error handling 
						
						if ($item->quantity > $product->stock) {
							throw ValidationException::withMessages([
							'stock' => "Stock not available for {$product->name}"
							]);
						}
						
						
						// 4. Deduct stock
						$product->decrement('stock', $item->quantity);
						
						// 5. Create Order Item
						OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
                        'price' => $product->price
						]);
						
						$total += $product->price * $item->quantity;
					}
					
					// 6. Update total
					$order->update(['total_amount' => $total]);
					
					// 7. Create Payment
					Payment::create([
					'order_id' => $order->id,
					'status' => 'paid'
					]);
					
					$orders[] = $order;
					
					//Fire Event
					event(new OrderPlaced($order));
				
				}
				
				
				
				return $orders;
			});
		}
	}					