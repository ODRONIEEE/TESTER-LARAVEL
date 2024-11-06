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
        $extras = Extras::all()->groupBy('cat_id'); 
        return view('admin.extras', compact('extras'));
    }

    /**
     * Show products with extras.
     */
    public function showProductsWithExtras()
    {
        $products = Product::all();
        $extras = Extras::all();
        return view('admin.product_info', compact('products', 'extras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.extras.create'); // Return create view
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

        Extras::create($request->all()); // Mass assignment if fields are fillable

        return redirect()->route('admin.extras')->with('success', 'Extras added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $extra = Extras::findOrFail($id);
        return view('admin.extras.edit', compact('extra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $extra = Extras::findOrFail($id);
        $extra->update($request->only(['name', 'price', 'quantity'])); // Mass assignment

        return redirect()->route('admin.extras')->with('success', 'Extra item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $extra = Extras::findOrFail($id);
        $extra->delete();

        return redirect()->route('admin.extras')->with('success', 'Extra item deleted successfully!');
    }
}
