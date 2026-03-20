<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Services\CartService;
	
	class CartController extends Controller
	{
		protected $cartService;
		
		public function __construct(CartService $cartService)
		{
			$this->cartService = $cartService;
		}
		
		public function add(Request $request)
		{
			$cart = $this->cartService->addToCart(
            1, // hardcoded user (demo)
            $request->product_id,
            $request->quantity
			);
			
			return response()->json($cart);
		}
		
		public function update(Request $request)
		{
			$cart = $this->cartService->updateQuantity(
            1,
            $request->product_id,
            $request->quantity
			);
			
			return response()->json($cart);
		}
		
		public function remove(Request $request)
		{
			$cart = $this->cartService->removeItem(
            1,
            $request->product_id
			);
			
			return response()->json($cart);
		}
		
		public function view()
		{
			$cart = $this->cartService->getCart(1);
			
			return view('cart', compact('cart'));
		}
		
		public function itemCount()
		{
			$cart = $this->cartService->getCart(1);
			
			return response()->json([
			'count' => $cart->items()->count()
			]);
		}
		
	}		