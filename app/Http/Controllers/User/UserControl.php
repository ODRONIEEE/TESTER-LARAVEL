<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;

class UserControl extends Controller
{
    public function home(){
        return view('dashboard');
    }
    public function menu(){

    return view('menu');
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
