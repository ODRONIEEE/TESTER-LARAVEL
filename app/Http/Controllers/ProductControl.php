<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $fields = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|integer',
        'stock' => 'required|integer',
        'quantity' => 'required|integer',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product_code = IdGenerator::generate(['table' => 'products', 'field'=> 'product_code', 'length' => 5, 'prefix' => 'PRD_C']);
    $fields['product_code'] = $product_code; // Add the product code to the fields

    // Handle the file upload
    if ($request->hasFile('image')) { // Ensure this matches the input name
        $path = $request->file('image')->store('public/products');
        $fields['image'] = basename($path); // Store only the file name
    }

    Product::create($fields); // Ensure fields contains 'image'

    return redirect()->back()->with('success', 'Product created successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
