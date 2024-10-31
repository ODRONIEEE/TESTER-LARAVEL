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
    <div class="menu-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
          @endif
          @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
          @endif
        <div class="row menu-content" style="max-width: 80%;margin: auto;">

            <div class="col-2">
                <div class="menu-options">
                    <a href="{{route('admin.product')}}" style="position: relative;
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
                        <span>Add Extras</span>
                    </a>
                </div>
            </div>

            <form action="{{route('admin.extras.store')}}" method="POST" enctype="multipart/form-data">
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
                                    <label class="me-2 w-25 w-md-100">Extras Name</label>
                                    <input type="text" name="name" class="form-control w-100 custom-input" placeholder="Enter Extras Name" required/>
                                </div>
                                <!-- Product Price -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                    <label class="me-2 w-25 w-md-100">Extras Price</label>
                                    <input type="text" name="price" class="form-control w-100 custom-input" placeholder="Enter Extras Price" required/>
                                </div>
                                <!-- Product Quantity -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                    <label class="me-2 w-25 w-md-100">Extras Quantity</label>
                                    <input type="text" name="quantity" class="form-control w-100 custom-input" placeholder="Enter Extras Quantity" required/>
                                </div>
                                <!-- Category Dropdown -->
                                <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                    <label class="me-2 w-25 w-md-100">Category</label>
                                    <select class="form-control w-100 custom-input" id="category" name="cat_id">
                                        <option value="">Select Category</option>
                                        <option value=1>Drinks</option>
                                        <option value=2>Food</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group d-flex justify-content-start mt-4">
                        <a href="{{ route('admin.extras') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>

                    <div class="col-lg-12 col-md-12 col-lg-12 product-details">

                        <!-- Drinks Extras (Category 1) -->
                        <h1 class="text-center" style="color:white;font-weight: 700;"><strong>Drinks Extras</strong></h1>
                        <div class="table-responsive">
                            <table class="table table-borderless custom-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">ID</th>
                                        <th scope="col" class="text-center">Extras Name</th>
                                        <th scope="col" class="text-center">Price</th>
                                        <th scope="col" class="text-center">Quantity</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($extras->where('cat_id', 1) as $index => $extra)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $extra->name }}</td>
                                        <td class="text-center">
                                            <div class="table-container">{{ $extra->price }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="table-container">{{ $extra->quantity }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <button class="btn btn-brown" style="background-color: #e2e2e2;"
                                                    onclick="openEditModal('{{ $extra->id }}', '{{ $extra->name }}', '{{ $extra->price }}', '{{ $extra->quantity }}')">
                                                    Edit Extra
                                                </button>
                                                <form action="{{ route('admin.extras.destroy', $extra->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this extra?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-gray" style="background-color: #b86143;">Remove Extra</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Drinks Extras Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Food Extras (Category 2) -->
                        <h1 class="text-center mt-5" style="color:white;font-weight: 700;"><strong>Food Extras</strong></h1>
                        <div class="table-responsive">
                            <table class="table table-borderless custom-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">ID</th>
                                        <th scope="col" class="text-center">Extras Name</th>
                                        <th scope="col" class="text-center">Price</th>
                                        <th scope="col" class="text-center">Quantity</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($extras->where('cat_id', 2) as $index => $extra)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $extra->name }}</td>
                                        <td class="text-center">
                                            <div class="table-container">{{ $extra->price }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="table-container">{{ $extra->quantity }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <button class="btn btn-brown" style="background-color: #e2e2e2;"
                                                    onclick="openEditModal('{{ $extra->id }}', '{{ $extra->name }}', '{{ $extra->price }}', '{{ $extra->quantity }}')">
                                                    Edit Extra
                                                </button>
                                                <form action="{{ route('admin.extras.destroy', $extra->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this extra?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-gray" style="background-color: #b86143;">Remove Extra</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Food Extras Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
    </div>


</main>

<!-- Edit Extra Modal -->
<div class="modal fade" id="editExtraModal" tabindex="-1" aria-labelledby="editExtraModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content product-details">
            <div class="modal-header">
                <h5 class="modal-title" id="editExtraModalLabel" style="color:white">Edit Extra</h5>
                <button type="button" class="btn-close" style="color:white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editExtraForm" action="" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <!-- Extra Name -->
                            <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                <label class="me-2 w-25 w-md-100">Extra Name</label>
                                <input type="text" name="name" id="edit-extra-name" class="form-control w-100 custom-input"
                                    placeholder="Enter Extra Name" />
                            </div>

                            <!-- Extra Price -->
                            <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                <label class="me-2 w-25 w-md-100">Extra Price</label>
                                <input type="number" name="price" id="edit-extra-price" step="0.01" class="form-control w-100 custom-input"
                                    placeholder="Enter Extra Price" />
                            </div>

                            <!-- Extra Quantity -->
                            <div class="form-group d-flex align-items-center mb-3 flex-md-row flex-column">
                                <label class="me-2 w-25 w-md-100">Extra Quantity</label>
                                <input type="number" name="quantity" id="edit-extra-quantity" class="form-control w-100 custom-input"
                                    placeholder="Enter Extra Quantity" />
                            </div>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
    function openEditModal(id, name, price, quantity) {
        console.log('openEditModal called with:', id, name, price, quantity);
        var modal = document.getElementById('editExtraModal');
        if (!modal) {
            console.error('Modal element not found');
            return;
        }
        var form = document.getElementById('editExtraForm');
        if (!form) {
            console.error('Form element not found');
            return;
        }

        // Set the form action
        form.action = "{{ route('admin.extras.update', '') }}/" + id;

        // Populate the form fields
        document.getElementById('edit-extra-name').value = name;
        document.getElementById('edit-extra-price').value = price;
        document.getElementById('edit-extra-quantity').value = quantity;

        // Show the modal
        var bsModal = new bootstrap.Modal(modal);
        bsModal.show();
        console.log('Modal should be visible now');
    }
    </script>


</body>
</html>
