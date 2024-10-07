<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Archive Cafe</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logo/logo.png" rel="icon">


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
                                    <li><a href="#team">Meet The Team</a></li>
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
                            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                        </nav>
            @endauth
            </div>
        </header>
  @endif



  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

        <div class="container">
          <div class="row gy-4">
            <!-- Text content section -->
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
              <h1>Archive Cafe</h1>
              <p>“Brewing Timeless Moments”</p>
              <div class="d-flex">
                <a href="#menu" class="btn-get-started">Hot Drinks!</a>
              </div>
            </div>

            <!-- Image section -->
            <div class="col-lg-6 order-1 order-lg-2 hero-img position-relative" data-aos="zoom-out" data-aos-delay="200">
              <img src="assets/img/products/cold cafe latte.png" class="img-fluid cold-latte" alt="Cold Latte">
              <img src="assets/img/products/hot caffe late.png" class="img-fluid hot-latte" alt="Hot Latte">
              <img src="assets/img/products/splash-removebg-preview.png" class="img-fluid splash" alt="Splash">
            </div>
          </div>

        </div>
        <div class="custom-shape-divider-bottom-1727186153">
          <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
              d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
              class="shape-fill"></path>
          </svg>
        </div>
      </section><!-- /Hero Section -->


      <section id="menu" class="about section ">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Try Our Best Selling!</h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="container" data-aos="zoom-in">
            <div class="swiper init-swiper">
              <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": 3,
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 1,
                    "spaceBetween": 20
                  },
                  "480": {
                    "slidesPerView": 2,
                    "spaceBetween": 40
                  },
                  "768": {
                    "slidesPerView": 3,
                    "spaceBetween": 60
                  },
                  "992": {
                    "slidesPerView": 3,
                    "spaceBetween": 80
                  },
                  "1200": {
                    "slidesPerView": 3,
                    "spaceBetween": 100
                  }
                }
              }
            </script>

              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide ">
                  <h2 class="text-center">Hot Americano</h2>
                  <div class=" card card-slider">
                    <img src="assets/img/products/hot caffe late.png" class=" img-fluid" alt="">
                  </div>
                </div>


                <div class="swiper-slide ">
                  <h2 class="text-center">Refresher Green Apple</h2>
                  <div class=" card card-slider">
                    <img src="assets/img/products/refresher green apple.png" class=" img-fluid" alt="">
                  </div>
                </div>

                <div class="swiper-slide ">
                  <h2 class="text-center">Refresher kiwi</h2>
                  <div class=" card card-slider">
                    <img src="assets/img/products/refresher kiwi.png" class=" img-fluid" alt="">
                  </div>
                </div>


                <div class="swiper-slide ">
                  <h2 class="text-center">Cold Americano</h2>
                  <div class=" card card-slider">
                    <img src="assets/img/products/cold cafe latte.png" class=" img-fluid" alt="">
                  </div>
                </div>


                <div class="swiper-slide ">
                  <h2 class="text-center">Refreshers Passion Fruit</h2>
                  <div class=" card card-slider">
                    <img src="main/img/products/refreshers passion fruit.png" class=" img-fluid" alt="">
                  </div>
                </div>

                <div class="swiper-slide ">
                  <h2 class="text-center">Refresher Lychee</h2>
                  <div class=" card card-slider">
                    <img src="main/img/products/Refresher lychee.png" class=" img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Section -->
    <section id="cafe" class="team  section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>How do we make our coffee?</h2>

      </div>
      <!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">


          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="10">
            <div class="team-member cafe d-flex align-items-start flex-column">
              <p>A filipino inspired cafe that serves home made pasta and home blend drinks that compliments in every way</p>

              <p>Having a signiture menu for their infused filipino culture flavours that enhances and defines the culture itself, with the motto “Brewing timeless moments”</p>

              <p>It depicts how you can sit back, enoy a sip of cup creating memories whilst reminiscing past memories</p>

              <p>Making yourself at home because that is what every filipino household holds.</p>
            </div>
          </div>


          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member d-flex align-items-start">
              <video controls autoplay loop muted width="700">
                <source src="assets/video/Archive Cafe - Video.mp4" type="video/mp4">
              </video>
            </div>
          </div>

        </div>

      </div>

    </section>



    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Meet the Team</h2>
        <p>Behind the scenes</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6" >
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/Quinn Vladimir Odron.HEIC" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Quinn Vladimir Odron</h4>
                <span>Project Manager</span>

                <div class="social">

                  <a href="https://www.facebook.com/ODRON.JAMES/"><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>

                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6"  >
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/Christian Jay Demetria.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Christian Jay Demetria</h4>
                <span>Senior Developer</span>

                <div class="social">
                  <a href="https://www.facebook.com/jydmtr"><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" >
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

          <div class="col-lg-6" >
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
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#cafe">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{route('privacy')}}">Privacy</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{route('terms')}}">Terms and conditions</a></li>
          </ul>
        </div>



        <div class="col-lg-4 col-md-12">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="https://www.facebook.com/ArchiveCafeBTM"><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>

          </div>
        </div>

      </div>
    </div>


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
