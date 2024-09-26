<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Archive Cafe - Update System</title>
  <link rel="stylesheet" href="{{url('../../Css/admin/product.css')}}">
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

  <section class="update-system">
    <h2>Product System</h2>
  </section>

  <main>
    <div class="buttons-container">
      <a href="update system/Refreshers.html" class="button">Add product</a>
      <a href="update system/Refreshers.html" class="button">Refreshers</a>
      <a href="update system/Non-coffee.html" class="button">Non-coffee</a>
      <a href="update system/Coffe.html" class="button">Coffee</a>
      <a href="update system/Tea.html" class="button">Tea</a>
      <a href="update system/Appetizers.html" class="button">Appetizers</a>
      <a href="update system/RiceMeals.html" class="button">Rice meals</a>
      <a href="update system/Burgers.html" class="button">Burgers</a>
      <a href="update system/Pasta.html" class="button">Pasta</a>
    </div>
  </main>

  <footer>
    <p>"brewing timeless moments"</p>
  </footer>
</body>
</html>
