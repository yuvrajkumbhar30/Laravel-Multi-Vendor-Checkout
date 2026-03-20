<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('images/altrone-logo.png') }}" height="60" class="me-2">
            <strong>Multi Vendor Website</strong>
        </a>

        <!-- TOGGLE -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAV LINKS -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

               

                <!-- CART -->
                <li class="nav-item">
                    <a class="nav-link position-relative" href="/cart">
                        <span id="cart-icon"><i class="bi bi-cart"></i> Cart</span>
                        <span id="cart-count" 
                              class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                              0
                        </span>
						
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<script>

function loadCartCount() {
    $.get('/cart/count', function(data){
        $('#cart-count').text(data.count);
    });
}


$(document).ready(function(){
    loadCartCount();
});
</script>