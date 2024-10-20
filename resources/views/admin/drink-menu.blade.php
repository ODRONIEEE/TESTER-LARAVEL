<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Archive Cafe</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon" type="image">
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


        <div class="menu-container ">
            <nav class="category-menu d-flex justify-content-around align-items-center flex-wrap mb-3">s
                <a class="custom-category-btn" href="{{ url()->previous() }}">Back</a>
                <button type="submit" class="custom-category-btn" onclick="showCategory('coffee')">Coffee</button>
                <button class="custom-category-btn" onclick="showCategory('non-coffee')">Non-Coffee</button>
                <button class="custom-category-btn" onclick="showCategory('refreshers')">Refreshers</button>
                <button class="custom-category-btn" onclick="showCategory('tea')">Tea</button>
            </nav>

            <div id="coffee-non" class="row menu-content" style="display:none">
                <!-- Product Buttons inside the box -->
                <div id="menu-items-coffee" class="col-lg-3 col-md-4 col-sm-12 menu-items" style="display:none">
                    <!-- Coffee Product Buttons -->
                </div>

                <!-- Product Selection and Customization -->
                <div class="col-lg-9 col-md-8 col-sm-12 product-details">
                    <h2 id="product-name" class="text-center mb-4"></h2>
                    <div class="customization-options">


                        <!-- Type and Quantity in 1 Row -->
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3>Type</h3>
                                <button class="custom-btn" onclick="setTemperature('hot')">Hot</button>
                                <button class="custom-btn" onclick="setTemperature('cold')">Cold</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3>Quantity</h3>
                                <button class="custom-btn" onclick="adjustQuantity(-1)">-</button>
                                <span id="quantity-count" class="mx-3">0</span>
                                <button class="custom-btn" onclick="adjustQuantity(1)">+</button>
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3>Extras</h3>
                                <button class="custom-btn" onclick="setMilk('regular')">Regular Milk</button>
                                <button class="custom-btn" onclick="setMilk('oat')">Oat Milk</button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3> </h3>
                                <button class="custom-btn" onclick="setMilk('regular')">Dine In</button>
                                <button class="custom-btn" onclick="setMilk('oat')">Take Out</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3>Espresso Shots</h3>
                                <button class="custom-btn" onclick="adjustShots(-1)">-</button>
                                <span id="shots-count" class="mx-3">0</span>
                                <button class="custom-btn" onclick="adjustShots(1)">+</button>
                            </div>

                        </div>

                        <!-- Syrups and Quantity in 1 Row -->
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3>Syrup</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <button class="custom-btn" onclick="selectSyrup('roasted-almonds')">Roasted
                                        Almonds</button>
                                    <button class="custom-btn" onclick="selectSyrup('vanilla')">Vanilla</button>
                                    <button class="custom-btn" onclick="selectSyrup('hazelnut')">Hazelnut</button>
                                    <button class="custom-btn" onclick="selectSyrup('strawberry')">Strawberry</button>
                                    <!-- Add more syrup buttons here -->
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3>Sauce</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <button class="custom-btn" onclick="selectSyrup('roasted-almonds')">White
                                        Choco</button>
                                    <button class="custom-btn" onclick="selectSyrup('vanilla')">Chocolate</button>
                                    <button class="custom-btn" onclick="selectSyrup('hazelnut')">Salted Caramel</button>
                                    <button class="custom-btn" onclick="selectSyrup('strawberry')">Caramel</button>
                                    <button class="custom-btn" onclick="selectSyrup('strawberry')">Butterscotch</button>
                                    <button class="custom-btn" onclick="selectSyrup('strawberry')">Dulce</button>
                                    <button class="custom-btn" onclick="selectSyrup('strawberry')">Con Leche</button>
                                </div>
                            </div>
                        </div>
                        <!-- Total Price -->
                        <div class="total-price mb-3 text-end">
                            <h3>Total: Php <span id="total-price">000.00</span></h3>
                        </div>

                        <!-- Place Order -->
                        <button class="custom-btn place-order w-100" onclick="placeOrder()">Place Order</button>
                    </div>
                </div>
            </div>

            <div id="refreshers-non" class="row menu-content" style="display:none">
                <!-- Product Buttons inside the box -->
                <div id="menu-items-refreshers" class="col-lg-3 col-md-4 col-sm-12 menu-items" style="display:none">
                    <!-- Coffee Product Buttons -->
                </div>

                <!-- Product Selection and Customization -->
                <div class="col-lg-9 col-md-8 col-sm-12 product-details">
                    <h2 id="product-name" class="text-center mb-4"></h2>
                    <div class="customization-options">

                        <!-- Quantity Only -->
                        <div class="row mb-3 justify-content-center">
                            <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                <h3>Quantity</h3>
                                <button class="custom-btn" onclick="adjustQuantity(-1)">-</button>
                                <span id="quantity-count" class="mx-3">0</span>
                                <button class="custom-btn" onclick="adjustQuantity(1)">+</button>
                            </div>
                        </div>

                        <!-- Dine In and Take Out Buttons -->
                        <div class="row mb-3 justify-content-center">
                            <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                <button class="custom-btn w-50" onclick="setOrderType('dine-in')">Dine In</button>
                                <button class="custom-btn w-50 mt-2" onclick="setOrderType('take-out')">Take
                                    Out</button>
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="total-price mb-3 text-center">
                            <h3>Total: Php <span id="total-price">000.00</span></h3>
                        </div>

                        <!-- Place Order -->
                        <div class="text-center">
                            <button class="custom-btn place-order w-50" onclick="placeOrder()">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <footer id="footer" class="footer dark-background text-center">
        <h1>"brewing timeless moments"</h1>
      </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
    <script src="{{asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{url('assets/js/main.js')}}"></script>
    <script src="{{url('assets/js/drinks_menu.js')}}"></script>
</body>

</html>
