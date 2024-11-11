<?php

namespace App\Http\Controllers;


use App\Models\Extras;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ExtrasController;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function order($id, $cat_id)
{
    $product = Product::findOrFail($id);

    // Fetch extras based on the cat_id
    $extras = Extras::where('cat_id', $cat_id)->get()->groupBy('cat_id');

    return view('orderProduct', compact('product', 'extras'));
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


    /**
     * Display the specified resource.
     */
    public function show($type)
{
    $products = Product::where('type_id', $type)->get();
    return view('admin.product_info', compact('products'));
}

    public function index($type)
    {
        $products = Product::where('type', $type)->get();
        return view('admin.product_info', compact('products'));
    }



    /**
     * Update the specified resource in storage.
     */

public function update(Request $request, $id){
    // Validate the request data
    $request->validate([
        'name' => 'string|max:255',
        'price' => 'numeric|min:0',
        'stock' => 'integer|min:0',
        'description' => 'string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102400',
    ]);

    $product = Product::findOrFail($id);

    $product->name = $request->name;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->description = $request->description;

    if ($request->hasFile('image')) {
        // Delete old image
        if ($product->image) {
            $oldImagePath = public_path($product->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Store new image
        $image = $request->file('image');
        $imageName = $request->name . '_' . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);
        $product->image = 'uploads/' . $imageName;
    }

    $product->save();

    return redirect()->route('admin.product')->with('success', 'Product updated successfully');
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
    return redirect()->route('admin.product')->with('success', 'Product deleted successfully');
    }

}
