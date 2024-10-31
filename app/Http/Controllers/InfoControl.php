<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Extras;

class InfoControl extends Controller
{
    public function show($cat_id)
    {
        $products = Product::where('category_id', $cat_id)->get();
        $extras = Extras::where('category_id', $cat_id)->get();

        return view('admin.product_info', compact('products', 'extras', 'cat_id'));
    }
}
