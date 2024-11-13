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
              <li><a href="{{route('welcome')}}">Cafe</a></li>
              <li><a href="{{route('menu')}}">Menu</a></li>
              <li><a href="{{route('welcome')}}">Meet The Team</a></li>
              <li class="nav-item d-none d-md-block">
                <span class="navbar-divider"></span>
              </li>
              <!-- CART LOGO -->
              <li class="nav-item">
                <a href="{{ route('cart') }}" class="btn-icon-only">
                    CART
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
                  <h1 class="cafe-center cafe-name text-center d-md-none"><strong>archive</strong> <span>cafe</span></h1>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>

          @endauth
        </div>
      </header>
      @endif

<main class="main">
    <div class="menu-container-light-details">
        <div class="row">
            <div class="row mb-4">
                <div class="col-12">
                    <a href="{{ route('menu') }}" class="btn btn-dark">
                        <i class="bi bi-arrow-left"></i> Back to Menu
                    </a>
                </div>
            </div>
`
            <!-- Left Section: Product Display -->
            <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
                <h1 class="page-header text-center" style="color:#ed8705;font-weight: 600;">{{$product->name}}</h1>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <img class="img-fluid" src="{{ asset($product->image) }}" alt="Card image cap">
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-12 mb-4" style="text-align: right;">
                        <h1 class="page-header" id="display-price">{{$product->price}}</h1>

                        <div class="btn-group-wrapper">
                            <div class="btn-group">
                                @if(in_array($product->type_id, [1, 2, 4]))
                                    <button type="button" class="btn btn-dark temperature-btn" data-temp="cold">Cold</button>
                                    <button type="button" class="btn btn-dark temperature-btn" data-temp="hot">Hot</button>
                                @endif
                            </div>
                        </div>

                        <form id="addToCartForm" action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" value="{{ $product->name }}">

                            @if(in_array($product->type_id, [1, 2, 4]))
                                <input type="hidden" name="temperature" id="temperature-input" value="">
                            @endif

                            <input type="hidden" name="price" id="price-input" value="{{ $product->price }}">
                            <input type="number" name="quantity" value="1" min="1">
                            <input type="hidden" name="extras" id="extras-input" value="">
                            <button type="submit" class="btn btn-warning mt-3" id="addToCartButton">Add to Cart</button>
                        </form>

                    </div>
                </div>
                <div class="row">
                    <p class="product-description mt-3">
                        {{ $product->description }}
                    </p>
                </div>
            </div>

            <!-- Divider -->
            <div class="col-lg-2 col-md-6 col-sm-12 mb-4 product-divider d-none d-md-block"></div>

            <!-- Right Section: Extras -->
            <div class="col-lg-5 col-md-5 col-sm-12 mb-4">
                <h1 class="page-header text-center" style="color:#ed8705;font-weight: 600;">Extras</h1>
           <div class="extras-section">
                @if($extras->isNotEmpty())
                    @foreach($extras as $cat_id => $items)
                        <h4 class="mt-4">{{ $cat_id == 1 ? 'Coffee Extras' : 'Food Extras' }}</h4>
                        <div class="radio-options">
                            @foreach($items as $extra)
                                @if($extra->quantity > 0)
                                    <label class="extra-label">
                                        <input type="checkbox" class="extra-checkbox" data-price="{{ $extra->price }}" value="{{ $extra->id }}" onchange="updateExtras()">
                                        <span class="checkmark"></span>
                                        <div class="extra-container">
                                            {{ $extra->name }} - ₱{{ number_format($extra->price, 2) }}
                                        </div>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <p>No extras available.</p>
                @endif
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
        const tempButtons = document.querySelectorAll('.temperature-btn');

     tempButtons.forEach(button => {
         button.addEventListener('click', function () {
             // Remove btn-warning class from all buttons
             tempButtons.forEach(btn => {
                 btn.classList.remove('btn-warning');
                 btn.classList.add('btn-dark');
             });

             // Add btn-warning class only to clicked button
             button.classList.remove('btn-dark');
             button.classList.add('btn-warning');
         });
     });
     const displayPrice = document.getElementById('display-price');
     const priceInput = document.getElementById('price-input');
     const extrasInput = document.getElementById('extras-input');
     const temperatureInput = document.getElementById('temperature-input');
     const temperatureBtns = document.querySelectorAll('.temperature-btn');
     const espressoBtns = document.querySelectorAll('.espresso-btn');
     const syrupInputs = document.querySelectorAll('input[name^="extras[syrup]"]');
     const sauceInputs = document.querySelectorAll('input[name^="extras[sauce]"]');
     const addToCartForm = document.getElementById('addToCartForm');
     const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

     const originalBasePrice = parseFloat('{{ $product->price }}');
     let basePrice = originalBasePrice;
     let extras = {
         espresso: { selected: null, price: 0 },
         syrup: {},
         sauce: {}
     };

     function updateDisplayPrice() {
         let totalPrice = basePrice;
         let extrasTotal = 0;

         extrasTotal += extras.espresso.price;

         Object.values(extras.syrup).forEach(syrup => {
             if (syrup.selected) extrasTotal += syrup.price;
         });

         Object.values(extras.sauce).forEach(sauce => {
             if (sauce.selected) extrasTotal += sauce.price;
         });

         totalPrice += extrasTotal;

         displayPrice.innerHTML = `Base: $${basePrice.toFixed(2)}<br>Total: $${totalPrice.toFixed(2)}`;
         priceInput.value = totalPrice.toFixed(2);
         extrasInput.value = JSON.stringify(extras);
     }

     temperatureBtns.forEach(btn => {
         btn.addEventListener('click', function() {
             temperatureBtns.forEach(b => b.classList.remove('active'));
             this.classList.add('active');
             temperatureInput.value = this.dataset.temp;

             if (this.dataset.temp === 'hot') {
                 basePrice = originalBasePrice - 10;
             } else {
                 basePrice = originalBasePrice;
             }
             updateDisplayPrice();
         });
     });

     espressoBtns.forEach(btn => {
         btn.addEventListener('click', function() {
             espressoBtns.forEach(b => b.classList.remove('active'));
             this.classList.add('active');
             extras.espresso.selected = this.dataset.value;
             extras.espresso.price = parseFloat(this.dataset.price);
             updateDisplayPrice();
         });
     });

     syrupInputs.forEach(input => {
         input.addEventListener('change', function() {
             const syrupName = this.name.match(/\[syrup\]\[(.+?)\]/)[1];
             if (this.checked) {
                 extras.syrup[syrupName] = {
                     selected: true,
                     price: parseFloat(this.dataset.price)
                 };
             } else {
                 delete extras.syrup[syrupName];
             }
             updateDisplayPrice();
         });
     });

     sauceInputs.forEach(input => {
         input.addEventListener('change', function() {
             const sauceName = this.name.match(/\[sauce\]\[(.+?)\]/)[1];
             if (this.checked) {
                 extras.sauce[sauceName] = {
                     selected: true,
                     price: parseFloat(this.dataset.price)
                 };
             } else {
                 delete extras.sauce[sauceName];
             }
             updateDisplayPrice();
         });
     });

     updateDisplayPrice();

     addToCartForm.addEventListener('submit', function(e) {
     e.preventDefault();
     console.log('Form submission intercepted');

     const formData = new FormData(this);

     // Ensure extras are properly formatted
     const extrasJson = JSON.stringify(extras);
     formData.set('extras', extrasJson);

     fetch(this.action, {
         method: 'POST',
         body: formData,
         headers: {
             'X-CSRF-TOKEN': csrfToken,
             'Accept': 'application/json'
         }
     })
     .then(response => response.json())
     .then(data => {
         if (data.success) {
             alert('Item added to cart successfully!');
             // Optionally redirect to cart page
             window.location.href = '{{ route("cart") }}';
         } else {
             alert('Error adding item to cart: ' + (data.message || 'Unknown error'));
         }
     })
     .catch(error => {
         console.error('Error:', error);
         alert('An error occurred while adding the item to cart.');
     });
 });


    });

 </script>
 <script>
  function updateExtras() {
     const extras = [];
     document.querySelectorAll('.extra-checkbox:checked').forEach(checkbox => {
         extras.push(checkbox.value);
     });
     document.getElementById('extras-input').value = JSON.stringify(extras);
 }

 // Update the temperature based on button click
 document.querySelectorAll('.temperature-btn').forEach(button => {
     button.addEventListener('click', function () {
         document.getElementById('temperature-input').value = this.dataset.temp;
     });
 });

 </script>
<style>
.radio-options {
    margin-top: 10px;
}

.extra-label {
    display: flex;
    align-items: center;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 10px;
    user-select: none;
}

.extra-label input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

.extra-label:hover input ~ .checkmark {
    background-color: #ccc;
}

.extra-label input:checked ~ .checkmark {
    background-color: #ed8705;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.extra-label input:checked ~ .checkmark:after {
    display: block;
}

.extra-label .checkmark:after {
    left: 9px;
    top: 5px;
    width: 7px;
    height: 12px;
    border: solid white;
    border-width: 0 3px 3px 0;
    transform: rotate(45deg);
}

.extra-container {
    margin-left: 10px;
}


</style>
</body>

</html>
