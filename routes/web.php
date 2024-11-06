<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductControl;
use App\Http\Controllers\ExtrasController;
use App\Http\Controllers\User\UserControl;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InfoControl;
use App\Http\Controllers\Admin\AdminControl;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

route::get('terms', function(){return view('terms'); })->name('terms');
route::get('privacy', function(){return view('privacy'); })->name('privacy');
route::get('welcome', function(){return view('welcome'); })->name('welcome');



// Route::get('welcome', function () {
//     return view('welcome');
// })->middleware(['auth', 'verified'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//User Routes
Route::middleware(['auth','UserMiddleware'])->group(function(){
    Route::get('dashboard',[UserControl::class, 'home'])->name('dashboard');
    Route::get('menu',[UserControl::class, 'menu'])->name('menu');

    Route::get('cart',[UserControl::class, 'cart'])->name('cart');

    Route::get('userProfile',[UserControl::class, 'userProfile'])->name('userProfile');
    Route::get('Order_history',[UserControl::class, 'history'])->name('Order_history');
    Route::get('preferences',[UserControl::class, 'preference'])->name('preferences');
   Route::get('orderProduct/{id}/{cat_id}', [ProductControl::class, 'order'])->name('orderProduct');




    Route::post('/cart/add', [UserControl::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [UserControl::class, 'viewCart'])->name('cart');
    Route::post('/cart/remove', [UserControl::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update', [UserControl::class, 'updateCart'])->name('cart.update');
   Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('place.order');

    // Route::get('payment', [CartController::class, 'showPayment'])->name('payment.show');
    // Route::get('payment/online', [CartController::class, 'showOnlinePayment'])->name('payment.online');
    // Route::get('payment/otc', [CartController::class, 'showOTCPayment'])->name('payment.otc');

Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
Route::get('/payment/online', [PaymentController::class, 'handleOnlinePayment'])->name('payment.online');
Route::get('/payment/otc', [PaymentController::class, 'handleOtcPayment'])->name('payment.otc');

Route::post('/order', [OrderController::class, 'store'])->name('order.store');


});


//Admin Routes
Route::middleware(['auth','AdminMiddleware'])->group(function(){
    Route::get('/admin/dashboard',[AdminControl::class, 'home'])->name('admin.dashboard');
    Route::get('/admin/product',[AdminControl::class, 'product'])->name('admin.product');
    Route::get('/admin/pos/{category}',[AdminControl::class, 'pos'])->name('admin.pos');

    Route::get('/admin/pos',[AdminControl::class, 'test'])->name('admin.test');
    Route::get('/admin/sales',[AdminControl::class, 'sales'])->name('admin.sales');

    Route::get('/admin/drink-menu/{category}',[AdminControl::class, 'drink'])->name('admin.drink-menu');
    Route::get('/admin/food-menu/{category}',[AdminControl::class, 'food'])->name('admin.food-menu');

    Route::get('/admin/orders',[AdminControl::class, 'orders'])->name('admin.orders');
    Route::get('/admin/orders', [OrderController::class, 'showOrders'])->name('admin.orders');;
    Route::get('/admin/product_info/{type}',[ProductControl::class, 'show'])->name('admin.product_info');
    Route::delete('/admin/product/{product}', [ProductControl::class, 'destroy'])->name('admin.product.destroy');
    Route::put('/admin/product/{id}', [ProductControl::class, 'update'])->name('admin.product.update');

    Route::get('/admin/extras', [ExtrasController::class, 'showall'])->name('admin.extras');
    Route::post('/admin.extras', [ExtrasController::class, 'store'])->name('admin.extras.store');
    Route::delete('/admin/extras/{id}', [ExtrasController::class, 'destroy'])->name('admin.extras.destroy');
    Route::put('/admin/extras/{id}', [ExtrasController::class, 'update'])->name('admin.extras.update');


    // Route::get('/admin/product_info/{cat_id}', [ExtrasController::class, 'show'])->name('admin.product_info');
    // Route::get('/admin/product_info/{cat_id}', [InfoControl::class, 'show'])->name('admin.product_info');


});

//Product Control routes
Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    Route::get('/admin/add', [ProductControl::class, 'create'])->name('admin.add');
    Route::post('/admin/add', [ProductControl::class, 'store'])->name('admin.store');
});

