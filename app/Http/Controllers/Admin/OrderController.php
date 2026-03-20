<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Vendor;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['items.product', 'vendor', 'user', 'payment']);

        // Vendor filter
        if ($request->vendor_id) {
            $query->where('vendor_id', $request->vendor_id);
        }

        // Customer name filter
        if ($request->customer_name) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer_name . '%');
            });
        }

        // Status filter
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->get();
        $vendors = Vendor::all();

        
        return view('admin.orders.index', compact('orders', 'vendors'));
    }
	
	public function show($id)
{
    $order = \App\Models\Order::with(['items.product', 'vendor', 'user', 'payment'])
                ->findOrFail($id);

    return view('admin.order.show', compact('order'));
}
}