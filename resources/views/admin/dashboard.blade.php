<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>archive <span>cafe</span></title>
    <link rel="stylesheet" href="{{url('../../Css/admin/home.css')}}">
    <link href="https://fonts.cdnfonts.com/css/aver" rel="stylesheet">

</head>
<body>
    <header>
        <div class="logo">
            <a href="{{route('welcome')}}"><img src="{{asset('asset/logowhite.png')}}" alt="Logo"></a>
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
    <main>
        <div class="content">
            <div class="nav-buttons">
                <a href="{{ route('admin.pos')}}"  class="button">POS</a>
                <a href="{{ route('admin.product')}}"  class="button">PRODUCT</a>
                <a href="{{route('admin.sales')}}" class="button">SALES</a>
                <a href="../../User acc/Html/order.html" class="button">ORDERS</a>
            </div>
            <div class="iced-coffee">
                <img src="{{asset('asset/cold americano.png')}}" alt="Iced Coffee">
            </div>
        </div>
    </main>
    <footer>
        "brewing timeless moments"
    </footer>
</body>
</html>
