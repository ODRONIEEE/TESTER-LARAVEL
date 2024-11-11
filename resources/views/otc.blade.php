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
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Main CSS File -->
      <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/drinks_menu.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/menu_landing.css')}}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<body class="index-page">

    @if (Route::has('login'))
        <header id="header" class="header d-flex align-items-center fixed-top">
          <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="{{route('welcome')}}" class="logo d-flex align-items-center me-auto">
              <img src="{{ asset('assets/img/logo/logo2.png') }}" alt="">
            </a>
            @auth
            @if (Auth::user()->usertype === 'admin')
            <nav id="navmenu" class="navmenu">
                <ul>
                  <li class="nav-item cafe-center">
                    <h1 class="cafe-name">archive <span>cafe</span></h1>
                  </li>
                  <li><a href="{{route('admin.test')}}">POS</a></li>
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
              <li class="nav-item d-none d-md-block">
                <span class="navbar-divider"></span>
              </li>
              <!-- CART LOGO -->
              <a href="{{ route('cart') }}" class="btn-icon-only">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
              <!-- USER LOGO -->
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
        <div class="menu-container-light-details" style="padding-top: 150px;">
            <div class="row justify-content-center mb-5">
                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-sm-4 mb-3">
                            <div class="container-payment">   {{ Auth::user()->name }}</div>
                        </div>
                        <div class="col-sm-8">
                            <div class="container-payment">Payment Method</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 p-2 mr-4">
                            <p class="total-text">Total</p>
                        </div>
                        <div class="col-sm-8">
                            <div class="container-payment">₱{{ $totalPrice }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="thank-you-text">
                        “Thank you for Dining with us”
                    </h3>
                    <p class="waiting-time-text">
                        Expect a waiting time of 5-10 minutes on your order
                    </p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-6 mb-3">
                  <a href="{{ route('payment.page') }}" class="text-decoration-none">
                        <div class="container-otc" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#4f2d19'" onmouseout="this.style.backgroundColor='#3f2314'">
                            <h3 class="otc-header">Change payment?</h3>
                        </div>
                    </a>
                </div>
                <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                    @csrf
                    <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <input type="hidden" name="order_type" value="{{ $orderType }}">
                    <input type="hidden" name="p_method" value="{{ session('payment_method') }}">
                    <input type="hidden" name="products" value="{{ json_encode($orderData) }}">

                    <button class="btn btn-primary" type="button" id="proceedToPaymentButton">Proceed to Payment</button>
                </form>
            </div>

        </div>

    </main>


    <footer id="footer" class="footer-product text-center">

        <h1>"brewing timeless moments"</h1>
    </footer>

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
<script>
    document.getElementById('proceedToPaymentButton').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default form submission

        let formData = new FormData(document.getElementById('orderForm'));

        fetch("{{ route('order.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (confirm('Order placed successfully! ')) {
                    window.location.href = "{{ route('welcome') }}"; // Redirect to the welcome page
                }
            } else {
                alert('Failed to place the order.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
</script>




</body>

</html>
