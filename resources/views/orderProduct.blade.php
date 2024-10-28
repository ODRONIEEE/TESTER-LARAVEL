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
    <div class="menu-container-light-details">
        <a href="{{route('menu')}}" class-="btn btn-warning mt-3"> <button class="btn btn-warning mt-3">BACK</button></a>

        <div class="row">
            <!-- Left Section: Product Display -->

            <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
                <h1 class="page-header text-center" style="color:#ed8705;font-weight: 600;">Caramel Macchiato</h1>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <img class="img-fluid" src="assets/img/products/cold americano.png" alt="Card image cap">
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-12 mb-4" style="text-align: right;">
                        <h1 class="page-header">₱ 150.00</h1>
                        <div class="btn-group-wrapper">
                            <div class="btn-group">
                                <button class="btn btn-dark">H</button>
                                <button class="btn btn-warning">C</button>
                            </div>
                        </div>


                        <button class="btn btn-warning mt-3">Add to cart</button>

                    </div>
                </div>
                <div class="row">
                    <p class="product-description mt-3">
                        Features bold espresso layered over creamy milk finished with a rich caramel drizzle.
                        It's a perfectly balanced, sweet and refreshing treat for any time of day.
                    </p>
                </div>
            </div>

            <!-- Divider -->
            <div class="col-lg-2 col-md-6 col-sm-12 mb-4 product-divider d-none d-md-block"></div>

            <!-- Right Section: Extras -->
            <div class="col-lg-5 col-md-5 col-sm-12 mb-4">
                <h1 class="page-header text-center" style="color:#ed8705;font-weight: 600;">Extras</h1>
                <div class="extras-section">
                    <h4>Espresso</h4>
                    <div class="btn-group-wrapper justify-content-start">
                        <div class="btn-group">
                            <button class="btn btn-dark" style=" max-width: 70px;;">1</button>
                            <button class="btn btn-warning" style=" max-width: 70px;">2</button>
                        </div>
                    </div>
                    <h4 class="mt-4">Syrup</h4>
                    <div class="radio-options">
                        <label>
                            <div class="extra-container">
                                <input type="radio" name="syrup" value="roasted_almond">
                                Roasted Almond
                            </div>
                        </label>
                        <label>
                            <div class="extra-container">
                                <input type="radio" name="syrup" value="hazelnut" checked>
                                Hazelnut
                            </div>
                        </label>
                        <label>
                            <div class="extra-container">
                                <input type="radio" name="syrup" value="vanilla">
                                Vanilla
                            </div>
                        </label>
                    </div>

                    <h4 class="mt-4">Sauce</h4>
                    <div class="radio-options">
                        <label>
                            <div class="extra-container">
                                <input type="radio" name="sauce" value="chocolate" checked>
                                Chocolate
                            </div>
                        </label>
                        <label>
                            <div class="extra-container">
                                <input type="radio" name="sauce" value="caramel">
                                Caramel
                            </div>
                        </label>
                        <label>
                            <div class="extra-container">
                                <input type="radio" name="sauce" value="white_choco">
                                White Choco
                            </div>
                        </label>
                        <label>
                            <div class="extra-container">
                                <input type="radio" name="sauce" value="butterscotch">
                                Butterscotch
                            </div>
                        </label>
                        <label>
                            <div class="extra-container">
                                <input type="radio" name="sauce" value="salted_caramel">
                                Salted Caramel
                            </div>
                        </label>
                    </div>



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
</body>

</html>
