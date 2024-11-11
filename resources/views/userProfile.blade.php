<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Archive Cafe</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('assets/img/logo/logo2.png')}}" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

  <style>
    /* Responsive layout for Profile Dashboard */
    .menu-container-light-details {
        padding-top: 150px;
    }

    .menu-container-light-details .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .btn-dashboard {
        width: 100%;
        margin-bottom: 10px;
    }

    /* Single row layout */
    .dashboard-row {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        align-items: center;
    }

    .dashboard-column {
        padding: 0px 38px;
    }

    .dashboard-column img {
        max-width: 100%;
        height: auto;
    }



    @media (max-width: 768px) {
        .dashboard-row {
            flex-direction: column;
            align-items: center;
        }

        .dashboard-column img {
            margin-top: 20px;
        }

        .header-hero {
            font-size: 3rem;
        }
    }

    /* Adjust button layout for small screens */
    @media (max-width: 576px) {
        .btn-dashboard {
            font-size: 14px;
        }
    }
</style>

</head>

<body class="index-page">


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
          <li><a href="#cafe">Cafe</a></li>
          <li><a href="{{route('menu')}}">Menu</a></li>
          <li><a href="#Team">Meet The Team</a></li>
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
              <li><a href="{{route('profile.edit')}}">Edit Account</a></li>

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

    <div class="menu-container-light-details">
        <div class="text-hero mb-5">
            <h1 class="text-hero header-hero" style="color : #ed8705"> Profile Dashboard</h1>
        </div>

        <div class="row text-center">
            <!-- Left Column: Buttons -->
            <div class="col-lg-4 col-md-12">
                <button class="btn-dashboard w-100 mb-2" onclick="window.location.href='{{route('Order_history')}}'">Order History</button>
            </div>
            <div class="col-lg-4 col-md-12">
                <button class="btn-dashboard w-100 mb-2" onclick="window.location.href='{{route('privacy')}}'">Privacy</button>
                <button class="btn-dashboard w-100 mb-2" onclick="window.location.href='{{route('Terms')}}'">Terms and Conditions</button>
            </div>
            <!-- Right Column: Logo and Text -->
            <div class="col-lg-4 col-md-12">
                <img class="mb-3" src="assets/img/logo/logo2.png" alt="Logo" height="270" width="270">
                <br>
                <img class="mb-3" src="assets/img/logoarchive.png" alt="Logo Archive" height="100">
            </div>
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

</body>

</html>
