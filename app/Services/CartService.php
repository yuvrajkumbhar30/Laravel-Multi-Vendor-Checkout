<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartService
{
    public function getCart($userId)
    {
        return Cart::with('items.product.vendor')
            ->firstOrCreate(['user_id' => $userId]);
    }

    public function addToCart($userId, $productId, $quantity)
    {
        $product = Product::findOrFail($productId);

        if ($quantity > $product->stock) {
            throw new \Exception('Quantity exceeds stock');
        }

        $cart = $this->getCart($userId);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($item) {
            $newQty = $item->quantity + $quantity;

            if ($newQty > $product->stock) {
                throw new \Exception('Stock limit exceeded');
            }

            $item->update(['quantity' => $newQty]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return $this->getCart($userId);
    }

    public function updateQuantity($userId, $productId, $quantity)
    {
        $product = Product::findOrFail($productId);

        if ($quantity > $product->stock) {
            throw new \Exception('Stock exceeded');
        }

        $cart = $this->getCart($userId);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->firstOrFail();

        $item->update(['quantity' => $quantity]);

        return $this->getCart($userId);
    }

    public function removeItem($userId, $productId)
    {
        $cart = $this->getCart($userId);

        CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->delete();

        return $this->getCart($userId);
    }
	
	public function getGroupedCart($userId)
	{
		$cart = $this->getCart($userId);

		return $cart->items->groupBy(function ($item) {
			return $item->product->vendor_id;
		});
	}
}