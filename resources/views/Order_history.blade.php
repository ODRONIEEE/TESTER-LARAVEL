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
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Dosis:wght@200;300;400;500;600;700;800&family=Aver&display=swap"
        rel="stylesheet">

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
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
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
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
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
        <div class="menu-container-light-details" style="padding-top: 150px;">
            <div class="row">
                <div class="col-12">
                    <h3 class="order-history-title mb-4">Order History</h3>
                    <div class="orders-container">
                        @foreach($orders->sortByDesc('created_at') as $order)
                        @if($order->customer_name == Auth::user()->name)
                        <div class="order-card">
                            <div class="order-header">
                                <div class="d-flex justify-content-between">
                                    <h5>Order #{{ $order->id }}
                                        @if($order->status =='Completed')
                                        <span class="badge badge-success">Completed</span>
                                        @else
                                        <span class="badge badge-light"></span>
                                        @endif

                                    </h5>
                                    <div class="order-meta">
                                        <span
                                            class="order-date">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y h:i A') }}</span>
                                        <span class="payment-badge">{{ $order->payment_method }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="order-details">
                                @foreach($order->products as $product)
                                <div class="product-row">
                                    <div class="product-info">

                                        <span class="product-name">{{ $product['name'] }}</span>
                                    </div>
                                    <div class="product-quantity">
                                        × {{ $product['quantity'] }}
                                    </div>
                                    <div class="product-price">
                                        ₱{{ number_format($product['price'] * $product['quantity'], 2) }}
                                    </div>
                                </div>
                                @endforeach

                                <div class="order-total">
                                    <span>Total Amount</span>
                                    <span class="total-price">₱{{ number_format($order->total_price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
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

    <!-- Add Bootstrap CSS and JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
        radio.addEventListener('change', function() {

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
    <script>
    var swiper = new Swiper('#orderSwiper', {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        slidesPerView: 1, // Show one slide at a time
        spaceBetween: 10, // Space between slides
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        }
    });
    </script>
    <style>
    .order-history-title {
        color: #333;
        font-weight: 600;
        padding-left: 20px;
    }

    .orders-container {
        padding: 0 20px;
    }

    .order-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .order-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }

    .order-header h5 {
        margin: 0;
        color: #2c3e50;
        font-weight: 600;
    }

    .order-meta {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .order-date {
        color: #666;
        font-size: 0.9rem;
    }

    .payment-badge {
        background: #e3f2fd;
        color: #1976d2;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .order-details {
        padding: 20px;
    }

    .product-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .product-row:last-child {
        border-bottom: none;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 15px;
        flex: 1;
    }

    .product-info img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-name {
        font-weight: 500;
        color: #2c3e50;
    }

    .product-quantity {
        color: #666;
        margin: 0 20px;
    }

    .product-price {
        font-weight: 500;
        color: #2c3e50;
        min-width: 100px;
        text-align: right;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 2px solid #eee;
    }

    .total-price {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1976d2;
    }

    @media (max-width: 768px) {
        .order-meta {
            flex-direction: column;
            align-items: flex-end;
            gap: 5px;
        }

        .product-info {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-quantity {
            margin: 10px 0;
        }
    }
    </style>
</body>

</html>
