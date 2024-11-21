<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Archive Cafe</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="menu-container">
    <nav class="category-menu d-flex justify-content-around flex-wrap mb-3">
        <a class="custom-category-btn" href="{{route('admin.dashboard')}}">Back</a>
        <button class="custom-category-btn" onclick="showOrder('pending')">Pending</button>
        <button class="custom-category-btn" onclick="showOrder('onProcess')">On Process</button>
    </nav>

    <div class="row">
        <div class="container" data-aos="zoom-in">
            <!-- Swiper for Pending Orders -->
            <div id="pending-orders" class="order-tab">
                <div class="table-responsive">
                    @php
                        $hasPendingOrders = $orders->contains('status', 'Pending');
                    @endphp

                    @if($hasPendingOrders)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order Details</th>
                                    <th>Products</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @if($order->status == 'Pending')
                                        <tr>
                                            <td>
                                                <div class="order-info">
                                                    <h4>Customer: {{ $order->customer_name }}</h4>
                                                    <p>Order #{{ $order->id }}</p>
                                                    <p>Total: ₱{{ number_format($order->total_price, 2) }}</p>
                                                    <p>Payment: {{$order->p_method}}</p>
                                                    <p>Type: {{ $order->order_type }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Type</th>
                                                            <th>QTY</th>
                                                            <th>Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->products as $product)
                                                            <tr>
                                                                <td>{{ $product['name'] }}</td>
                                                                <td>
                                                                    @if(isset($product['temperature']))
                                                                        <span class="badge bg-info">{{ $product['temperature'] }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $product['quantity'] }}</td>
                                                                <td>₱{{ number_format($product['price'], 2) }}</td>
                                                            </tr>
                                                            @if(!empty($product['extras']))
                                                                @foreach ($product['extras'] as $extra)
                                                                    <tr class="table-light">
                                                                        <td class="ps-4">+ {{ $extra['name'] }}</td>
                                                                        <td></td>
                                                                        <td>{{ $extra['quantity'] }}</td>
                                                                        <td>₱{{ number_format($extra['price'], 2) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <button class="btn btn-primary" onclick="updateOrderStatus({{ $order->id }}, 'On Process')">On Process</button>
                                                    <button class="btn btn-danger" onclick="deleteOrder({{ $order->id }})">Void</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center p-5" style="color: orange">
                            <p class="h2 fw-bold">No pending orders at the moment</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Swiper for On Process Orders -->
            <div id="onProcess-orders" class="order-tab" style="display: none;">
                <div class="table-responsive">
                    @php
                        $hasOnProcessOrders = $orders->contains('status', 'On Process');
                    @endphp

                    @if($hasOnProcessOrders)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order Details</th>
                                    <th>Products</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @if($order->status == 'On Process')
                                        <tr>
                                            <td>
                                                <div class="order-info">
                                                    <h4>Customer: {{ $order->customer_name }}</h4>
                                                    <p>Order #{{ $order->id }}</p>
                                                    <p>Total: ₱{{ number_format($order->total_price, 2) }}</p>
                                                    <p>Payment: {{$order->p_method}}</p>
                                                    <p>Type: {{ $order->order_type }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>QTY</th>
                                                            <th>Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->products as $product)
                                                            <tr>
                                                                <td>{{ $product['name'] }}</td>
                                                                <td>{{ $product['quantity'] }}</td>
                                                                <td>₱{{ number_format($product['price'], 2) }}</td>
                                                            </tr>
                                                            @if(!empty($product['extras']))
                                                                @foreach ($product['extras'] as $extra)
                                                                    <tr class="table-light">
                                                                        <td class="ps-4">+ {{ $extra['name'] }}</td>
                                                                        <td>{{ $extra['quantity'] }}</td>
                                                                        <td>₱{{ number_format($extra['price'], 2) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <button class="btn btn-primary" onclick="updateOrderStatus({{ $order->id }}, 'Completed')">Completed</button>
                                                    <button class="btn btn-danger" onclick="deleteOrder({{ $order->id }})">Void</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center p-5">
                            <h3>No orders in process at the moment</h3>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>





        <footer id="footer" class="footer dark-background text-center">
            <h1>"brewing timeless moments"</h1>
          </footer>
    </main>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

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
function showOrder(status) {
    // Hide all order tabs
    document.querySelectorAll('.order-tab').forEach(tab => {
        tab.style.display = 'none';
    });

    // Show the selected tab
    if (status === 'pending') {
        document.getElementById('pending-orders').style.display = 'block';
    } else if (status === 'onProcess') {
        document.getElementById('onProcess-orders').style.display = 'block';
    }
}

function deleteOrder(orderId) {
    if (confirm('Are you sure you want to void this order? This action cannot be undone.')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            console.error("CSRF token not found.");
            return;
        }

        fetch(`/delete-order/${orderId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order has been voided and deleted successfully.');
                location.reload();
            } else {
                alert('Failed to void order.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function updateOrderStatus(orderId, status) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        console.error("CSRF token not found.");
        return;
    }

    fetch(`/update-order-status/${orderId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let message;
            switch (status.toLowerCase()) {
                case 'pending':
                    message = 'Order set to Pending successfully.';
                    break;
                case 'completed':
                    message = 'Order Completed successfully.';
                    break;
                case 'on process':
                    message = 'Order is now On Process.';
                    break;
                default:
                    message = 'Order status updated successfully.';
            }
            alert(message);
            location.reload();
        } else {
            alert('Failed to update order status.');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Show pending orders by default when page loads
document.addEventListener('DOMContentLoaded', function() {
    showOrder('pending');
});

function deleteOrder(orderId) {
    if (confirm('Are you sure you want to void this order? This action cannot be undone.')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            console.error("CSRF token not found.");
            return;
        }

        fetch(`/delete-transaction/${orderId}`, {  // Updated endpoint
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Transaction has been voided and deleted successfully.');
                location.reload();
            } else {
                alert('Failed to void transaction: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while voiding the transaction.');
        });
    }
}

</script>
</body>

</html>
