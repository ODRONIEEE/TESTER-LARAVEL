<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive Cafe</title>
    <link href="https://fonts.cdnfonts.com/css/aver" rel="stylesheet">
    <link href="{{url('../../Css/admin/pos.css')}}" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <a href="{{route('admin.dashboard')}}"><img src="{{asset('asset/logowhite.png')}}" alt="Archive Cafe Logo"></a>
        </div>
        <div class="header-title">archive <em>cafe</em></div>
        <div class="profile">
            <a href="{{route('profile.edit')}}"><img src="{{asset('asset/icon.png')}}" alt="Profile"></a>
        </div>
    </header>

    <div class="menu-title">MENU</div>

    <main>
        <div class="menu-options">
            <a href="{{route('admin.drink-menu')}}" class="menu-option drinks">
                <span>DRINKS</span>
            </a>
            <a href="../Html/food_menu.html" class="menu-option foods">
                <span>FOODS</span>
            </a>
        </div>
    </main>

    <footer>
        <p>"brewing timeless moments"</p>
    </footer>
</body>
</html>
