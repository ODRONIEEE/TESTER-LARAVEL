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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ExtrasController;

class UserControl extends Controller
{

    public function home()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Initialize variables
        $transactionCount = 0;
        $topProducts = [];

        if ($user) {
            // Count transactions for the authenticated user based on customer_name
            $transactionCount = Transaction::where('customer_name', $user->name)
                                         ->where('status', 'Completed')
                                         ->count();

            // Fetch all completed transactions
            $transactions = Transaction::where('status', 'Completed')->get();

            // Initialize array to store product quantities
            $productQuantities = [];

            // Process each transaction
            foreach ($transactions as $transaction) {
                $products = json_decode($transaction->products);

                // Skip if products is not valid JSON
                if (!is_array($products) && !is_object($products)) {
                    continue;
                }

                // Process each product in the transaction
                foreach ($products as $item) {
                    if (!isset($item->id) || !isset($item->quantity)) {
                        continue;
                    }

                    $productId = $item->id;
                    $quantity = $item->quantity;

                    // Get product details
                    $product = Product::find($productId);
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

            // Sort products by quantity sold
            if (!empty($productQuantities)) {
                $productQuantities = array_values($productQuantities);
                usort($productQuantities, function($a, $b) {
                    return $b['quantity'] <=> $a['quantity'];
                });

                // Get top 5 products
                $topProducts = array_slice($productQuantities, 0, 5);
            }
        }

        // Get cart item count for the cart badge
        $cartItemCount = count(session()->get('cart', []));

        return view('welcome', [
            'transactionCount' => $transactionCount,
            'topProducts' => $topProducts,
            'cartItemCount' => $cartItemCount
        ]);
    }
    public function menu(){

        $products = Product::where('stock', '>', 0)->get();
        Log::info('Products:', $products->toArray());
        return view('menu', compact('products'));

    }
    public function userprofile(){
        return view('userProfile');
    }


    public function preference(){
        return view('preferences');
    }


    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function cart()
    {
        // Get current cart
        $cart = Session::get('cart', []);

        // Calculate totals
        $totalItems = array_sum(array_column($cart, 'quantity'));
        $totalPrice = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Get recommendations from CartService
        $recommendationData = $this->cartService->getRecommendations();

        return view('cart', [
            'cart' => $cart,
            'totalItems' => $totalItems,
            'totalPrice' => $totalPrice,
            'recommendations' => $recommendationData['recommendations'],
            'recommendationType' => $recommendationData['recommendationType'],
            'itemCounts' => $recommendationData['counts']
        ]);
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
public function removeExtra(Request $request)
{
    $productId = $request->product_id;
    $extraIndex = $request->extra_index;

    $cart = session()->get('cart', []);
    $updated = false;

    // Find the correct cart item
    foreach ($cart as $index => $item) {
        if ($item['id'] == $productId) {
            // Decode extras if it's a JSON string
            $extras = is_string($item['extras']) ? json_decode($item['extras'], true) : $item['extras'];

            // Remove the specific extra
            if (isset($extras[$extraIndex])) {
                unset($extras[$extraIndex]);
                // Reindex the array
                $extras = array_values($extras);

                // Update the cart item with the modified extras
                $cart[$index]['extras'] = json_encode($extras);
                $updated = true;
            }
        }
    }

    if ($updated) {
        // Save the updated cart back to the session
        session(['cart' => $cart]);

        // Calculate new total
        $newTotal = $this->calculateCartTotal($cart);

        // Get the updated extras for this product
        $updatedExtras = [];
        foreach ($cart as $item) {
            if ($item['id'] == $productId) {
                $updatedExtras = json_decode($item['extras'], true);
                break;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Extra removed successfully',
            'new_total' => $newTotal,
            'updatedExtras' => $updatedExtras,
            'cart' => $cart
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Extra not found'
    ]);
}

private function calculateCartTotal($cart)
{
    $total = 0;
    foreach ($cart as $item) {
        $basePrice = $item['price'] * $item['quantity'];
        $extrasTotal = 0;

        if (!empty($item['extras'])) {
            $extras = is_string($item['extras'])
                ? json_decode($item['extras'], true)
                : $item['extras'];

            foreach ($extras as $extra) {
                if (isset($extra['price'])) {
                    $extrasTotal += $extra['price'] * $item['quantity'];
                }
            }
        }

        $total += $basePrice + $extrasTotal;
    }
    return $total;
}

}
