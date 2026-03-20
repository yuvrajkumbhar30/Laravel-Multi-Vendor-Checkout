@extends('layout.app')

@section('content')

<h2 class="mb-4">Admin Orders</h2>

<form method="GET" class="row mb-4">

    <!-- Vendor Filter -->
    <div class="col-md-3">
        <select name="vendor_id" class="form-control">
            <option value="">All Vendors</option>
            @foreach($vendors as $vendor)
                <option value="{{ $vendor->id }}" 
                    {{ request('vendor_id') == $vendor->id ? 'selected' : '' }}>
                    {{ $vendor->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Customer Filter -->
    <div class="col-md-3">
        <input type="text" name="customer_name" 
            class="form-control"
            placeholder="Customer Name"
            value="{{ request('customer_name') }}">
			 </div>

    <!-- Status Filter -->
    <div class="col-md-3">
        <select name="status" class="form-control">
            <option value="">All Status</option>
            <option value="pending"  {{ request('status')=='pending'?'selected':'' }}>Pending</option>
            <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Completed</option>
        </select>
    </div> 

    <div class="col-md-1">
        <button class="btn btn-success w-100">Filter</button>
		
    </div>
	<div class="col-md-1">
        
		<a href="/admin/orders" class="btn btn-primary w-100">Clear </a>
    </div>
	
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Vendor</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
            <th>Payment</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->vendor->name }}</td>
                <td>{{ $order->user->name }}</td>
                <td>₹{{ $order->total_amount }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->payment->status ?? '-' }}</td>
                <td>
                    <a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-info">
                        View
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>

@endsection