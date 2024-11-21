<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Archive Cafe</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
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
      @endauth


    </div>
  </header>
  @endif

<main class="main">
    <div class="menu-container ">
        <div class="row">
            <div class="col-sm-4 sales-section ">
                <h1>Cup Count</h1>
                <div class="buttons">
                    <div class="item">
                        <button>Coffee</button>
                        <span id="coffee-count">{{ $categoryCounts['Coffee'] }}</span>
                    </div>
                    <div class="item">
                        <button>Non-Coffee</button>
                        <span id="non-coffee-count">{{ $categoryCounts['Non-Coffee'] }}</span>
                    </div>
                    <div class="item">
                        <button>Refreshers</button>
                        <span id="refreshers-count">{{ $categoryCounts['Refreshers'] }}</span>
                    </div>
                    <div class="item">
                        <button>Tea</button>
                        <span id="tea-count">{{ $categoryCounts['Tea'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 sales-section">
                <h1>Meals</h1>
                <div class="buttons">
                    <div class="item">
                        <button>Pastries</button>
                        <span id="pastries-count">{{ $categoryCounts['Pastries'] }}</span>
                    </div>
                    <div class="item">
                        <button>Pasta</button>
                        <span id="pasta-count">{{ $categoryCounts['Pasta'] }}</span>
                    </div>
                    <div class="item">
                        <button>Rice Meal</button>
                        <span id="rice-meal-count">{{ $categoryCounts['Rice Meal'] }}</span>
                    </div>
                    <div class="item">
                        <button>Appetizer</button>
                        <span id="appetizer-count">{{ $categoryCounts['Appetizer'] }}</span>
                    </div>
                    <div class="item">
                        <button>Burgers</button>
                        <span id="burgers-count">{{ $categoryCounts['Burgers'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3  sales-section">
                <h1>Sales</h1>
                <div class="buttons">
                    <div class="total-sales">
                        <p>Total Sales</p>
                        <span id="total-sales">Php {{ number_format($totalSales, 2) }}</span>
                    </div>
                    <br><br>
                    <div class="total-quantity">
                        <div class="item">
                            <button class="btn btn-lg" style="background-color: #ffffff;color: black;">Reset Sales</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="total-container">
                            Total Cups
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="cup-count">
                            {{ $categoryCounts['Coffee'] +
                               $categoryCounts['Non-Coffee'] +
                               $categoryCounts['Refreshers'] +
                               $categoryCounts['Tea'] }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="total-container">
                            Total Food
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="cup-count">{{ $categoryCounts['Pastries'] + $categoryCounts['Pasta'] + $categoryCounts['Rice Meal'] + $categoryCounts['Appetizer'] + $categoryCounts['Burgers'] }}</h2>
                    </div>
                </div>
            </div>
        </div>


           <div class="row mt-5">
                                <div class="col-12">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Total Price</th>
                                                <th>Payment Method</th>
                                                <th>Order Type</th>
                                                <th>Date Created</th>
                                                <th>Products</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($completedOrders->sortByDesc('created_at') as $order)
                                                <tr>
                                                    <td>{{ $order->customer_name }}</td>
                                                    <td>Php {{ number_format($order->total_price, 2) }}</td>
                                                    <td>{{ $order->p_method }}</td>
                                                    <td>{{ $order->order_type }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                                    <td>
                                                    <ul>
                                                    @foreach($order->products as $product)
                                                        <li>
                                                            <strong>{{ $product['name'] ?? 'Unnamed Product' }}</strong> - Quantity: {{ $product['quantity'] }}
                                                            @if(!empty($product['extras']) && is_array($product['extras']))
                                                                <ul>
                                                                    @foreach($product['extras'] as $extra)
                                                                        @if(is_array($extra)) <!-- Check if $extra is an array -->
                                                                            <li>{{ $extra['name'] ?? 'Unknown Extra' }} - Price: Php {{ number_format($extra['price'], 2) }}</li>
                                                                        @else
                                                                            <li>Invalid extra data</li> <!-- Handle invalid extra data -->
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                    </td>
                                                </tr>
                                            @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>



</main>

<footer id="footer" class="footer-product background-dark text-center">
    <h1>"brewing timeless moments"</h1>
</footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>
<!-- DataTable CSS -->
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTable JS -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- Vendor JS Files -->
<script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{url('assets/vendor/aos/aos.js')}}"></script>
<script src="{{url('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{url('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{url('assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
<script src="{{url('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{url('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

<!-- Main JS File -->
<script src="{{url('assets/js/main.js')}}"></script>
<script src="{{url('assets/js/drinks_menu.js')}}"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable on the table
        $('.table').DataTable({
            responsive: true,  // Makes the table responsive on smaller screens
            pageLength: 10,    // Set default number of records per page
            lengthMenu: [10, 25, 50, 100]  // Options for the number of records per page
        });
    });

</script>

</body>

</html>
