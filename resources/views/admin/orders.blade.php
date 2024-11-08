<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Archive Cafe</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Dosis:wght@200;300;400;500;600;700;800&family=Aver&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Main CSS File -->
      <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/drinks_menu.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/menu_landing.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  </head>

<body class="index-page">

    @if (Route::has('login'))
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{route('admin.dashboard')}}" class="logo d-flex align-items-center me-auto">
          <img src="{{asset('assets/img/logo/logo.png')}}" alt="">
        </a>
        @auth
        <nav id="navmenu" class="navmenu">
          <ul>
            <li class="nav-item cafe-center">
              <h1 class="cafe-name">archive <span>cafe</span></h1>
            </li>

            <li class="nav-item d-none d-md-block">
              <span class="navbar-divider"></span>
            </li>
            <li>
                <button class="btn-icon-only" id="dropdownMenuButton" aria-expanded="false" width="30px">
                  <i class="fa-solid fa-cart-shopping"></i>
                </button>
            </li>
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
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      @endauth


    </div>
  </header>
  @endif

    <main class="main">


      <div class="menu-container">


<nav class="category-menu d-flex justify-content-around flex-wrap mb-3">
    <a class="custom-category-btn" href="{{ url()->previous() }}">Back</a>
<button class="custom-category-btn" onclick="showOrder('pending')">Pending</button>
<button class="custom-category-btn" onclick="showOrder('onprocess')">On Process</button>
<button class="custom-category-btn" onclick="showOrder('completed')">Completed</button>


</nav>

<div class="row">
    <div class="container" data-aos="zoom-in">

        <!-- Swiper for Pending Orders -->
        <div id="pending-orders" class="swiper-container order-tab init-swiper" style="display: none;">
            <div class="swiper-wrapper align-items-center">
              @foreach($orders as $order)
                   @if($order->status == 'Pending')
                   <div class="col-lg-3 col-md-8 col-sm-12 product-details swiper-slide">
                        <h2 id="product-name" class="text-center mb-4">{{ $order->customer_name }}</h2>
                        <div class="customization-options">
                            <div class="row mb-3 justify-content-center">
                                <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                    <h3>Order #{{ $order->id }}</h3>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                    <h3>{{ $order->order_type }}</h3>
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <h3>Product</h3>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <h3>QTY</h3>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <h3>Price</h3>
                                </div>
                            </div>

                            <!-- Products Section -->
                            @foreach ($order->products as $product)
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $product['name'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $product['quantity'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $product['price'] ?? 'N/A' }}</h3>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Extras Section -->
                            <div class="row mb-3 justify-content-center">
                                <div class="col-12 text-center">
                                    <h3>Extras</h3>
                                </div>
                            </div>
                            @foreach ($order->extras as $extra)
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $extra['name'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $extra['quantity'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $extra['price'] ?? 'N/A' }}</h3>
                                    </div>
                                </div>
                            @endforeach

                            <div class="text-center">
                           <button class="custom-btn place-order w-50" onclick="updateOrderStatus({{ $order->id }}, 'On Process')">On Process</button>
                            <button class="custom-btn void-order w-50" onclick="deleteOrder({{ $order->id }})">Void</button>
                            </div>
                        </div>
                    </div>
                      @endif
                @endforeach
            </div>
        </div>

        <!-- Swiper for Completed Orders -->
        <div id="onprocess-orders" class="swiper-container order-tab init-swiper" style="display: none;">
            <div class="swiper-wrapper align-items-center">
               @foreach($orders as $order)
                   @if($order->status == 'On Process')
                    <div class="col-lg-3 col-md-8 col-sm-12 product-details swiper-slide">
                        <h2 id="product-name" class="text-center mb-4">{{ $order->customer_name }}</h2>
                        <div class="customization-options">
                            <div class="row mb-3 justify-content-center">
                                <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                    <h3>Order #{{ $order->id }}</h3>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                    <h3>{{ $order->order_type }}</h3>
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <h3>Product</h3>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <h3>QTY</h3>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <h3>Price</h3>
                                </div>
                            </div>

                            <!-- Products Section -->
                            @foreach ($order->products as $product)
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $product['name'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $product['quantity'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $product['price'] ?? 'N/A' }}</h3>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Extras Section -->
                            <div class="row mb-3 justify-content-center">
                                <div class="col-12 text-center">
                                    <h3>Extras</h3>
                                </div>
                            </div>
                            @foreach ($order->extras as $extra)
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $extra['name'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $extra['quantity'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $extra['price'] ?? 'N/A' }}</h3>
                                    </div>
                                </div>
                            @endforeach

                    <div class="text-center">
                           <button class="custom-btn place-order w-50" onclick="updateOrderStatus({{ $order->id }}, 'Notify')">Notify</button>
                            <button class="custom-btn void-order w-50" onclick="updateOrderStatus({{ $order->id }}, 'Completed')">Completed</button>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div id="completed-orders" class="swiper-container order-tab init-swiper" style="display: none;">
            <div class="swiper-wrapper align-items-center">
              @foreach($orders as $order)
                @if($order->status == 'Completed')
                     <div class="col-lg-3 col-md-8 col-sm-12 product-details swiper-slide">
                        <h2 id="product-name" class="text-center mb-4">{{ $order->customer_name }}</h2>
                        <div class="customization-options">
                            <div class="row mb-3 justify-content-center">
                                <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                    <h3>Order #{{ $order->id }}</h3>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                    <h3>{{ $order->order_type }}</h3>
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <h3>Product</h3>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <h3>QTY</h3>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <h3>Price</h3>
                                </div>
                            </div>

                            <!-- Products Section -->
                            @foreach ($order->products as $product)
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $product['name'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $product['quantity'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $product['price'] ?? 'N/A' }}</h3>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Extras Section -->
                            <div class="row mb-3 justify-content-center">
                                <div class="col-12 text-center">
                                    <h3>Extras</h3>
                                </div>
                            </div>
                            @foreach ($order->extras as $extra)
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $extra['name'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $extra['quantity'] ?? 'N/A' }}</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                        <h3>{{ $extra['price'] ?? 'N/A' }}</h3>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>




</div>





        <footer id="footer" class="footer dark-background text-center">
            <h1>"brewing timeless moments"</h1>
          </footer>
    </main>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{url('assets/vendor/aos/aos.js')}}"></script>
<script src="{{url('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{url('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{url('assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
<script src="{{url('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{url('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

<!-- Main JS File -->
<script src="{{url('assets/js/main.js')}}"></script>
<script src="{{url('assets/js/drinks_menu.js')}}"></script>

<script>
function showOrder(status) {
    // Hide all order tabs
    document.querySelectorAll('.order-tab').forEach(tab => {
        tab.style.display = 'none';
    });

    // Ensure the status matches the element IDs (e.g., "on-process-orders")
    const selectedTab = document.getElementById(`${status}-orders`);

    if (selectedTab) {
        selectedTab.style.display = 'block';

        // Initialize Swiper for the displayed tab if not already initialized
        if (!selectedTab.classList.contains('swiper-initialized')) {
            new Swiper(`#${status}-orders`, {
                loop: true,
                speed: 600,
                autoplay: {
                    delay: 5000
                },
                slidesPerView: 3,
                pagination: {
                    el: ".swiper-pagination",
                    type: "bullets",
                    clickable: true
                },
                breakpoints: {
                    320: { slidesPerView: 1, spaceBetween: 20 },
                    480: { slidesPerView: 2, spaceBetween: 40 },
                    768: { slidesPerView: 3, spaceBetween: 60 },
                    992: { slidesPerView: 3, spaceBetween: 80 },
                    1200: { slidesPerView: 3, spaceBetween: 100 }
                }
            });
            selectedTab.classList.add('swiper-initialized');
        }
    } else {
        console.error(`Tab with ID ${status}-orders not found.`);
    }
}

function deleteOrder(orderId) {
    if (confirm('Are you sure you want to void this order? This action cannot be undone.')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            console.error("CSRF token not found.");
            return;
        }

        fetch(`/delete-order/${orderId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order has been voided and deleted successfully.');
                // Refresh the page or update the UI
                location.reload();
            } else {
                alert('Failed to void order.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function updateOrderStatus(orderId, status) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        console.error("CSRF token not found.");
        return;
    }

    fetch(`/update-order-status/${orderId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let message;
            switch (status.toLowerCase()) {
                case 'pending':
                    message = 'Order set to Pending successfully.';
                    showOrder('pending');
                    break;
                case 'completed':
                    message = 'Order Completed successfully.';
                    showOrder('completed');
                    break;
                case 'on process':
                    message = 'Order is now On Process.';
                    showOrder('onprocess');
                    break;
                default:
                    message = 'Order status updated successfully.';
            }
            alert(message);
        } else {
            alert('Failed to update order status.');
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>
</body>

</html>
