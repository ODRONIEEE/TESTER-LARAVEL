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
            <div class="col-md-2 mb-4">
                <div class="order-history">
                    <h3>Cart</h3>
                </div>
            </div>

            <div class="col-md-5">
                <div class="order-container">
                    @php
                        $cart = session('cart', []);
                        $totalItems = array_sum(array_column($cart, 'quantity'));
                        $totalPrice = 0;
                    @endphp

                    @if($totalItems > 0)
                        <h2>Your Cart</h2>
                        <p>You have {{ $totalItems }} item(s) in your cart.</p>

                        <!-- Display cart items here -->
                        <form id="cart-form" action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            @foreach($cart as $item)
                            @php
                                $basePrice = $originalBasePrice = $item['price'] * $item['quantity'];
                                $extrasTotal = 0;
                            @endphp
                            <div class="cart-item" id="cart-item-{{ $item['id'] }}">
                                <div class="item-details">
                                    <input type="checkbox" name="selected_items[]" value="{{ $item['id'] }}" id="item_{{ $item['id'] }}" checked>
                                    <label for="item_{{ $item['id'] }}">
                                        <strong>{{ $item['name'] }}</strong><br>
                                        Quantity: {{ $item['quantity'] }} - Base Price: ${{ number_format($basePrice, 2) }}
                                        @if(isset($item['temperature']))
                                            ({{ ucfirst($item['temperature']) }})
                                        @endif
                                    </label>
                                </div>

                                @if(isset($item['extras']) && !empty($item['extras']))
                                    <div class="extras-details">
                                        <strong>Extras:</strong>
                                        <ul>
                                            @foreach($item['extras'] as $extra => $value)
                                                @if(is_bool($value) && $value || !is_bool($value) && !empty($value))
                                                    @php
                                                        $extraPrice = is_array($value) && isset($value['price']) ? $value['price'] : 0;
                                                        $extrasTotal += $extraPrice;
                                                    @endphp
                                                    <li>
                                                        {{ ucfirst($extra) }}:
                                                        @if(is_bool($value))
                                                            Yes
                                                        @elseif(is_array($value))
                                                            @php
                                                                $displayValue = array_map(function($v) {
                                                                    return is_array($v) ? implode(', ', array_filter($v)) : $v;
                                                                }, array_filter($value));
                                                                echo implode(', ', $displayValue);
                                                            @endphp
                                                        @else
                                                            {{ $value }}
                                                        @endif
                                                        @if($extraPrice > 0)
                                                            (+${{ number_format($extraPrice, 2) }})
                                                        @endif
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @php
                                    $itemTotal = ($basePrice * $item['quantity']) + ($extrasTotal * $item['quantity']);
                                    $totalPrice += $itemTotal;
                                @endphp

                                <div class="item-total">
                                    Item Total: ${{ number_format($itemTotal, 2) }}
                                </div>

                                <button type="button" class="btn btn-sm btn-danger remove-item" data-id="{{ $item['id'] }}">Remove</button>
                            </div>
                        @endforeach


                            <button type="submit" class="btn btn-primary mt-3">Update Cart</button>
                        </form>

                        <p>Total: ${{ number_format($totalPrice, 2) }}</p>
                    @else
                        <h2>Uy! Kamusta</h2>
                        <h3>Your cart is empty. Check out our menu to find goodies there!</h3>
                        <a class="menu" href="{{ route('menu') }}">Menu</a>
                    @endif
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
                    updateCartSummary();
                }
            });
        }

        function updateCartSummary() {
            const cartItems = document.querySelectorAll('.cart-item');
            const totalItemsElement = document.querySelector('p:contains("You have")');
            const totalPriceElement = document.querySelector('p:contains("Total:")');

            let totalItems = 0;
            let totalPrice = 0;

            cartItems.forEach(item => {
                const quantityMatch = item.textContent.match(/Quantity: (\d+)/);
                const priceMatch = item.textContent.match(/Price: \$(\d+\.\d+)/);

                if (quantityMatch && priceMatch) {
                    const quantity = parseInt(quantityMatch[1]);
                    const price = parseFloat(priceMatch[1]);
                    totalItems += quantity;
                    totalPrice += quantity * price;
                }
            });

            if (totalItemsElement) {
                totalItemsElement.textContent = `You have ${totalItems} item(s) in your cart.`;
            }
            if (totalPriceElement) {
                totalPriceElement.textContent = `Total: $${totalPrice.toFixed(2)}`;
            }

            if (totalItems === 0) {
                location.reload(); // Reload the page if cart is empty
            }
        }
    });
    </script>

</body>

</html>
