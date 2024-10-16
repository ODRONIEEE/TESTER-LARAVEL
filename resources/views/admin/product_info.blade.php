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
        <div class="col-lg-12 col-md-12 col-lg-12  product-details">
            <h1 class=" text-center" style="color:white;font-weight: 700;"><strong>Coffee</strong></h1>
            <div class="table-responsive">
                <table class="table table-borderless custom-table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">ID </th>
                            <th scope="col" class="text-center">Product Code</th>
                            <th scope="col" class="text-center">Product Name</th>
                            <th scope="col" class="text-center">Description</th>
                            <th scope="col" class="text-center">Price</th>
                            <th scope="col" class="text-center">Stock</th>
                            <th scope="col" class="text-center">Photo</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                        <td>{{ $row->product_code}}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->price }}</td>
                        <td>{{ $row->stock }}</td>
                        <td>
                            <div class="showPhoto">
                                <div id="imagePreview" style="@if ($row->image) background-image: url('{{ asset('uploads/' . $row->image) }}'); @else background-image: url('{{ asset('assets/img/icon/Profile.png') }}'); @endif;">
                                </div>
                            </div>
                        </td>


                        <td class="text-center">
                            <div class="action-buttons">
                                <button class="btn btn-brown " style="background-color: #e2e2e2;">Edit Product</button>
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-brown " style="background-color: #e2e2e2;">Remove Product</button>
                                </div>
                                </form>
                        </td>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No Data Found</td>
                        </tr>

                        @endforelse
                        </tr>

                    </tbody>
                </table>
                {{-- {{$products->links()}} --}}
            </div>
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
<script src="{{url('assets/js/main.js')}}">

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

        // Define the options for each category
        var drinksTypes = ['Coffee', 'Non-Coffee', 'Refreshers', 'Tea'];
        var foodTypes = ['Pastries', 'Pasta', 'Rice Meal', 'Appetizer', 'Burger'];

        console.log("Selected category: ", category); // Log the selected category

        if (category === 'Drinks') {
            console.log("Drinks selected. Showing Sugar dropdown."); // Log for Drinks selection

            // Show the Sugar dropdown when Drinks is selected
            if (sugarDropdown) {
                sugarDropdown.style.display = 'block';
                console.log("Sugar dropdown displayed."); // Log for Sugar dropdown display
            }

            // Populate the Type dropdown with drink types
            drinksTypes.forEach(function (type) {
                var option = document.createElement("option");
                option.value = type;
                option.text = type;
                typeDropdown.add(option);
            });

            // Show Espresso dropdown if Coffee is selected in Type
            typeDropdown.onchange = function () {
                var selectedType = typeDropdown.value;

                // Show or hide the Espresso dropdown based on the selected type
                if (selectedType === 'Coffee') {
                    if (espressoDropdown) {
                        espressoDropdown.style.display = 'block';
                        console.log("Espresso dropdown displayed."); // Log for Espresso dropdown display
                    }
                } else {
                    if (espressoDropdown) {
                        espressoDropdown.style.display = 'none';
                        console.log("Espresso dropdown hidden."); // Log for Espresso dropdown hide
                    }
                }
            };

        } else if (category === 'Food') {
            console.log("Food selected. Hiding Sugar dropdown."); // Log for Food selection

            // Hide the Sugar dropdown when Food is selected
            if (sugarDropdown) {
                sugarDropdown.style.display = 'none';
                console.log("Sugar dropdown hidden."); // Log for Sugar dropdown hide
            }

            // Hide the Espresso dropdown as well
            if (espressoDropdown) {
                espressoDropdown.style.display = 'none';
                console.log("Espresso dropdown hidden."); // Log for Espresso dropdown hide
            }

            // Populate the Type dropdown with food types
            foodTypes.forEach(function (type) {
                var option = document.createElement("option");
                option.value = type;
                option.text = type;
                typeDropdown.add(option);
            });
        }
    }

</script>
<style>
.showPhoto {
    width: 150px; /* Set a smaller fixed width for the circle */
    height: 150px; /* Set a smaller fixed height for the circle */
    margin: auto; /* Center the circle horizontally */
}

.showPhoto > div {
    width: 100%; /* Full width of the parent */
    height: 100%; /* Full height of the parent */
    border-radius: 50%; /* Makes it circular */
    background-size: cover; /* Cover the entire div */
    background-repeat: no-repeat; /* No repeating of the background */
    background-position: center; /* Center the image */
    border: 2px solid #ccc; /* Optional: Add a border for better visibility */
}




</style>
</body>

</html>
