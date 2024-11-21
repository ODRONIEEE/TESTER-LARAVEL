<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Archive Cafe</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
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
          <li><a href="{{route('dashboard')}}">Cafe</a></li>
          <li><a href="{{route('menu')}}">Menu</a></li>
          <li><a href="{{route('dashboard')}}">Meet The Team</a></li>
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
          <li><a href="{{url('/')}}">Cafe</a></li>
          <li><a href="{{route('login')}}">Menu</a></li>
          <li><a href="{{url('/')}}">Meet The Team</a></li>
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


  <main class="main ">

    <div class="login-container">
        <div class="row text-center">
            <div class="col-10 col-md-5 mb-3">
                <form method="POST" action="{{route('register')}}">
                    @csrf
                    <img class="mb-3" src="assets/img/logo/logo2.png" alt="" height="270" width="270">
                    <img class="mb-3" src="assets/img/logoarchive.png" alt="" height="100" width="auto">
                    <h2 class="text-hero sub-hero mb-3 ">
                        Already a member? <a href="{{route('login')}}" style="color:white"><strong>Login</strong></a>
                    </h2>
                </div>
                <div class="col-2 col-md-2 mb-3"></div>
                <div class="col-10 col-md-5 mb-3">
                    <input type="text" id="name" name="name" placeholder="Name" class="login-input mb-2" required value="{{ old('name') }}">
                    @error('name')
                        <div class="error-message" style="color:red;">{{ $message }}</div>
                    @enderror
                    <input type="email" id="email" name="email" placeholder="Email Address" class="login-input mb-2" required value="{{ old('email') }}">
                    @error('email')
                        <div class="error-message" style="color:red;">{{ $message }}</div>
                    @enderror
                    <input type="password" id="password" name="password" placeholder="Password" class="login-input mb-2" required>
                    @error('password')
                        <div class="error-message" style="color:red;">{{ $message }}</div>
                    @enderror
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" class="login-input mb-2" required>
                    @error('password_confirmation')
                        <div class="error-message" style="color:red;">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn-login">Sign Up</button>
                </div>
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
    <style>
        main {
  margin-bottom: 0;
}
.signup-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px; /* Adjust padding as needed */

    /* ... other styles ... */
}

.input-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
    width: 100%; /* Ensure inputs take full width */

    /* ... other styles ... */
}

.input-field {
    /* ... other styles ... */
    width: 100%; /* Ensure inputs take full width */
}
    </style>
</body>
</html>
