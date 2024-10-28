<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function order()
    {
        return view('orderProduct');
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
    public function store(Request $request){

    // Validation
    $fields = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric', // Allow decimal prices
        'stock' => 'required|integer',
        'image' => 'required|image|max:102400',
        'cat_id' => 'integer',
        'espresso_id' => 'integer|nullable',
        'type_id' => 'integer',
        'sugar_id' => 'integer|nullable',
    ]);

    // Generate Product Code
    $product_code = IdGenerator::generate([
        'table' => 'product',
        'field'=> 'product_code',
        'length' => 5,
        'prefix' => 'PRD_C'
    ]);

    $filePath = 'uploads'; // Changed this to be relative to public directory
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $file_name = $fields['name'] . '_' . time(); // Unique filename
        $file->move(public_path($filePath), $file_name);
        $fields['image'] = $filePath . '/' . $file_name; // Save relative path
    }
    $fields['product_code'] = $product_code;


    // Create the product
    Product::create($fields);

    // Redirect with success message
    return redirect()->route('admin.product')->with('success', 'Product created successfully');
    }

    // Helper method for file upload
    private function handleFileUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            return basename($request->file('image')->store('products', 'public'));
        }
        return null;
    }


    /**
     * Display the specified resource.
     */
    public function show($type)
    {
        $products = Product::where('type_id', $type)->get();
        return view('admin.product_info', compact('products', 'type'));
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
    public function destroy(product $product)
    {
         // Delete the image file if it exists
    if ($product->image) {
        $imagePath = public_path($product->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the product
    $product->delete();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Product deleted successfully');
    }

}
