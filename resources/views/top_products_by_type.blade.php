<!-- resources/views/product_ranking.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Selling Products</title>
    <!-- Add any CSS or framework here like Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Top 10 Best-Selling Products by Type</h2>

        @foreach ($rankedProductsByType as $typeId => $typeGroup)
        <h3>Type: {{ $typeGroup['name'] }}</h3>
        <ul>
            @foreach ($typeGroup['products'] as $product)
            <li>
                Product ID: {{ $product['product_id'] }},
                Name: {{ $product['product_name'] }},
                Quantity Sold: {{ $product['quantity'] }}
            </li>
            @endforeach
        </ul>
        @endforeach
    </div>

    <!-- Add Bootstrap JS for any interactivity like modals or dropdowns if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>