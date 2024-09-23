<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserControl;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminControl;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//User Routes

Route::middleware(['auth','UserMiddleware'])->group(function(){
    Route::get('welcome',[UserControl::class, 'welcome'])->name('welcome');
    Route::get('dashboard',[UserControl::class, 'home'])->name('dashboard');
    Route::get('menu',[UserControl::class, 'menu'])->name('menu');
    Route::get('cart',[UserControl::class, 'cart'])->name('cart');
    Route::get('userProfile',[UserControl::class, 'userProfile'])->name('userProfile');
});


//Admin Routes
Route::middleware(['auth','AdminMiddleware'])->group(function(){
    Route::get('welcome',[AdminControl::class, 'welcome'])->name('welcome');
    Route::get('/admin/dashboard',[AdminControl::class, 'home'])->name('admin.dashboard');
    Route::get('/admin/product',[AdminControl::class, 'product'])->name('admin.product');
    Route::get('/admin/pos',[AdminControl::class, 'pos'])->name('admin.pos');
    Route::get('/admin/sales',[AdminControl::class, 'sales'])->name('admin.sales');
});
