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

</head>

<body class="index-page">

    @if (Route::has('login'))
        <header id="header" class="header d-flex align-items-center fixed-top">
          <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="{{route('dashboard')}}" class="logo d-flex align-items-center me-auto">
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
              <li><a href="{{route('dashboard')}}">Cafe</a></li>
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

        <div class="menu-container-light">
            <!-- Navbar for larger screens -->
            <nav class="category-menu-products d-none d-md-flex flex-wrap justify-content-center mb-3">
                <button class="custom-category-btn btn mx-2 my-1" data-type="all">All</button>
                <button class="custom-category-btn btn mx-2 my-1" data-type="1">Coffee</button>
                <button class="custom-category-btn btn mx-2 my-1" data-type="2">Non-Coffee</button>
                <button class="custom-category-btn btn mx-2 my-1" data-type="3">Refreshers</button>
                <button class="custom-category-btn btn mx-2 my-1" data-type="4">Tea</button>
                <button class="custom-category-btn btn mx-2 my-1" data-type="5">Appetizers</button>
                <button class="custom-category-btn btn mx-2 my-1" data-type="6">Pasta</button>
                <button class="custom-category-btn btn mx-2 my-1" data-type="7">Burger</button>
                <button class="custom-category-btn btn mx-2 my-1" data-type="8">Rice Meal</button>
                <button class="custom-category-btn btn mx-2 my-1" data-type="9">Pastries</button>
            </nav>
    <!-- Carousel for mobile screens -->
    <div id="categoryCarousel" class="carousel slide category-menu-products d-md-none mt-4" data-bs-ride="carousel" style="margin-bottom:40px">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="d-flex justify-content-center">
                    <button class="custom-category-btn btn mx-2 my-1" data-type="all">All</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <button class="custom-category-btn btn mx-2 my-1" data-type="1">Coffee</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <button class="custom-category-btn btn mx-2 my-1" data-type="2">Non-Coffee</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <button class="custom-category-btn btn mx-2 my-1" data-type="3">Refreshers</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <button class="custom-category-btn btn mx-2 my-1" data-type="4">Tea</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <button class="custom-category-btn btn mx-2 my-1" data-type="5">Appetizers</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <button class="custom-category-btn btn mx-2 my-1" data-type="6">Pasta</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <button class="custom-category-btn btn mx-2 my-1" data-type="7">Burger</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <button class="custom-category-btn btn mx-2 my-1" data-type="8">Rice Meal</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center">
                    <button class="custom-category-btn btn mx-2 my-1" data-type="9">Pastries</button>
                </div>
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

            <div id="food" class="row">
                <div class="container">
                 <div class="row" id="productContainer">
                        @foreach($products as $product)
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4 product-card" data-type="{{ $product->type_id }}" data-stock="{{ $product->stock > 0 ? 'true' : 'false' }}">
                                <div class="card text-center">
                                    <div class="card-img-top product-img" style="display: flex; align-items: center; justify-content: center;">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 100%; height: auto;">
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">₱ {{ $product->price }}</h5>
                                        <p class="card-text">{{ $product->name }}</p>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <div class="yellow-border"></div>

                                        @if ($product->stock > 0)
                                            @if (isset($product->cat_id))
                                                <a href="{{ route('orderProduct', ['id' => $product->id, 'cat_id' => $product->cat_id]) }}" class="btn btn-primary btn-order">Order</a>
                                            @else
                                                <span class="text-danger">Category not available</span>
                                            @endif
                                        @else
                                            <h5 class="card-title">SORRY</h5>
                                            <p class="card-text">SORRY</p>
                                            <p class="card-text">SORRY</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryButtons = document.querySelectorAll('.custom-category-btn');
            const productCards = document.querySelectorAll('.product-card');

            console.log('Total product cards:', productCards.length);

            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const type = this.getAttribute('data-type');
                    console.log('Button clicked:', type);
                    filterProducts(type);
                });
            });

            function filterProducts(type) {
                console.log('Filtering products for type:', type);
                let visibleCount = 0;
                productCards.forEach(card => {
                    const cardType = card.getAttribute('data-type');
                    const inStock = card.getAttribute('data-stock') === 'true';

                    console.log('Card type:', cardType, 'In stock:', inStock);

                    if ((type === 'all' || cardType === type) && inStock) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                console.log('Visible products after filtering:', visibleCount);
            }

            // Initially show all in-stock products
            filterProducts('all');
        });
        </script>

<style>
    @media (max-width: 767px) {
        #categoryCarousel .carousel-item {
            text-align: center;
        }
        #categoryCarousel .custom-category-btn {
            width: auto;
            margin: 0 auto;
        }
    }
</style>


</body>

</html>
