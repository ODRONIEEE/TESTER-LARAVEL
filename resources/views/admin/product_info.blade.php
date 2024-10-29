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

        <a href="{{route('admin.product')}}" class="logo d-flex align-items-center me-auto">
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
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            <div class="table-container">{{ $row->product_code}}</div>
                        </td>
                        <td class="text-center">{{ $row->name }}</td>
                        <td>{{ $row->description }}</td>
                        <td class="text-center">
                            <div class="table-container">
                                {{ $row->price }}</div>
                        </td>
                        <td class="text-center">
                            <div class="table-container">{{ $row->stock }}</div>
                        </td>
                        <td>
                            <div class="showPhoto">
                                <div id="imagePreview">
                                    <img src="{{ asset($row->image) }}" alt="{{ $row->name }}" class="product-image">
                                </div>

                            </div>
                        </td>

                        <td class="text-center">
                            <div class="action-buttons">
                                <button class="btn btn-brown" style="background-color: #e2e2e2;"
                                onclick="openEditModal('{{ $row->id }}', '{{ $row->name }}', '{{ $row->price }}', '{{ $row->stock }}', '{{ $row->description }}', '{{ $row->image }}')">
                                Edit Product
                                </button>

                                <form action="{{ route('admin.product.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-gray" style="background-color: #b86143;">Remove Product</button>
                                </form>

                            </div>
                        </td>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No Data Found</td>
                        </tr>

                        @endforelse
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </div>

</main>


   <!-- Edit Product Modal -->
<div class="modal fade " id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content product-details">
           <div class="modal-header">
               <h5 class="modal-title" id="editProductModalLabel" style="color:white">Edit Product</h5>
               <button type="button" class="btn-close" style="color:white" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <form action="{{route('admin.product.update', $row->id)}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')

                <div class="modal-body ">
                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <!-- Product Name -->
                            <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                <label class="me-2 w-25 w-md-100">Product Name</label>
                                <input type="text" name="name" class="form-control w-100 custom-input"
                                    placeholder="Enter Product Name" value="{{$row->name}}"  />
                            </div>

                            <!-- Product price -->
                            <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                <label class="me-2 w-25 w-md-100">Product Price</label>
                                <input type="number" name="price" step="0.01" class="form-control w-100 custom-input"
                                    placeholder="Enter Product Price" value="{{$row->price}}"  />
                            </div>

                            <!-- Product Stock -->
                            <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                <label class="me-2 w-25 w-md-100">Product Quantity</label>
                                <input type="number" name="stock" class="form-control w-100 custom-input"
                                    placeholder="Enter Product Stock" value="{{$row->stock}}"  />
                            </div>

                            <!-- Product Photo -->
                            <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                <label class="me-2 w-25 w-md-100">Upload Photo</label>
                                <input type="file" name="image" class="form-control w-100 custom-input" id="product-photo"accept="image/*" onchange="previewPhoto()">
                            </div>

                            <!-- Current Photo Preview -->
                            <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                <label class="me-2 w-25 w-md-100">Current Photo</label>
                                <img id="current-photo" src="" alt="Current Product Photo" style="max-width: 100px; max-height: 100px;">
                            </div>

                            <!-- Product Description -->
                            <div class="form-group" style="flex-grow: 1;">
                                <h2 class="mb-2">Product Description</h2>
                                <textarea name="description" class="form-control custom-input">{{$row->description}}</textarea>
                            </div>

                            {{-- <!-- Category Dropdown -->
                            <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                <label class="me-2 w-25 w-md-100">Price</label>
                                <input type="text" name="cat_id" class="form-control w-100 custom-input" value="100.00" />
                            </div>

                            <!-- Type Dropdown -->
                            <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                <label class="me-2 w-25 w-md-100">Quantity</label>
                                <input type="text" name="type_id" class="form-control w-100 custom-input" value="2" />
                            </div> --}}



                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

       </div>
   </div>
</div>


<footer id="footer" class="footer-product text-center">
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

    function openEditModal(productId, name, price, stock, description, imagePath) {
    var modal = document.getElementById('editProductModal');
    var form = modal.querySelector('form');

    form.action = form.action.replace(/\/\d*$/, '/' + productId);

    modal.querySelector('input[name="name"]').value = name;
    modal.querySelector('input[name="price"]').value = price;
    modal.querySelector('input[name="stock"]').value = stock;
    modal.querySelector('textarea[name="description"]').value = description;

    // Set the current image preview
    var currentPhoto = modal.querySelector('#current-photo');
    if (currentPhoto) {
        currentPhoto.src = '/' + imagePath; // Add a leading slash
    }

    var bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();
}


    // Show success message if it exists
    @if(session('success'))
        alert("{{ session('success') }}");
    @endif

    // Alternative confirmation dialog with more styling (optional)
    function confirmDelete(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
            event.target.form.submit();
        }
    }
    </script>

<style>
.showPhoto {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 150px;
    height: 150px;
    border-radius: 50%; /* Optional: Keep the circular shape */
}

.showPhoto img {
    width: 100%; /* Make the image fill the container */
    height: 100%; /* Make the image fill the container */
    object-fit: cover; /* Ensure the image fills the container without distortion */
    border-radius: 50%; /* Keep the circular shape */
}



</style>
</body>

</html>
