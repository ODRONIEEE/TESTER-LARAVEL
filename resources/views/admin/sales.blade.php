<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Page</title>
    <link rel="stylesheet" href="{{url('../../Css/admin/sales.css')}}">
    <link href="https://fonts.cdnfonts.com/css/aver" rel="stylesheet">
</head>
<body>

    <header>
        <div class="logo">
            <a href="{{route('admin.dashboard')}}"><img src="{{asset('images/logowhite.png')}}" alt="Logo"></a>
        </div>
        <div class="title">
            archive <span>cafe</span>
        </div>
        <div class="profile">
            <a href="{{route('profile.edit')}}">
                <img src="{{asset('images/icon.png')}}" alt="Profile">
            </a>
        </div>
    </header>

    <!-- Body Section -->
    <div class="main-container">
      <!-- Cup Count Section -->
      <div class="cup-count-section">
          <h1>Cup Count</h1>
                    <div class="buttons">
              <div class="item">
                  <button onclick="addItem('Coffee')">Coffee</button>
                  <span id="coffee-count">0</span>
              </div>
              <div class="item">
                  <button onclick="addItem('Non-Coffee')">Non-Coffee</button>
                  <span id="non-coffee-count">0</span>
              </div>
              <div class="item">
                  <button onclick="addItem('Refreshers')">Refreshers</button>
                  <span id="refreshers-count">0</span>
              </div>
              <div class="item">
                  <button onclick="addItem('Tea')">Tea</button>
                  <span id="tea-count">0</span>
              </div>
          </div>
      </div>

      <!-- Meals Section -->
      <div class="meals-section">
          <h1>Meals</h1>
          <div class="buttons">
              <div class="item">
                  <button onclick="addItem('Pastries')">Pastries</button>
                  <span id="pastries-count">0</span>
              </div>
              <div class="item">
                  <button onclick="addItem('Pasta')">Pasta</button>
                  <span id="pasta-count">0</span>
              </div>
              <div class="item">
                  <button onclick="addItem('Rice Meal')">Rice Meal</button>
                  <span id="rice-meal-count">0</span>
              </div>
              <div class="item">
                  <button onclick="addItem('Appetizer')">Appetizer</button>
                  <span id="appetizer-count">0</span>
              </div>
          </div>
      </div>

      <!-- Sales Section -->
      <div class="sales-section">
          <h1>Sales</h1>
          <div class="buttons">
              <div class="total-sales">
              <p>Total Sales: <span id="total-sales">Php 0000.00</span></p>
            </div>
            <br><br>
            <div class="total-quantity">
              <p>Total Quantity: <span id="total-quantity">0</span></p>
            </div>
      </div>
  </div>

    <footer>
        <p>"brewing timeless moments"</p>
    </footer>

    <script src="Sales.js"></script>
</body>
</html>
