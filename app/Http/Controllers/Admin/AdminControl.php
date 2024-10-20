<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminControl extends Controller
{
    public function home(){
        return view('admin.dashboard');
    }

    public function product(){
        return view('admin.product');
    }

    public function pos($category){
        $products = Product::where('cat_id', $category)->get();
        return view('admin.pos', compact('products', 'category'));
    }
    public function test(){
        return view('admin.pos');
    }

    public function sales(){
        return view('admin.sales');
    }

    public function orders(){
        return view('admin.orders');
    }

    public function welcome(){
        return view('welcome');
    }

    public function drink($category){
        $products = Product::where('type_id', $category)->get();
        return view('admin.drink-menu', compact('products', 'category'));
    }

    public function food($category){
        $products = Product::where('type_id', $category)->get();
        return view('admin.food-menu', compact('products', 'category'));
    }

    public function add(){
        return view('admin.add');
    }
}
