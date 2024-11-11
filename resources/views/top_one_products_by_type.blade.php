<!-- resources/views/product_ranking.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Selling Products</title>
    <!-- Add any CSS or framework here like Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <!-- Additional custom styling if needed -->
    <style>
    .slider-container {
        width: 80%;
        margin: auto;
        padding-top: 50px;
    }

    .slick-slide {
        display: flex !important;
        justify-content: center;
    }

    .card {
        width: 18rem;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-body h5 {
        font-size: 1.25rem;
        font-weight: 600;
    }

    .card-body p {
        font-size: 0.9rem;
        color: #555;
    }
    </style>


</head>

<body>

    <div class="container mt-5 text-center">
        <h2>Top One (1) Selling Products by Type</h2>

        <!-- Slick Carousel Container -->
        <div class="slider-container">
            <div class="slick-slider">
                @foreach($rankedProducts as $product)
                <div>
                    <div class="card">
                        <!-- <img src="{{ asset('images/icon.png') }}" class="card-img-top"
                            alt="{{ $product['product_name'] }}"> -->
                        <img src="{{ asset('images/icon.png') }}" class="card-img-top" alt="{{ $product['product_name'] }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product['product_name'] }}</h5>
                            <p class="card-text">Type: {{ $product['type_name'] }}</p>
                            <p class="card-text">image: {{ $product['image'] }}</p>
                            <p class="card-text">Sold: {{ $product['quantity'] }} units</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>



    <div class="container mt-5">
        <h2>Top One (1) Selling Products by Type</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Type ID</th>
                    <th>Type Name</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Total Quantity Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rankedProducts as $product)
                <tr>
                    <td>{{ $product['type_id'] }}</td>
                    <td>{{ $product['type_name'] }}</td>
                    <td>{{ $product['product_id'] }}</td>
                    <td>{{ $product['product_name'] }}</td>
                    <td>{{ $product['image'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>



    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <!-- jQuery and Slick Carousel JS -->
 <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

     <!-- Slick Slider Initialization -->
     <script>
        $(document).ready(function(){
            $('.slick-slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
            });
        });
    </script>
</body>

</html>