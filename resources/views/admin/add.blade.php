<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Archive Cafe</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{asset('assets/img/logobrown.png')}}" rel="icon">


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

        <a href="{{url()->previous()}}" class="logo d-flex align-items-center me-auto">
          <img src="{{asset('assets/img/logo/logo2.png')}}" alt="">
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
        <div class="row menu-content " style="max-width: 80%;margin: auto;">

            <div class="col-2">
                <div class="menu-options">
                    <a href="{{route('admin.product')}}" style="       position: relative;
                        width: 300px;
                        height: 81px;
                        text-decoration: none;
                        color: white;
                        font-size: 1.2rem;
                        font-weight: bold;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        overflow: hidden;
                        transition: transform 0.3s ease, background-color 0.3s ease;
                        z-index: 1;
                        margin: 10px;
                        box-sizing: border-box;
                        background-color: #3f2314;
                        border-radius: 50px;">
                        <span>Add Products</span>
                    </a>
                </div>
            </div>


        <form action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                <div class="col-lg-10 col-md-8 col-sm-10 product-details">
                    <h2 id="product-name" class="text-center mb-4"></h2>
                    <div class="customization-options">
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <!-- Product Name -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                    <label class="me-2 w-25 w-md-100">Product Name</label>
                                    <input type="text" name="name" class="form-control w-100 custom-input" placeholder="Enter Product Name" required/>
                                </div>
                                <!-- Product Price -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                    <label class="me-2 w-25 w-md-100">Product Price</label>
                                    <input type="text" name="price" class="form-control w-100 custom-input" placeholder="Enter Product Price" required/>
                                </div>
                                <!-- Product Quantity -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                    <label class="me-2 w-25 w-md-100">Product Quantity</label>
                                    <input type="text" name="stock" class="form-control w-100 custom-input" placeholder="Enter Product Quantity" required/>
                                </div>

                                <!-- Category Dropdown -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                    <label class="me-2 w-25 w-md-100">Category</label>
                                    <select class="form-control w-100 custom-input" id="category" name="cat_id"
                                        onchange="updateProductType()">
                                        <option value=>Select Category</option>
                                        <option value= 1 >Drinks</option>
                                        <option value= 2 >Food</option>
                                    </select>
                                </div>


                                <!-- Type Dropdown -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                    <label class="me-2 w-25 w-md-100">Type</label>
                                    <select class="form-control w-100 custom-input" id="type" name="type_id">
                                        <option value=>Select Type</option>
                                            <option value=1>Drinks</option>
                                            <option value=2>Food</option>
                                    </select>
                                </div>

                                <!-- Sugar Dropdown -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column"
                                    id="sugar-dropdown" style="display:none !important;">
                                    <label class="me-2 w-25 w-md-100">Sugar</label>
                                    <select class="form-control w-100 custom-input" id="sugar" name="sugar_id">
                                        <option value=>Select Sugar Level</option>
                                        <option value=1>Sweet</option>
                                        <option value=2>Regular</option>
                                        <option value=3>Mild</option>
                                    </select>
                                </div>

                                <!-- Espresso Dropdown -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column"
                                    id="espresso-dropdown" style="display:none !important;">
                                    <label class="me-2 w-25 w-md-100">Espresso</label>
                                    <select class="form-control w-100 custom-input" id="espresso" name="espresso_id">
                                        <option value=>Select Espresso Level</option>
                                        <option value=1>Strong</option>
                                        <option value=2>Regular</option>
                                        <option value=3>Mild</option>
                                    </select>
                                </div>


                            </div>

                            <!-- Product Description -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <!-- Upload Photo -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                    <label class="me-2 w-25 w-md-100">Upload Photo</label>
                                    <input type="file" name="image" class="form-control w-100 custom-input" id="product-photo"
                                        accept="image/*" onchange="previewPhoto()">
                                </div>

                                <!-- Photo Preview -->
                                <div class="form-group">
                                    <img id="photo-preview" src="#" alt="Preview Image"
                                        style="display:none; max-width: 100%; height: auto;" />
                                </div>

                                <div class="form-group" style="flex-grow: 1;">
                                    <h2 class="mb-2">Product Description</h2>
                                    <textarea name ="description" class="form-control custom-input"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="max-width: 50%;">
                            <div class="col-lg-6 col-md-6 col-sm-12"><button
                                class="custom-btn place-order w-100">Cancel</button></div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <button type="submit" class="custom-btn place-order w-100">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</main>

<footer id="footer" class="footer-menu text-center">
    <h1>"brewing timeless moments"</h1>
</footer>

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
    <script>
        function previewPhoto() {
            const file = document.getElementById('product-photo').files[0];
            const preview = document.getElementById('photo-preview');

            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Show the image once it's loaded
            };

            if (file) {
                reader.readAsDataURL(file); // Read the file as a Data URL
            }
        }

        function updateProductType() {
            var category = document.getElementById("category").value;
            var typeDropdown = document.getElementById("type");
            var sugarDropdown = document.getElementById("sugar-dropdown");
            var espressoDropdown = document.getElementById("espresso-dropdown");

            // Clear the current options in the "Type" dropdown
            typeDropdown.innerHTML = '<option value="">Select Type</option>';

            var drinksTypes = [
            { id: 1, name: 'Coffee' },
            { id: 2, name: 'Non-Coffee' },
            { id: 3, name: 'Refreshers' },
            { id: 4, name: 'Tea' }
        ];

            var foodTypes = [
            { id: 5, name: 'Appetizers' },
            { id: 6, name: 'Pasta' },
            { id: 7, name: 'Burger' },
            { id: 8, name: 'Rice Meal' },
            { id: 9, name: 'Pastries' },
        ];


            // Hide both Sugar and Espresso dropdowns initially
            sugarDropdown.style.display = 'none';
            espressoDropdown.style.display = 'none';

            // Check if the category is '1' (Drinks) or '2' (Food)
            if (category == 1) {  // Drinks selected
                // Show the Sugar dropdown when Drinks is selected

                sugarDropdown.style.display = 'block';

                // Populate the Type dropdown with drink types
                drinksTypes.forEach(function(type) {
                    var option = document.createElement("option");
                    option.value = type.id;
                    option.text = type.name;
                    typeDropdown.add(option);
                });

                // Show Espresso dropdown only if Coffee is selected in Type
                typeDropdown.onchange = function () {
                    var selectedType = typeDropdown.value;
                    if (selectedType === 'Coffee') {
                        espressoDropdown.style.display = 'block';
                    } else {
                        espressoDropdown.style.display = 'none';
                    }
                };

            } else if (category == 2) {  // Food selected
                // Both Sugar and Espresso dropdowns remain hidden for Food
                sugarDropdown.style.display = 'none';
                espressoDropdown.style.display = 'none';
                // Populate the Type dropdown with food types
                foodTypes.forEach(function(type) {
                    var option = document.createElement("option");
                    option.value = type.id;
                    option.text = type.name;
                    typeDropdown.add(option);
                });
            } else {
                // Hide both dropdowns if no category is selected
                sugarDropdown.style.display = 'none';
                espressoDropdown.style.display = 'none';
            }
        }




    </script>
</body>
</html>
