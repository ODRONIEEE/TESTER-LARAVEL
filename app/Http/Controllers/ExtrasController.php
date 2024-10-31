<?php

namespace App\Http\Controllers;

use App\Models\Extras;
use App\Models\Product;
use Illuminate\Http\Request;

class ExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extras = Extras::all();
        return view('admin.extras', compact('extras'));
    }


public function show()
{
    $products = Product::get();
    $extras = Extras::get();
    return view('admin.product_info', compact('products', 'extras', 'cat_id'));
}

public function showExtrasByCategory()
{

    // $extras = Extras::where('category_id', $cat_id)->get(); // Assuming you have an Extra model

    return view('admin.product_info', compact('products', 'extras', 'cat_id'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'cat_id' => 'required|integer',
    ]);

    $product = new Extras();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->cat_id = $request->cat_id;
    $product->save();

    return redirect()->route('admin.extras')->with('success', 'extras added successfully!');
}




public function edit($id)
{
    $extra = Extras::findOrFail($id);
    $extras = Extras::all();
    return view('admin.extras.edit', compact('extra', 'extras'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
    ]);

    $extra = Extras::findOrFail($id);
    $extra->name = $request->name;
    $extra->price = $request->price;
    $extra->quantity = $request->quantity;
    $extra->save();

    return redirect()->route('admin.extras.index')->with('success', 'Extra item updated successfully!');
}


public function destroy($id)
{
    $extra = Extras::findOrFail($id);
    $extra->delete();


    return redirect()->route('admin.extras')->with('success', 'Extra item deleted successfully!');
}

}
