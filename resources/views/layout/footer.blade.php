<div class="footer mt-5">
    <div class="container text-center">
		
        <p class="mb-1">
            © {{ date('Y') }} MultiVendor Store
		</p>
		
        <p class="mb-0">
            Built with Laravel | Multi-Vendor Checkout System
		</p>
		
	</div>
</div>

<script>
	$(document).ready(function(){
		
		// CSRF setup (IMPORTANT)
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
				
		// Add to cart click
		$('.add-to-cart').click(function(){
			
			let productId = $(this).data('id');
			let stock = $(this).data('stock');
			
			if (stock <= 0) {
				alert("Out of stock");
				return;
			}
			
			$(document).on('click', '.add-to-cart', function () {
				
				let productId = $(this).data('id');
				let stock = $(this).data('stock');
				
				if (stock <= 0) {
					alert("Out of stock");
					return;
				}
				
				$.ajax({
					url: '/api/cart/add',
					type: 'POST',
					data: {
						product_id: productId,
						quantity: 1
					},
					success: function (response) {
						alert("Added to cart");
						console.table(response);
						
						let count = response.items.length;
						$('#cart-count').text(count);
					},
					error: function (xhr) {
						console.log(xhr.responseText);
						alert("Something Went Wrong Or Stock Limit Exceeds.");
					}
				});
				
			});
			
		});
		
	});
</script>