<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        try {

            $orderData = $request->input('order');
            $totalPrice = $request->input('totalPrice');
     $orderType = $request->input('orderType');
           session()->put('orderData', $orderData);
           session()->put('totalPrice', $totalPrice);

        session()->put('orderType', $orderType);





            return response()->json(['message' => 'Order data received successfully']);
        } catch (\Exception $e) {
            // If something goes wrong, return an error message
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
public function store(Request $request)
{
    // Validate incoming request
    $request->validate([
        'customer_name' => 'required|string',
        'products' => 'required|json', // Expect products as a JSON string
        'total_price' => 'required|numeric',
        'p_method' => 'required|string',
        'order_type' => 'required|string', // Added validation for order_type
    ]);

    $products = json_decode($request->products, true);
    $allExtras = [];
    foreach ($products as $product) {
        if (isset($product['extras']) && !empty($product['extras'])) {
            foreach ($product['extras'] as $extra) {
                if (is_array($extra)) {
                    $allExtras[] = $extra;
                } elseif (is_string($extra)) {
                    $allExtras[] = [
                        'id' => $extra,
                        'name' => 'Unknown',
                        'price' => 0,
                    ];
                }
            }
        }
    }

    $transactionData = [
        'customer_name' => $request->customer_name,
        'total_price' => $request->total_price,
        'p_method' => $request->p_method,
        'order_type' => $request->order_type,
        'dateCreated' => now(),
        'products' => json_encode($products),
        'extras' => json_encode($allExtras),
    ];

    try {

        $transaction = Transaction::create($transactionData);
        session()->forget('cart');
        return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
    } catch (\Exception $e) {
        Log::error('Order creation failed: ' . $e->getMessage());
        throw new \Exception('Failed to place the order. Please try again later. Error details: ' . $e->getMessage());
    }
}


public function showOrders()
{
    // Fetch all orders
    $orders = Order::all();

    // Manually decode the products and extras fields if they are stored as JSON strings
    foreach ($orders as $order) {
        $order->products = is_string($order->products) ? json_decode($order->products, true) : $order->products;
        $order->extras = is_string($order->extras) ? json_decode($order->extras, true) : $order->extras;
    }

    // Return orders to the view
    return view('admin.orders', compact('orders'));
}

public function showsales()
{
    // Fetch all completed orders
    $completedOrders = Order::where('status', 'Completed')->get();

    // Initialize counters for each category
    $totalSales = 0;
    $categorySales = [
        'Coffee' => 0,
        'Non-Coffee' => 0,
        'Refreshers' => 0,
        'Tea' => 0,
        'Pastries' => 0,
        'Pasta' => 0,
        'Rice Meal' => 0,
        'Appetizer' => 0,
        'Burgers' => 0  // Added Burgers category
    ];

    // Initialize counters for total product counts
    $categoryCounts = [
        'Coffee' => 0,
        'Non-Coffee' => 0,
        'Refreshers' => 0,
        'Tea' => 0,
        'Pastries' => 0,
        'Pasta' => 0,
        'Rice Meal' => 0,
        'Appetizer' => 0,
        'Burgers' => 0  // Added Burgers category
    ];

    // Rest of your existing foreach loop remains the same
    foreach ($completedOrders as $order) {
        $order->products = is_string($order->products) ? json_decode($order->products, true) : $order->products;

        foreach ($order->products as $product) {
            $productDetails = Product::find($product['id']);

            if ($productDetails) {
                $typeId = $productDetails->type_id;
                $category = $this->getCategoryByTypeId($typeId);
                $price = $product['price'];

                if (array_key_exists($category, $categorySales)) {
                    $categorySales[$category] += $price;
                    $categoryCounts[$category]++;
                }

                $totalSales += $price;
            }
        }
    }

    // Define $sales as the total sales
    $sales = $totalSales;

    return view('admin.sales', compact('sales', 'totalSales', 'categorySales', 'categoryCounts', 'completedOrders'));
}



public function getCategoryByTypeId($typeId)
{
    $categoryMap = [
        1 => 'Coffee',
        2 => 'Non-Coffee',
        3 => 'Refreshers',
        4 => 'Tea',
        5 => 'Appetizer',    // Changed from 'Appetizers' to 'Appetizer' to match the array keys
        6 => 'Pasta',
        7 => 'Burgers',      // Changed from 'Burger' to 'Burgers' to match the array keys
        8 => 'Rice Meal',
        9 => 'Pastries',
    ];

    return $categoryMap[$typeId] ?? 'Unknown';
}

public function updateStatus(Request $request, $id)
{
    $order = Order::find($id);
    if ($order) {
        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 400);
}





}


