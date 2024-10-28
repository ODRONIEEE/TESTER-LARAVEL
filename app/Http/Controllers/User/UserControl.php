<?php

namespace App\Http\Controllers\User;


use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class UserControl extends Controller
{
    public function home(){
        return view('dashboard');
    }
    public function menu(){

        $products = Product::where('stock', '>', 0)->get();
        Log::info('Products:', $products->toArray());
        return view('menu', compact('products'));

    }
    public function userprofile(){
        return view('userProfile');
    }
    public function cart(){
        return view('cart');
    }
    public function history(){
        return view('Order_history');
    }
    public function preference(){
        return view('preferences');
    }

}
