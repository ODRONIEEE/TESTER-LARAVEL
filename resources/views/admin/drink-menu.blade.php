<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu-Drinks</title>
    <link rel="stylesheet" href="{{url('../../Css/admin/drink.css')}}">
    <link href="https://fonts.cdnfonts.com/css/aver" rel="stylesheet">
    <script src="{{asset('Js/drink.js')}}"></script>
</head>
<body>

    <header>
        <div class="logo">
            <a href="{{route('admin.dashboard')}}"><img src="{{asset('asset/logowhite.png')}}" alt="Logo"></a>
        </div>
        <div class="title">
            archive <span>cafe</span>
        </div>
        <div class="profile">
            <a href="{{route('profile.edit')}}">
                <img src="{{asset('asset/icon.png')}}" alt="Profile">
            </a>
        </div>
    </header>

    <!-- Body Section -->
    <div class="menu-container">

        <nav class="category-menu">
           <a href="{{ url()->previous() }}" class="terms-btn">
            <button>Back</button>
        </a>

            <button onclick="showCategory('coffee')">Coffee</button>
            <button onclick="showCategory('non-coffee')">Non-Coffee</button>
            <button onclick="showCategory('refreshers')">Refreshers</button>
            <button onclick="showCategory('tea')">Tea</button>
        </nav>

        <div class="menu-content">
            <!-- Product Buttons inside the box -->
            <div id="menu-items" class="menu-items">
                <!-- Coffee Product Buttons -->
            </div>

            <!-- Product Selection and Customization -->
            <div class="product-details">
                <h2 id="product-name">Caramel Macchiato</h2>
               <div class="customization-options">
                    <!-- Size -->
                    <div class="size-options">
                        <h3>Size</h3>
                        <button id="size-regular" onclick="setSize('regular')">Regular 16oz</button>
                        <button id="size-large" onclick="setSize('large')">Large 22oz</button>
                    </div>

                    <!-- Hot or Cold -->
                    <div class="type-options">
                        <h3>Type</h3>
                        <button onclick="setTemperature('hot')">Hot</button>
                        <button onclick="setTemperature('cold')">Cold</button>
                    </div>

                    <!-- Espresso Shots -->
                    <div class="espresso-shots">
                        <h3>Espresso Shots</h3>
                        <button onclick="adjustShots(-1)">-</button>
                        <span id="shots-count">0</span>
                        <button onclick="adjustShots(1)">+</button>
                    </div>

                    <!-- Extras -->
                    <div class="extras">
                        <h3>Extras</h3>
                        <button onclick="setMilk('regular')">Regular Milk</button>
                        <button onclick="setMilk('oat')">Oat Milk</button>
                    </div>

                    <!-- Syrups -->
                    <div class="syrups">
                        <h3>Syrup</h3>
                        <button onclick="selectSyrup('roasted-almonds')">Roasted Almonds</button>
                        <button onclick="selectSyrup('vanilla')">Vanilla</button>
                        <button onclick="selectSyrup('hazelnut')">Hazelnut</button>
                        <button onclick="selectSyrup('strawberry')">Strawberry</button>
                        <button onclick="selectSyrup('fructose')">Fructose Sauce</button>
                        <button onclick="selectSyrup('white-choco')">White Chocolate</button>
                        <button onclick="selectSyrup('chocolate')">Chocolate</button>
                        <button onclick="selectSyrup('salted-caramel')">Salted Caramel</button>
                        <button onclick="selectSyrup('caramel')">Caramel</button>
                        <button onclick="selectSyrup('butterscotch')">Butterscotch</button>
                        <button onclick="selectSyrup('dulce')">Dulce</button>
                        <button onclick="selectSyrup('con-leche')">Con Leche</button>
                    </div>

                    <!-- Quantity -->
                    <div class="quantity">
                        <h3>Quantity</h3>
                        <button onclick="adjustQuantity(-1)">-</button>
                        <span id="quantity-count">0</span>
                        <button onclick="adjustQuantity(1)">+</button>
                    </div>

                    <!-- Total Price -->
                    <div class="total-price">
                        <h3>Total: Php <span id="total-price">000.00</span></h3>
                    </div>

                    <!-- Place Order -->
                    <button class="place-order" onclick="placeOrder()">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <p>"brewing timeless moments"</p>
    </footer>


</body>
</html>
