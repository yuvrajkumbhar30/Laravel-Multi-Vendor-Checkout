<?php

namespace App\Http\Controllers;
use App\Models\Order;

class OrderController extends Controller
{
    public function myOrders()
{
    $orders = \App\Models\Order::with(['items.product', 'vendor', 'payment'])
	->where('user_id', 1)
                ->latest()
                ->get();
				
	//echo '<pre>';
	//print_r($orders);
	//exit;

    return view('orders', compact('orders'));
}
}