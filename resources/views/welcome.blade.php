<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Archive Cafe</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('assets/img/logo/logo2.png')}}" rel="icon" type="image">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.8.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM8KA4jHQsc1osGZb8sdmFic2S1wIldw18AJzAf" crossorigin="anonymous">



</head>
<!-- Preloader -->
<div id="preloader"></div>

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
                  <h1 class="cafe-name"><strong>archive</strong> <span>cafe</span></h1>
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
                <h1 class="cafe-center cafe-name text-center d-md-none"><strong>archive</strong> <span>cafe</span></h1>
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
              <li><a href="#team">Meet The Team</a></li>
              <li class="nav-item d-none d-md-block">
                <span class="navbar-divider"></span>
              </li>

              <!-- CART LOGO -->
                <li class="nav-item">
                    <a href="{{ route('cart') }}" class="btn-icon-only">
                        CART
                        @if(isset($cartItemCount) && $cartItemCount > 0)
                            <span class="cart-item-count">{{ $cartItemCount }}</span>
                        @endif
                    </a>
                </li>

              <!-- USER LOGO -->
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
        <section id="hero" class="hero section light-background">

            <div class="container">
              <div class="row gy-4">
                <!-- Text content section -->
                <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start"
                style="margin-bottom: 34px;" data-aos="zoom-out">
                @auth
                <h2>Welcome Back! {{Auth::user()->name}}</h2>
                <p>You have made {{ $transactionCount }} {{ Str::plural('transaction', $transactionCount) }} with us!</p>

                @if($transactionCount >= 10)
                    <p class="member-status vip">🌟 VIP Member 🌟</p>
                @elseif($transactionCount >= 5)
                    <p class="member-status gold">✨ Gold Member ✨</p>
                    <p>Use SAVE20 for 20% off!</p>
                @endif

                @endauth

                <h1 class="archive-cafe-title">Archive Cafe</h1>
                  <p>“Brewing Timeless Moments”</p>
                  <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="#menu" class="btn-get-started">Hot Drinks!</a>
                  </div>
                </div>


              <!-- Image section -->
              <div class="col-lg-6  order-1 order-lg-2">
                <img src="{{asset('assets/img/coffee.png')}}" class="img-fluid cold-latte" alt="Cold Latte">
              </div>
            </div>
          </div>

          <!-- SVG shape divider -->
          <div class="custom-shape-divider-bottom-1727186153">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
              <path
                d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                class="shape-fill"></path>
            </svg>
          </div>
        </section>



        <section id="menu" class="about section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Try Our Best Selling!</h2>
            </div>

            <div class="container">
                <div class="row gy-4">
                    <div class="container" data-aos="zoom-in">
                        <div class="swiper bestseller-swiper">
                            <div class="swiper-wrapper align-items-center">

                                @if(isset($topProducts) && count($topProducts) > 0)
                                    @foreach($topProducts as $index => $product)
                                        <div class="swiper-slide">
                                            <div class="card card-slider">
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon text-center">
                                                        Top {{ $index + 1 }}
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <h4 class="text-center mb-3">{{ $product['product_name'] }}</h4>
                                                    <img
                                                        src="{{ asset($product['image']) }}"
                                                        class="img-fluid"
                                                        alt="{{ $product['product_name'] }}"
                                                        onerror="this.src='{{ asset('assets/img/products/default.png') }}'"
                                                    >
                                                    <div class="text-center mt-3">
                                                        <div class="price mt-2">₱{{ number_format($product['price'], 2) }}</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="swiper-slide">
                                        <div class="card card-slider">
                                            <div class="card-body text-center">
                                                <p>No best-selling products available yet</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>






          <!-- Team Section -->
        <section id="cafe" class="team  section">

          <!-- Section Title -->
          <div class="container section-title">
            <h2>How do we make our coffee?</h2>

          </div><!-- End Section Title -->

          <div class="container">

            <div class="row gy-4">


              <div class="col-lg-4"  data-aos-delay="10">
                <div class="team-member cafe d-flex align-items-start flex-column">
                  <p>A filipino inspired cafe that serves home made pasta and home blend drinks that compliments in every way</p>

                  <p>Having a signiture menu for their infused filipino culture flavours that enhances and defines the culture itself, with the motto “Brewing timeless moments”</p>

                  <p>It depicts how you can sit back, enoy a sip of cup creating memories whilst reminiscing past memories</p>


                  <p>Making yourself at home because that is what every filipino household holds.</p>
                </div>
              </div>


              <div class="col-lg-8"  data-aos-delay="10">
                <div class="team-member d-flex align-items-start">
                  <video controls autoplay loop muted width="100%">
                    <source src="assets/video/Archive Cafe - Video.mp4" type="video/mp4">
                  </video>
                </div>
              </div>

            </div>

          </div>
        </section><!-- /Team Section -->


        <!-- Team Section -->
        <section id="team" class="team section">

        <!-- Section Title -->
        <div class="container section-title" ">
          <h2>Meet the Team</h2>
          <p>Behind the scnes</p>
        </div><!-- End Section Title -->

          <div class="container">

            <div class="row gy-4">

            <div class="col-lg-6"  data-aos-delay="10">
              <div class="team-member d-flex align-items-start">
                <div class="pic"><img src="assets/img/team/quinn.png" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4>Quinn Vladimir Odron</h4>
                  <span>Project Manager</span>

                    <div class="social">

                    <a href="https://www.facebook.com/ODRON.JAMES"><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>

                    </div>
                  </div>
                </div>
              </div><!-- End Team Member -->

            <div class="col-lg-6"  data-aos-delay="10">
              <div class="team-member d-flex align-items-start">
                <div class="pic"><img src="assets/img/team/Christian Jay Demetria.jpg" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4>Christian Jay Demetria</h4>
                  <span>Senior Developer</span>

                  <div class="social">
                    <a href="https://www.facebook.com/jydmtr/"><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                  </div>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-6" data-aos-delay="10">
              <div class="team-member d-flex align-items-start">
                <div class="pic"><img src="assets/img/team/Andrei Lopez.jpg" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4>Andrei Lopez</h4>
                  <span>Frontend Developer</span>

                  <div class="social">
                    <a href="https://www.facebook.com/profile.php?id=100009023709764"><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                  </div>
                </div>
              </div>
            </div><!-- End Team Member -->

            <div class="col-lg-6"  data-aos-delay="10">
              <div class="team-member d-flex align-items-start">
                <div class="pic"><img src="assets/img/team/Harold Pineda.jpg" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4>Harold Pineda</h4>
                  <span>Frontend Developer</span>

                  <div class="social">
                    <a href="https://www.facebook.com/mr.pinedaa20"><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                  </div>
                </div>
              </div>
            </div><!-- End Team Member -->

            </div>

          </div>

        </section><!-- /Team Section -->

      </main>

      <footer id="footer" class="footer dark-background">
        <div class="container footer-top">
          <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
              <div class="footer-contact pt-3">
                <p>Jose Edmundo,</p>
                <p>Tarlac City, 2300 Tarlac</p>
                <p class="mt-3"><strong>Phone:</strong> <span>(04593) 17820</span></p>
                <p><strong>Email:</strong> <span>archivecafe.btm@gmail.com</span></p>
              </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
              <h4>Useful Links</h4>
              <ul>
                <li><i class="bi bi-chevron-right"></i> <a href="#" class="hover-orange">Home</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="#cafe" class="hover-orange">About us</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="{{route('privacy')}}" class="hover-orange">Privacy</a></li>
                <li><i class="bi bi-chevron-right"></i> <a href="{{route('Terms')}}" class="hover-orange">Terms and conditions</a></li>
              </ul>
            </div>



            <div class="col-lg-4 col-md-12">
              <h4>Follow Us</h4>
              <div class="social-links d-flex">
                <a href="https://www.facebook.com/ArchiveCafeBTM" class="hover-orange"><i class="bi bi-facebook"></i></a>
                <a href="" class="hover-orange"><i class="bi bi-instagram"></i></a>
              </div>
            </div>

          </div>
        </div>


      </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>


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
   <script src="{{asset('assets/js/main.js')}}"></script>
   <script src="{{asset('assets/js/drinks_menu.js')}}"></script>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.bestseller-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
        });
    });
</script>
<style>
    .hover-orange:hover {
      color: orange !important;
      transition: color 0.3s ease;
    }
  </style>
<style>
    .cart-item-count {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
}

</style>
<style>
    .bestseller-swiper {
        padding: 20px 40px;
    }

    .card-slider {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        margin: 10px;
    }

    .card-slider:hover {
        transform: translateY(-5px);
    }

    .card-slider img {
        max-height: 200px;
        object-fit: contain;
        width: 100%;
        padding: 15px;
    }

    .card-slider h4 {
        color: #333;
        font-size: 1.2rem;
        margin-bottom: 15px;
    }

    .badge {
        font-size: 0.9rem;
        padding: 8px 15px;
    }

    .price {
        font-size: 1.1rem;
        font-weight: bold;
        color: #2c3e50;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #333;
        background: rgba(255, 255, 255, 0.8);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 20px;
    }

    .swiper-pagination-bullet {
        background: #333;
    }

    .swiper-pagination-bullet-active {
        background: #2c3e50;
    }

    @media (max-width: 768px) {
        .bestseller-swiper {
            padding: 20px;
        }
    }
    </style>
</body>

</html>
