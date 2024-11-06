<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Archive Cafe</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logo/logo2.png" rel="icon">
  <link href="assets/img/logo/logo2.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Dosis:wght@200;300;400;500;600;700;800&family=Aver&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
    <link href="{{url('assets/css/main.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/drinks_menu.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/menu_landing.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM8KA4jHQsc1osGZb8sdmFic2S1wIldw18AJzAf" crossorigin="anonymous">


</head>

<body>
    @if (Route::has('login'))
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="{{route('welcome')}}" class="logo d-flex align-items-center me-auto">
            <img src="assets/img/logo/logo.png" alt="">
            </a>
                @auth
                    @if (Auth::user()->usertype === 'admin')
                        <nav id="navmenu" class="navmenu">
                            <ul>
                                <li class="nav-item cafe-center">
                                    <h1 class="cafe-name">archive <span>cafe</span></h1>
                                </li>
                                    <li><a href="{{route('admin.pos')}}">POS</a></li>
                                    <li><a href="{{route('admin.product')}}">PRODUCTS</a></li>
                                    <li><a href="{{route('admin.orders')}}">ORDERS</a></li>
                                    <li class="nav-item d-none d-md-block">
                                        <span class="navbar-divider"></span>
                                    </li>

                                    <!-- Dropdown changed to button -->
                                    <li class="dropdown">
                                        <button class="btn-icon-only" id="dropdownMenuButton" aria-expanded="false">
                                        <i class="bi bi-person toggle-dropdown"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a href="{{route('profile.edit')}}">{{Auth::user()->name}}</a></li>

                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </ul>
                                    </li>
                            </ul>
                                        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                        </nav>

                    @elseif (Auth::user()->usertype === 'user')
                        <nav id="navmenu" class="navmenu">
                                <ul>
                                    <li class="nav-item cafe-center">
                                        <h1 class="cafe-name">archive <span>cafe</span></h1>
                                    </li>
                                    <li><a href="{{route('welcome')}}">Cafe</a></li>
                                    <li><a href="{{route('menu')}}">Menu</a></li>
                                    <li><a href="{{route('welcome')}}">Meet The Team</a></li>
                                    <li class="nav-item d-none d-md-block">
                                        <span class="navbar-divider"></span>
                                    </li>
                                    <!-- Dropdown changed to button -->
                                        <li class="nav-item">
                                        @auth
                                        @if(Auth::user()->usertype === 'user')
                                            <!-- If the user is logged in, redirect to the cart page -->
                                            <a href="{{ route('cart') }}" class="btn-icon-only">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </a>
                                    @endif
                                    @endauth
                                        </li>

                                    <li class="dropdown">
                                        <button class="btn-icon-only" id="dropdownMenuButton" aria-expanded="false">
                                            <i class="bi bi-person toggle-dropdown"></i>
                                        </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a href="{{route('userProfile')}}">{{Auth::user()->name}}</a></li>

                                                <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                                </form>
                                            </ul>
                                    </li>
                                </ul>
                                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                        </nav>
                @endif
                @else
                <nav id="navmenu" class="navmenu">
                    <ul>
                    <li class="nav-item cafe-center">
                        <h1 class="cafe-name">archive <span>cafe</span></h1>
                    </li>
                    <li><a href="#cafe">Cafe</a></li>
                    <li><a href="{{route('login')}}">Menu</a></li>
                    <li><a href="#team">Meet The Team</a></li>
                    <li class="nav-item d-none d-md-block">
                        <span class="navbar-divider"></span>
                    </li>
                    <!-- Dropdown changed to button -->
                    <li class="dropdown">
                        <button class="btn-icon-only" id="dropdownMenuButton" aria-expanded="false">
                        <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </li>
                    <li class="dropdown">
                        <button class="btn-icon-only" id="dropdownMenuButton" aria-expanded="false">
                        <i class="bi bi-person toggle-dropdown"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a href="{{route('login')}}">Login</a></li>

                        <li><a href="{{route('register')}}">Sign Up</a></li>
                        </ul>
                    </li>
                    </ul>
                    <h1 class="cafe-center cafe-name text-center d-md-none"><strong>archive</strong> <span>cafe</span></h1>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
                @endauth

        </div>
    </header>

  @endif

  <main class="main">
   <div class="menu-container-light-details" style="padding-top: 150px;">
    <div class="row mb-5">
        <div class="col-md-8">
            <div style="display: flex; flex-direction: row; flex-wrap: nowrap; align-content: center; justify-content: space-between; align-items: center;">
                <div class="order-history" style="width: 200px;">
                    <h3>Cart</h3>
                </div>
                <div class="order-history" style="width: 200px;">
                    <h3>{{ Auth::user()->name }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-8">
            <div class="order-container">
                <p># Cart</p>

                <div class="product-table mb-3">
                    <p></p>
                    <p>Name</p>
                    <p>Price</p>
                    <p>QTY</p>
                    <p>Action</p>
                </div>

                <!-- Cart items -->
<div id="cart-items-container">
    @php
        $cart = session('cart', []);
        $totalPrice = 0;
    @endphp

    @foreach($cart as $item)
        @php
            $basePrice = $item['price'] * $item['quantity'];
            $extrasTotal = 0; // Initialize for each item

      
            $extras = is_string($item['extras']) ? json_decode($item['extras'], true) : $item['extras'];
        @endphp

        <div class="product-table mb-3" id="cart-item-{{ $item['id'] }}">
            <img src="assets/img/products/{{ $item['image'] ?? 'default.png' }}" alt="{{ $item['name'] }}" width="auto" height="60">

            <p>{{ $item['name'] }}
                @if(isset($item['temperature']))
                    ({{ ucfirst($item['temperature']) }})
                @endif
            </p>

            <p>₱{{ number_format($basePrice, 2) }}</p>

            <div class="btn-container">
                <button class="custom-btn minus-btn" onclick="adjustQuantity('{{ $item['id'] }}', -1)">
                    <i class="fa-solid fa-minus"></i>
                </button>
                <span id="quantity-count-{{ $item['id'] }}" style="color:white;font-size: 1em;">{{ $item['quantity'] }}</span>
                <button class="custom-btn plus-btn" onclick="adjustQuantity('{{ $item['id'] }}', 1)">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>

            <div class="btn-container">
                <button class="custom-btn remove-item" data-id="{{ $item['id'] }}">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>

        @if(!empty($extras))
            <div class="extras-list" style="padding-left: 20px; margin-top: -15px;">
          
                @foreach($extras as $extra)
                    @if (is_array($extra) && isset($extra['price'], $extra['name']))
                        @php
                       
                            $extrasTotal += $extra['price'] * $item['quantity'];
                        @endphp
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <p>{{ $extra['name'] }}</p>
                            <p>+ ₱{{ number_format($extra['price'] * $item['quantity'], 2) }}</p>
                        </div>
                    @else
                        <p>Invalid extra data</p>
                    @endif
                @endforeach
            </div>
        @endif

        @php
            $itemTotal = $basePrice + $extrasTotal; 
            $totalPrice += $itemTotal;
        @endphp
    @endforeach
</div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-5" style="display: flex; flex-direction: row; flex-wrap: nowrap; align-content: center; justify-content: space-between; align-items: center;">
                <button class="btn-dinein">Dine In</button>
                <button class="btn-dineindark">Take Out</button>
            </div>

            <div class="mb-5" style="display: flex; flex-direction: row; flex-wrap: nowrap; align-content: stretch; justify-content: space-evenly; align-items: center;">
                <h2 class="text-yellow">Total:</h2>
                <div class="order-history" style="width: 200px;">
                    <h3 id="cart-total-price">₱{{ number_format($totalPrice, 2) }}</h3>
                </div>
            </div>

            <div class="text-center">
                <button class="btn-dinein text-center" onclick="placeOrder()" >Place Order</button>
            </div>
        </div>
    </div>
</div>

</main>








 <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

   <!-- Main JS File -->
   <script src="{{url('assets/js/main.js')}}"></script>
   <script src="{{url('assets/js/drinks_menu.js')}}"></script>
   <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        const removeButtons = document.querySelectorAll('.remove-item');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                removeItem(itemId);
            });
        });

        window.adjustQuantity = function(itemId, change) {
            const quantityElement = document.getElementById(`quantity-count-${itemId}`);
            let currentQuantity = parseInt(quantityElement.textContent);
            const newQuantity = currentQuantity + change;

            if (newQuantity >= 0) {
                quantityElement.textContent = newQuantity;
                updateItemQuantity(itemId, newQuantity);
            }
        };

        function removeItem(itemId) {
            fetch('{{ route('cart.remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ product_id: itemId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const itemElement = document.getElementById(`cart-item-${itemId}`);
                    if (itemElement) {
                        itemElement.remove();
                    }
                    updateCartTotal();
                }
            });
        }

        function updateItemQuantity(itemId, quantity) {
            fetch('{{ route('cart.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: itemId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartTotal();
                }
            });
        }

        function updateCartTotal() {
            const cartItems = document.querySelectorAll('.product-table[id^="cart-item-"]');
            let totalPrice = 0;

            cartItems.forEach(item => {
                const priceElement = item.querySelector('p:nth-child(3)');
                const quantityElement = item.querySelector('[id^="quantity-count-"]');

                if (priceElement && quantityElement) {
                    const price = parseFloat(priceElement.textContent.replace('$', ''));
                    const quantity = parseInt(quantityElement.textContent);
                    totalPrice += price * quantity;
                }
            });

            const totalPriceElement = document.getElementById('cart-total-price');
            if (totalPriceElement) {
                totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
            }

            if (cartItems.length === 0) {
                location.reload(); // Reload the page if cart is empty
            }
        }
    });
    </script>
  <script>
function placeOrder() {
    // Get the cart data from Laravel Blade
    const cartData = @json($cart);  // This assumes $cart is the cart data from Laravel

    // Calculate the total price for each item and its extras
    const orderData = Object.values(cartData).map(item => {
        // Ensure base price is a number
        const basePrice = parseFloat(item.price) * parseInt(item.quantity, 10) || 0;  // Fallback to 0 if NaN
        let extrasTotal = 0;
        let extras = [];

        // Determine if extras is an array or needs parsing
        if (Array.isArray(item.extras)) {
            extras = item.extras;  // Already an array
        } else if (typeof item.extras === 'string') {
            try {
                extras = JSON.parse(item.extras);  // Parse the stringified JSON into an array
            } catch (e) {
                console.error('Error parsing extras:', e);
            }
        }

        // Log extras for debugging
        console.log('Item:', item);
        console.log('Parsed Extras:', extras);

        // Calculate extras total
        extrasTotal = extras.reduce((total, extra) => {
            const extraPrice = parseFloat(extra.price) || 0; // Fallback to 0 if NaN
            return total + (extraPrice * parseInt(item.quantity, 10)); // Ensure quantity is a number
        }, 0);

        const itemTotal = basePrice + extrasTotal;

        // Log item totals for debugging
        console.log('Base Price:', basePrice);
        console.log('Extras Total:', extrasTotal);
        console.log('Item Total:', itemTotal);

        return {
            id: item.id,
            name: item.name,
            price: basePrice, // Use calculated base price
            quantity: parseInt(item.quantity, 10),
            extras: extras,  // Store the parsed extras
            totalPrice: itemTotal  // Total for this item (base price + extras)
        };
    });

    // Calculate the total price for all items
    const totalPrice = orderData.reduce((sum, item) => sum + (item.totalPrice || 0), 0);  // Ensure each item total is treated safely

    // Log the total price
    console.log('Order Data:', orderData);
    console.log('Total Price:', totalPrice);

    // Now, send the order data to the server using fetch
    fetch("{{ route('place.order') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"  // Include CSRF token for security
        },
        body: JSON.stringify({
            order: orderData,  // The order details
            totalPrice: totalPrice  // The total price for the order
        })
    })
    .then(response => response.json())  // Assuming the server responds with JSON
    .then(data => {
        // Redirect to the payment page after a successful response
        window.location.href = "{{ route('payment.page') }}";  // Redirect to payment page
    })
    .catch(error => console.error('Error placing order:', error));  // Handle any errors
}



 </script>
</body>

</html>
