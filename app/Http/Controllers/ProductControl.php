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
    // Validation
    $fields = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric', // Allow decimal prices
        'stock' => 'required|integer',
        'image' => 'required|image|max:10240',
        'cat_id' => 'integer',
        'espresso_id' => 'integer',
        'type_id' => 'integer',
        'sugar_id' => 'integer',
    ]);

    // Generate Product Code
    $product_code = IdGenerator::generate([
        'table' => 'product',
        'field'=> 'product_code',
        'length' => 5,
        'prefix' => 'PRD_C'
    ]);

    $filePath = public_path('uploads');
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $file_name = time() . '_' . $file->getClientOriginalName(); // Unique filename
        $file->move($filePath, $file_name);
        $fields['image'] = $file_name; // Save with 'image' key
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
        $product->delete();
        return view('admin.product_info')->with('success', 'Product deleted successfully');
    }
}
