@extends('layout.app')

@section('content')

<h2 class="mb-4">Cart</h2>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if($cart->items->count() > 0)

    @php
        $grouped = $cart->items->groupBy(function($item) {
            return $item->product->vendor->id;
        });
    @endphp

    @foreach($grouped as $vendorId => $items)

        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                Vendor: {{ $items->first()->product->vendor->name }}
            </div>

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
                        @php $vendorTotal = 0; @endphp

                        @foreach($items as $item)
                            @php
                                $total = $item->product->price * $item->quantity;
                                $vendorTotal += $total;
                            @endphp

                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>₹{{ $item->product->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₹{{ $total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end">
                    <strong>Vendor Total: ₹{{ $vendorTotal }}</strong>
                </div>

            </div>
        </div>

    @endforeach

    <!-- Grand Total -->
    @php
        $grandTotal = $cart->items->sum(function($item){
            return $item->product->price * $item->quantity;
        });
    @endphp

    <div class="text-end">
        <h4>Grand Total: ₹{{ $grandTotal }}</h4>

        <form action="/checkout" method="POST">
            @csrf
            <button class="btn btn-success mt-2">Checkout</button>
        </form>
    </div>

@else
    <div class="alert alert-warning">Cart is empty</div>
@endif

@endsection