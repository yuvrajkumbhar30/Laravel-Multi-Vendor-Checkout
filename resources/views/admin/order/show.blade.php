@extends('layout.app')

@section('content')

<h2>Order #{{ $order->id }}</h2>

<p><strong>Vendor:</strong> {{ $order->vendor->name }}</p>
<p><strong>Customer:</strong> {{ $order->user->name }}</p>
<p><strong>Status:</strong> {{ $order->status }}</p>
<p><strong>Payment:</strong> {{ $order->payment->status ?? '-' }}</p>

<hr>

<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>₹{{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ $item->price * $item->quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="text-end">
    <h4>Total: ₹{{ $order->total_amount }}</h4>
</div>

@endsection