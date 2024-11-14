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
use App\Http\Controllers\ProductRankingController;
use App\Http\Controllers\NotificationController;


// test of notif only
Route::get('/test-notification', function () {
    $transaction = \App\Models\Transaction::find(12); // Replace with an actual ID
    $transaction->user->notify(new \App\Notifications\OrderCompleted($transaction));
    return "Notification sent!";
});


// Notification Ajax 
Route::get('/notifications', [NotificationController::class, 'fetchNotifications'])->name('notifications.fetch');
Route::post('/notifications/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');


Route::get('/', [ProductRankingController::class, 'welcome'])->name('welcome');
route::get('Terms', function(){return view('Terms'); })->name('Terms');
route::get('privacy', function(){return view('privacy'); })->name('privacy');


Route::get('/best-selling-products', [ProductRankingController::class, 'rankBestSellingProducts']);
Route::get('/top-products-by-type', [ProductRankingController::class, 'rankBestSellingProductsByType'])->name('top.products.by.type');
Route::get('/top-one-products-by-type', [ProductRankingController::class, 'rankTopOneSellingProductsByType'])->name('top.one.products.by.type');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//User Routes
Route::middleware(['auth','UserMiddleware'])->group(function(){

    Route::get('welcome',[UserControl::class, 'home'])->name('welcome');
    Route::get('menu',[UserControl::class, 'menu'])->name('menu');
    Route::get('userProfile',[UserControl::class, 'userProfile'])->name('userProfile');
    Route::get('Order_history',[UserControl::class, 'history'])->name('Order_history');
    Route::get('preferences',[UserControl::class, 'preference'])->name('preferences');

    Route::get('orderProduct/{id}/{cat_id}', [ProductControl::class, 'order'])->name('orderProduct');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

    Route::get('cart',[UserControl::class, 'cart'])->name('cart');
    Route::post('/cart/add', [UserControl::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [UserControl::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update', [UserControl::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove-extra', [UserControl::class, 'removeExtra'])->name('cart.remove-extra');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('place.order');

Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
Route::get('/payment/online', [PaymentController::class, 'handleOnlinePayment'])->name('payment.online');
Route::get('/payment/otc', [PaymentController::class, 'handleOtcPayment'])->name('payment.otc');

});


//Admin Routes
Route::middleware(['auth','AdminMiddleware'])->group(function(){
    Route::get('/admin/dashboard',[AdminControl::class, 'home'])->name('admin.dashboard');
    Route::get('/admin/product',[AdminControl::class, 'product'])->name('admin.product');
    Route::get('/admin/pos/{category}',[AdminControl::class, 'pos'])->name('admin.pos');
    Route::get('/admin/sales',[OrderController::class, 'showsales'])->name('admin.sales');
    Route::get('/admin/pos',[AdminControl::class, 'test'])->name('admin.test');


    Route::get('/admin/drink-menu/{category}',[AdminControl::class, 'drink'])->name('admin.drink-menu');
    Route::get('/admin/food-menu/{category}',[AdminControl::class, 'food'])->name('admin.food-menu');

    Route::get('/admin/orders',[AdminControl::class, 'orders'])->name('admin.orders');
    Route::get('/admin/orders', [OrderController::class, 'showOrders'])->name('admin.orders');
    Route::delete('/delete-transaction/{id}', [OrderController::class, 'deleteTransaction'])->name('delete.transaction');

    Route::get('/admin/product_info/{type}',[ProductControl::class, 'show'])->name('admin.product_info');
    Route::delete('/admin/product/{product}', [ProductControl::class, 'destroy'])->name('admin.product.destroy');
    Route::put('/admin/product/{id}', [ProductControl::class, 'update'])->name('admin.product.update');
    Route::get('/admin/orders/filter', [OrderController::class, 'filterOrders'])->name('orders.filter');
    Route::post('/update-order-status/{id}', [OrderController::class, 'updateStatus']);
    Route::get('/admin/extras', [ExtrasController::class, 'showall'])->name('admin.extras');
    Route::post('/admin.extras', [ExtrasController::class, 'store'])->name('admin.extras.store');
    Route::delete('/admin/extras/{id}', [ExtrasController::class, 'destroy'])->name('admin.extras.destroy');
    Route::put('/admin/extras/{id}', [ExtrasController::class, 'update'])->name('admin.extras.update');

});

//Product Control routes
Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    Route::get('/admin/add', [ProductControl::class, 'create'])->name('admin.add');
    Route::post('/admin/add', [ProductControl::class, 'store'])->name('admin.store');
});

