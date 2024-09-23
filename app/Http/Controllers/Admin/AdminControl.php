<?php

namespace App\Http\Controllers\Admin;

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
    public function pos(){
        return view('admin.pos');
    }
    public function sales(){
        return view('admin.sales');
    }

}
