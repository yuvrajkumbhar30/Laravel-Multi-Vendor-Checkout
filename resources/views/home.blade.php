@extends('layout.app')

@section('content')

<h2>Products</h2>

<div class="row">
    @foreach($products as $product)
	<div class="col-md-4 mb-3">
		<div class="card">
			<div class="card-body">
				
				<h5>{{ $product->name }}</h5>
				<p>₹{{ $product->price }}</p>
				
				
				<p><b>Vendor:</b> {{ $product->vendor->name }}</p>
				@if($product->stock > 0 )
				<button class="btn btn-outline-success btn-sm add-to-cart"
				data-id="{{ $product->id }}"
				data-stock="{{ $product->stock }}">
					Add to Cart
				</button>
				@else
				<button class="btn btn-outline-warning btn-sm" onclick="alert('Product is out of stock.')">
					Remind Me
				</button>
				
				@endif 
			</div>
		</div>
	</div>
    @endforeach
</div>

			@endsection			