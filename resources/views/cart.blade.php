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
                            <div class="order-history" style="width: 200px; transition: all 0.3s ease;">
                                <h3><a href="{{ route('menu') }}" style="text-decoration: none; color: inherit;" onmouseover="this.parentElement.parentElement.style.backgroundColor='#4f2d19'" onmouseout="this.parentElement.parentElement.style.backgroundColor='#3f2314'">Add Item</a></h3>
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


                                                <!-- Cart items -->
                                                <div id="cart-items-container">
                                                    @php
                                                    $cart = session('cart', []);
                                                    $totalPrice = 0;
                                                    @endphp

                                                    @if(count($cart) > 0)
                                                        <table class="cart-table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="image-column" style="color: white;"></th>
                                                                    <th class="name-column" style="color: white;">Name</th>
                                                                    <th class="price-column" style="color: white;">Price</th>
                                                                    <th class="quantity-column" style="color: white;">QTY</th>
                                                                    <th class="action-column" style="color: white;">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($cart as $item)
                                                                    @php
                                                                    $basePrice = $item['price'] * $item['quantity'];
                                                                    $extrasTotal = 0;
                                                                    $product = \App\Models\Product::find($item['id']);
                                                                    $productImage = $product ? $product->image : 'default.png';
                                                                    $extras = is_string($item['extras']) ? json_decode($item['extras'], true) : $item['extras'];
                                                                    @endphp

                                                                    <tr class="product-row" id="cart-item-{{ $item['id'] }}">
                                                                        <td class="image-column">
                                                                            <div class="product-image">
                                                                                <img src="{{ asset($productImage) }}" alt="{{ $item['name'] }}">
                                                                            </div>
                                                                        </td>
                                                                        <td class="name-column">
                                                                            <div class="product-name">
                                                                                {{ $item['name'] }}
                                                                                @if(isset($item['temperature']))
                                                                                    <span class="temperature">({{ ucfirst($item['temperature']) }})</span>
                                                                                @endif
                                                                            </div>
                                                                        </td>
                                                                        <td class="price-column">₱{{ number_format($basePrice, 2) }}</td>
                                                                        <td class="quantity-column">
                                                                            <div class="quantity-controls">
                                                                                <button class="quantity-btn minus-btn" onclick="adjustQuantity('{{ $item['id'] }}', -1)" style="background-color: orange;">
                                                                                    <i class="fa-solid fa-minus"></i>
                                                                                </button>
                                                                                <span id="quantity-count-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                                                                <button class="quantity-btn plus-btn" onclick="adjustQuantity('{{ $item['id'] }}', 1)" style="background-color: orange;">
                                                                                    <i class="fa-solid fa-plus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                        <td class="action-column">
                                                                            <button class="remove-btn" data-id="{{ $item['id'] }}" onclick="removeCartItem('{{ $item['id'] }}')" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                                                                <i class="fa-solid fa-times"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>

                                                                    @if(!empty($extras))
                                                                        @foreach($extras as $extraIndex => $extra)
                                                                            @if (is_array($extra) && isset($extra['price'], $extra['name']))
                                                                                @php
                                                                                $extrasTotal += $extra['price'] * $item['quantity'];
                                                                                @endphp
                                                                                <tr class="extra-row" id="extra-{{ $item['id'] }}-{{ $extraIndex }}">
                                                                                    <td></td>
                                                                                    <td class="extra-name">{{ $extra['name'] }}</td>
                                                                                    <td class="extra-price">+ ₱{{ number_format($extra['price'] * $item['quantity'], 2) }}</td>
                                                                                    <td></td>
                                                                                    <td class="action-column">
                                                                                        <button class="remove-btn" onclick="removeExtra('{{ $item['id'] }}', {{ $extraIndex }})" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                                                                            <i class="fa-solid fa-times"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif

                                                                    @php
                                                                    $itemTotal = $basePrice + $extrasTotal;
                                                                    $totalPrice += $itemTotal;
                                                                    @endphp
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <div class="text-center" style="color: white; padding: 2rem;">
                                                            <h3>Your cart is empty</h3>
                                                            <p>UY! Kumusta</p>
                                                            <p>Check out Our Menu to find the goodies there KAPATIDS!</p>
                                                            <a href="{{ route('menu') }}" class="btn-dinein" style="display: inline-block; margin-top: 1rem; text-decoration: none; color: white;">
                                                                Menu
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                        <!-- Recommended Products -->
                                        <div class="recommended-products">
                                            <h2>Recommended For You</h2>
                                            <div class="products-grid">

                                                <!-- Static Product Card 1 -->
                                                <div class="product-card">
                                                    <div class="product-image">
                                                        {{-- <img src="{{ asset($product->image) }}" alt="Americano"> --}}
                                                    </div>
                                                    <div class="product-details">
                                                        <h3 class="product-name">Americano</h3>
                                                        <p class="product-price">₱145.00</p>
                                                        <button class="add-to-cart-btn" onclick="addToCart(1, 'Americano', 145.00)">
                                                            <i class="fa-solid fa-plus"></i> Add to Cart
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Static Product Card 4 -->
                                                <div class="product-card">
                                                    <div class="product-image">
                                                        {{-- <img src="{{ asset($productImage) }}" alt="Cafe Mocha"> --}}
                                                    </div>
                                                    <div class="product-details">
                                                        <h3 class="product-name">Cafe Mocha</h3>
                                                        <p class="product-price">₱175.00</p>
                                                        <button class="add-to-cart-btn" onclick="addToCart(4, 'Cafe Mocha', 175.00)">
                                                            <i class="fa-solid fa-plus"></i> Add to Cart
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                        </div>
                    </div>

                    <div class="text-center font-weight: ">
                        <h3 style="color: orange;">Choose Dining Options</h3>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-5 order-type-buttons" style="display: flex; gap: 10px; justify-content: center;">
                            <button class="btn-dineindark" id="dineInBtn" onclick="toggleOrderType('Dine In', this)" style="flex: 1;">Dine In</button>
                            <button class="btn-dineindark" id="takeOutBtn" onclick="toggleOrderType('Take Out', this)" style="flex: 1;">Take Out</button>
                        </div>

                        <div class="mb-5 total-container">
                            <h2 class="text-yellow">Total:     ₱{{ number_format($totalPrice, 2) }}</h2>
                        </div>

                        <div class="text-center">
                            <button class="btn-dinein text-center" onclick="placeOrder()">Place Order</button>
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

    let orderType = null; // Start with no selection

function toggleOrderType(type, button) {
    const dineInBtn = document.getElementById('dineInBtn');
    const takeOutBtn = document.getElementById('takeOutBtn');

    if (orderType === type) {
        // If clicking the same button, deselect it
        orderType = null;
        button.classList.remove('btn-active');
    } else {
        // Select the new button and deselect the other
        orderType = type;
        dineInBtn.classList.remove('btn-active');
        takeOutBtn.classList.remove('btn-active');
        button.classList.add('btn-active');
    }

    console.log('Order Type:', orderType); // Log for debugging
}

function placeOrder() {
    // Get the cart data from Laravel Blade
    const cartData = @json($cart);

    // Check if cart is empty
    if (Object.keys(cartData).length === 0) {
        alert('Your cart is empty. Please add items before placing an order.');
        return;
    }

    // Check if order type is selected
    if (!orderType) {
        alert('Please select an order type (Dine In or Take Out)');
        return;
    }

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
            order: orderData,
            totalPrice: totalPrice,
            orderType: orderType
        })
    })
    .then(response => response.json())  // Assuming the server responds with JSON
    .then(data => {
        // Redirect to the payment page after a successful response
        window.location.href = "{{ route('payment.page') }}";  // Redirect to payment page
    })
    .catch(error => console.error('Error placing order:', error));  // Handle any errors
}

function adjustQuantity(productId, change) {
    const quantitySpan = document.getElementById('quantity-count-' + productId);
    let currentQuantity = parseInt(quantitySpan.textContent);
    const newQuantity = currentQuantity + change;

    if (newQuantity > 0) {
        // Update the quantity in the cart via AJAX
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: newQuantity
            })
        })
        .then(response => response.json())
        .then(data => {
            // Check for the updated quantity and total price
            if (data.success) {
                // Update the quantity in the UI
                quantitySpan.textContent = newQuantity;

                // Assuming data contains the updated total price for this product
                const productTotalPrice = data.updated_price; // Example key, modify as necessary

                // Update the total price on the page
                const totalPriceSpan = document.getElementById('total-price-' + productId);
                if (totalPriceSpan) {
                    totalPriceSpan.textContent = 'P' + productTotalPrice.toFixed(2);
                }

                // Optionally, update the grand total in the cart (if needed)
                const grandTotalSpan = document.getElementById('grand-total');
                if (grandTotalSpan) {
                    grandTotalSpan.textContent = 'P' + data.grand_total.toFixed(2);
                }
            } else {
                console.error('Error updating quantity:', data.message);
            }
        })
        .catch(error => console.error('Error adjusting quantity:', error));
    }
}

 </script>
 <script>
    function removeCartItem(productId) {
        fetch('/cart/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Refresh the page to reflect changes
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error removing item:', error);
            // Refresh even on error to ensure consistent state
            window.location.reload();
        });
    }

    function removeExtra(productId, extraIndex) {
    // Remove the extra row from the DOM
    const extraRow = document.getElementById(`extra-${productId}-${extraIndex}`);
    if (extraRow) {
        extraRow.remove();
    }

    // Send request to update the cart on the server
    fetch('/cart/remove-extra', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: productId,
            extra_index: extraIndex
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the total price in the cart without refreshing the page
            const totalPriceElement = document.querySelector('.text-yellow');
            if (totalPriceElement && data.new_total) {
                totalPriceElement.textContent = `Total: ₱${parseFloat(data.new_total).toFixed(2)}`;
            }
        } else {
            console.error('Error removing extra:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


    function addToCart(productId) {
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Refresh the page or update the cart count
                window.location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

<style>
     /* Base styles for all screen sizes */
.cart-title {
    font-size: clamp(1.25rem, 2vw, 1.5rem);
    font-weight: bold;
    margin-bottom: clamp(1rem, 2vw, 1.5rem);
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1rem;
}

.cart-table th {
    padding: clamp(0.5rem, 1vw, 1rem);
    text-align: left;
    border-bottom: 2px solid #e2e8f0;
    font-weight: 600;
    color: #1a202c;
}

.cart-table td {
    padding: clamp(0.5rem, 1vw, 1rem);
    vertical-align: middle;
    border-bottom: 1px solid #e2e8f0;
}

/* Product image styles - fluid sizing */
.image-column {
    width: clamp(60px, 8vw, 80px);
}

.product-image img {
    width: clamp(40px, 6vw, 60px);
    height: clamp(40px, 6vw, 60px);
    object-fit: cover;
    border-radius: 4px;
}

/* Fluid typography and spacing */
.cart-table {
    font-size: clamp(0.875rem, 1vw, 1rem);
}

/* Quantity controls with touch-friendly sizing */
.quantity-controls {
    display: flex;
    align-items: center;
    gap: clamp(0.25rem, 0.5vw, 0.5rem);
}

.quantity-btn {
    padding: clamp(0.25rem, 0.5vw, 0.5rem);
    min-width: clamp(1.5rem, 4vw, 2rem);
    min-height: clamp(1.5rem, 4vw, 2rem);
    border: 1px solid #e2e8f0;
    background: #ffffff;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Mobile First Approach (Starting from iPhone SE - 375px) */
@media screen and (max-width: 375px) {
    .row {
        margin: 0;
        padding: 0.5rem;
    }

    .cart-table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .name-column {
        min-width: 100px;
    }

    .price-column {
        width: 70px;
    }

    .quantity-column {
        width: 90px;
    }

    .action-column {
        width: 40px;
    }

   /* Updated Order Type Buttons */
.order-type-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 2rem;
}

    .total-container {
        flex-direction: column;
        text-align: center;
        padding: 0.75rem;
    }

    .order-history {
        width: 100%;
    }
}

/* Small to Medium Phones (376px to 567px) */
@media screen and (min-width: 376px) and (max-width: 567px) {
    .row {
        padding: 0.75rem;
    }

    .name-column {
        min-width: 120px;
    }

    .price-column {
        width: 80px;
    }

    .quantity-column {
        width: 100px;
    }
}

/* Large Phones to Small Tablets (568px to 767px) */
@media screen and (min-width: 568px) and (max-width: 767px) {
    .row {
        padding: 1rem;
    }

    .name-column {
        min-width: 150px;
    }

    .order-type-buttons {
        flex-direction: row;
        gap: 1rem;
    }

    .total-container {
        flex-direction: row;
    }
}

/* Tablets (iPad Mini and similar - 768px to 1023px) */
@media screen and (min-width: 768px) and (max-width: 1023px) {
    .row {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        padding: 1.5rem;
    }

    .col-md-8, .col-md-4 {
        width: 100%;
    }

    .name-column {
        min-width: 180px;
    }

    .order-type-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 2rem;
}


    .order-type-buttons button {
        min-width: 200px;
    }
}

/* Large Tablets to Small Laptops (1024px to 1279px) */
@media screen and (min-width: 1024px) and (max-width: 1279px) {
    .row {
        display: flex;
        flex-direction: row;
        gap: 2rem;
        padding: 2rem;
    }

    .col-md-8 {
        width: 100%;
    }

    .col-md-4 {
        width: 35%;
    }
}

/* Laptops and Larger (1280px and above - 13 inch and larger) */
@media screen and (min-width: 1280px) {
    .row {
        display: flex;
        flex-direction: row;
        gap: 3rem;
        padding: 2rem;
        max-width: 1440px;
        margin: 0 auto;
    }

    .col-md-8 {
        width: 70%;
    }

    .col-md-4 {
        width: 30%;
    }
}

/* Extra styles for better usability */
.cart-items-container {
    max-height: clamp(300px, 70vh, 800px);
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #cbd5e0 #f8fafc;
    -webkit-overflow-scrolling: touch;
}

/* Touch-friendly styles */
.remove-btn {
    min-width: clamp(2rem, 5vw, 2.5rem);
    min-height: clamp(2rem, 5vw, 2.5rem);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #e53e3e;
    background: none;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

/* Extra row styles */
.extra-row td {
    padding: clamp(0.25rem, 0.75vw, 0.75rem) clamp(0.5rem, 1vw, 1rem);
    font-size: clamp(0.75rem, 0.9vw, 0.875rem);
}

/* Smooth transitions */
.quantity-btn, .remove-btn, .order-type-buttons button {
    transition: all 0.2s ease-in-out;
}

/* Improved touch targets for mobile */
@media (pointer: coarse) {
    .quantity-btn,
    .remove-btn,
    .order-type-buttons button {
        min-height: 44px;
        min-width: 44px;
    }

    .cart-table td,
    .cart-table th {
        min-height: 44px;
    }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .cart-table th {
        border-bottom: 3px solid #000;
    }

    .cart-table td {
        border-bottom: 2px solid #000;
    }

    .remove-btn {
        color: #ff0000;
    }
}
</style>

<style>
    .btn-active {
      background-color: #ffc107; /* Active state color */
    }

    /* Add white text color for cart items */
    .cart-title,
    .cart-table,
    .cart-table th,
    .cart-table td,
    .product-name,
    .temperature,
    .extra-name,
    .extra-price,
    .quantity-controls span {
      color: #ffffff;
    }
  </style>

<style>
    /* ... existing styles ... */

    /* Recommended Products Section */
    .recommended-products {
        margin-top: 3rem;
        padding: 2rem 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .section-title {
        color: #ffc107;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        padding: 1rem 0;
    }

    .product-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-card .product-image {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .product-card .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .product-details {
        padding: 1rem;
        text-align: center;
    }

    .product-details .product-name {
        color: white;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .product-details .product-price {
        color: #ffc107;
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .add-to-cart-btn {
        background-color: #ffc107;
        color: #48321c;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        width: 100%;
    }

    .add-to-cart-btn:hover {
        background-color: #ffcd39;
        transform: translateY(-2px);
    }

    /* Responsive adjustments */
    @media screen and (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .product-card .product-image {
            height: 150px;
        }
    }

    @media screen and (max-width: 480px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }

        .product-details {
            padding: 0.8rem;
        }

        .product-details .product-name {
            font-size: 1rem;
        }

        .add-to-cart-btn {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>


</body>

</html>
