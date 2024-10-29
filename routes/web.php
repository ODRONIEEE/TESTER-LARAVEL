<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductControl;
use App\Http\Controllers\User\UserControl;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminControl;

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
    Route::get('orderProduct',[ProductControl::class, 'order'])->name('orderProduct');
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

});

//Product Control routes
Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    Route::get('/admin/add', [ProductControl::class, 'create'])->name('admin.add');
    Route::post('/admin/add', [ProductControl::class, 'store'])->name('admin.store');
    Route::get('/admin/product_info/{type}',[ProductControl::class, 'show'])->name('admin.product_info');
    Route::delete('/admin/product/{product}', [ProductControl::class, 'destroy'])->name('admin.product.destroy');
    Route::put('/admin/product/{id}', [ProductControl::class, 'update'])->name('admin.product.update');

});

