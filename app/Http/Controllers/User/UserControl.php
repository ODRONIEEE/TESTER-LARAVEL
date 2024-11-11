<?php

namespace App\Http\Controllers\User;


use App\Models\Order;
use App\Models\Extras;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ExtrasController;

class UserControl extends Controller
{
    public function home(){
         // Fetch all transactions
         $transactions = Transaction::all();

         // Initialize an array to store quantities for each product
         $productQuantities = [];

         // Loop through each transaction and aggregate product quantities
         foreach ($transactions as $transaction) {
             $products = json_decode($transaction->products);
             if (!is_array($products) && !is_object($products)) {
                 continue;
             }

             foreach ($products as $item) {
                 $productId = $item->id;
                 $quantity = $item->quantity;

                 // Retrieve product details
                 $product = Product::find($productId);

                 // Skip if the product is not found
                 if (!$product) {
                     continue;
                 }

                 // Accumulate quantities for each product
                 if (isset($productQuantities[$productId])) {
                     $productQuantities[$productId]['quantity'] += $quantity;
                 } else {
                     $productQuantities[$productId] = [
                         'product_id' => $productId,
                         'product_name' => $product->name,
                         'quantity' => $quantity,
                         'price' => $product->price,
                         'image' => $product->image ?? null,
                     ];
                 }
             }
         }

         // Convert to array and sort by quantity in descending order
         $productQuantities = array_values($productQuantities);
         usort($productQuantities, function ($a, $b) {
             return $b['quantity'] <=> $a['quantity'];
         });

         // Get only the top 5 products
         $topProducts = array_slice($productQuantities, 0, 5);


        return view('welcome', compact('topProducts'));
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

    // Make sure the price is a valid number
    $price = is_numeric($price) ? floatval($price) : 0;

      if ($temperature === 'hot') {
        $price -= 10;  // Reduce price by 10 if hot
    }
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
public function removeFromCart(Request $request)
{
    $productId = $request->input('product_id');

    // Get current cart from session
    $cart = session()->get('cart', []);

    // Remove the item with the matching product ID
    foreach ($cart as $key => $item) {
        if ($item['id'] == $productId) {
            unset($cart[$key]);
            break;
        }
    }

    // Re-index the array to avoid gaps in the array keys
    $cart = array_values($cart);

    // Save the updated cart to the session
    session(['cart' => $cart]);

    return redirect()->route('cart')->with('success', 'Product removed from cart!');
}

public function updateCart(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');

    // Get current cart from session
    $cart = session()->get('cart', []);

    // Find the product in the cart and update its quantity
    foreach ($cart as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] = $quantity;
            break;
        }
    }

    // Save the updated cart to the session
    session(['cart' => $cart]);

    return response()->json(['success' => true]);
}

public function history()
{
    // Fetch all orders
    $orders = Order::all();

    // Manually decode the products and extras fields if they are stored as JSON strings
    foreach ($orders as $order) {
        $order->products = is_string($order->products) ? json_decode($order->products, true) : $order->products;
        $order->extras = is_string($order->extras) ? json_decode($order->extras, true) : $order->extras;
    }

    // Return orders to the view
    return view('Order_history', compact('orders'));
}

}
