<?php
	
	namespace App\Http\Controllers;
	
	use App\Services\CartService;
	use App\Services\CheckoutService;
	
	class CheckoutController extends Controller
	{
		protected $cartService;
		protected $checkoutService;
		
		public function __construct(CartService $cartService, CheckoutService $checkoutService)
		{
			$this->cartService = $cartService;
			$this->checkoutService = $checkoutService;
		}
		
		public function checkout()
		{
			try {
				
				// TODO: replace with auth()->id() when auth implemented
				$userId = 1;
				
				$cart = $this->cartService->getCart($userId);
				
				if ($cart->items->isEmpty()) {
					return response()->json([
					'message' => 'Cart is empty'
					], 400);
				}
				
				$orders = $this->checkoutService->checkout($userId, $cart->items);
				
				// clear cart
				$cart->items()->delete();
				
				return redirect('/my-orders')->with('success', 'Order Successfully Placed.');
				
				} catch (\Exception $e) {
				
				return redirect('/cart')->with('error', $e->getMessage());
			}
		}
		
		
	}		