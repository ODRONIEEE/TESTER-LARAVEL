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

  </head>

<body class="index-page">

    @if (Route::has('login'))
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="{{url()->previous()}}" class="logo d-flex align-items-center me-auto">
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
          <li><a href="{{route('welcome')}}">Cafe</a></li>
          <li><a href="{{route('login')}}">Menu</a></li>
          <li><a href="{{route('welcome')}}">Meet The Team</a></li>
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


        <div class="menu-container-light-details " style="padding-top: 120px;">
            <div class="row mb-5">
                <div class="col-md-3 mb-4">
                    <div class="order-history">
                        <h3>Privacy</h3>
                    </div>
                </div>
                <div class="col-md-9">
                    <p class="text-yellow">Welcome to Cafe POSh, a Personalized Ordering System Hub Built for Archive
                        Cafe. By accessing or
                        using our website Cafe
                        POSh and/or our services, you agree to be bound by these Terms and Conditions ("Terms"). If you
                        do not agree to these
                        Terms, please do not use our Site or services.</p>
                    <p class="text-yellow">We reserve the right to modify or revise these Terms at any time. Any changes
                        will be effective
                        immediately upon posting
                        on the Site. Your continued use of the Site following any changes constitutes acceptance of
                        those changes.</p>
                    <p class="text-yellow">Upon using the site, the Management strictly implements the following:
                    </p>
                    <p class="text-yellow">We reserve the right to modify or revise these Terms at any time. Any changes
                        will be effective
                        immediately upon posting
                        on the Site. Your continued use of the Site following any changes constitutes acceptance of
                        those changes.</p>
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


    <!-- Main JS File -->
    <script src="{{url('assets/js/main.js')}}"></script>
    <script>
        document.querySelectorAll('.radio-options input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function () {

                document.querySelectorAll('.radio-options input[type="radio"]').forEach(input => {
                    const beforeStyle = input.parentNode.parentNode.querySelector('label:before');
                    if (beforeStyle) {
                        beforeStyle.style.background = 'white';
                        beforeStyle.style.border = '2px solid black';
                    }
                });


                const checkedLabel = this.closest('label');
                const checkedBefore = checkedLabel.querySelector('div:before');
                if (checkedBefore) {
                    checkedBefore.style.background = 'orange';
                    checkedBefore.style.border = '2px solid orange';
                }
            });
        });

    </script>
</body>

</html>
