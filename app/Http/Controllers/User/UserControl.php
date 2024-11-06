<?php

namespace App\Http\Controllers\User;


use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Http\Controllers\ExtrasController;
use App\Models\Extras;

class UserControl extends Controller
{
    public function home(){
        return view('dashboard');
    }
    public function menu(){

        $products = Product::where('stock', '>', 0)->get();
        Log::info('Products:', $products->toArray());
        return view('menu', compact('products'));

    }
    public function userprofile(){
        return view('userProfile');
    }
    public function cart(){

        $cart = Session::get('cart', []);
        $totalItems = array_sum(array_column($cart, 'quantity'));
        $totalPrice = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('cart', compact('cart', 'totalItems', 'totalPrice'));
    }
    public function history(){
        return view('Order_history');
    }
    public function preference(){
        return view('preferences');
    }



    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

public function addToCart(Request $request)
{
    $product = Product::findOrFail($request->input('product_id'));
    $quantity = $request->input('quantity', 1);
    $temperature = $request->input('temperature');
    $price = $request->input('price');
    
    // Fetch extras from the request
    $extras = json_decode($request->input('extras'), true);
    $extrasDetails = [];

    if (!empty($extras)) {
        // Retrieve extra details from the database
        $extrasDetails = Extras::whereIn('id', $extras)->get(['id', 'name', 'price'])->toArray();
    }

    // Check if extrasDetails is being populated correctly
    if (empty($extrasDetails)) {
        // Debugging: Output the contents of extras
        echo '<pre>'; print_r($extras); echo '</pre>';
    }

    // Encode extras as JSON instead of an array
    $encodedExtras = json_encode($extrasDetails);

    // Add the product to cart with encoded extras
    $cartItem = [
        'id' => $product->id,
        'name' => $product->name,
        'price' => $price,
        'quantity' => $quantity,
        'temperature' => $temperature,
        'extras' => $encodedExtras, // Store extras as JSON string
    ];

    // Save to session
    $cart = session()->get('cart', []);
    $cart[] = $cartItem;
    session(['cart' => $cart]);

    return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
}





    public function viewCart()
    {
        $cart = $this->cartService->getCart();
        return view('cart', compact('cart'));
    }

    public function removeFromCart($itemId)
    {
        $this->cartService->removeFromCart($itemId);
        return redirect()->route('cart')->with('success', 'Item removed from cart successfully');
    }

    public function updateCart(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);
        $this->cartService->updateCartSelection($selectedItems);

        return redirect()->route('cart')->with('success', 'Cart updated successfully');
    }


}
