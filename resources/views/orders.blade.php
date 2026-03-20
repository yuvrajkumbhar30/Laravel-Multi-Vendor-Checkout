@extends('layout.app')

@section('content')

<h2 class="mb-4">My Orders</h2>

@if($orders->count() > 0)

    @foreach($orders as $order)

        <div class="card mb-4">

            <!-- Order Header -->
            <div class="card-header bg-dark text-white d-flex justify-content-between">
                <div>
                    Order #{{ $order->id }} | {{ $order->created_at->format('d/m/Y H:i a' )  }}
                </div>
                <div>
                    Vendor: {{ $order->vendor->name }}
                </div>
            </div>

            <!-- Order Body -->
            <div class="card-body">

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

                <!-- Order Summary -->
                <div class="text-end">
                    <p><strong>Total Amount:</strong> ₹{{ $order->total_amount }}</p>
                    <p>
                        <strong>Payment Status:</strong> 
                        <span class="badge bg-success">
                            {{ $order->payment->status }}
                        </span>
                    </p>
                </div>

            </div>

        </div>

    @endforeach

@else
    <div class="alert alert-warning">No orders found</div>
@endif

@endsection