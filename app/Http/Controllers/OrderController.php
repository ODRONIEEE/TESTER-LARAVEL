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
        $request->validate([
            'customer_name' => 'required|string',
            'products' => 'required|json',
            'total_price' => 'required|numeric',
            'p_method' => 'required|string',
            'order_type' => 'required|string',
        ]);

        // Decode the products from JSON
        $products = json_decode($request->products, true);
        $formattedProducts = [];

        // Restructure products and their extras
        foreach ($products as $product) {
            $productData = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $product['quantity'] ?? 1,
                'temperature' => $product['temperature'] ?? null, // Ensure temperature is included
                'extras' => [] // Initialize extras array for this product
            ];

            // If this product has extras, add them to the product's extras array
            if (isset($product['extras']) && !empty($product['extras'])) {
                foreach ($product['extras'] as $extra) {
                    if (is_array($extra)) {
                        $productData['extras'][] = [
                            'id' => $extra['id'],
                            'name' => $extra['name'],
                            'price' => $extra['price'],
                            'quantity' => $extra['quantity'] ?? 1
                        ];
                    }
                }
            }

            $formattedProducts[] = $productData;
        }

        // Create the transaction data
        $transactionData = [
            'user_id' => $request->userId,
            'customer_name' => $request->customer_name,
            'total_price' => $request->total_price,
            'p_method' => $request->p_method,
            'order_type' => $request->order_type,
            'dateCreated' => now(),
            'products' => json_encode($formattedProducts), // Store formatted products as JSON string
            'status' => 'Pending'
        ];

        try {
            // Create the transaction
            $transaction = Transaction::create($transactionData);
            session()->forget('cart'); // Clear the cart after successful order
            return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
        } catch (\Exception $e) {
            Log::error('Order creation failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to place the order. Please try again later.']);
        }
    }

    public function showOrders()
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            // Decode the JSON strings to arrays only for products
            $products = is_string($order->products) ? json_decode($order->products, true) : $order->products;

            // Format the products and their extras
            if ($products) {
                $formattedProducts = [];
                foreach ($products as $product) {
                    $productData = [
                        'id' => $product['id'] ?? null,
                        'name' => $product['name'] ?? 'N/A',
                        'price' => $product['price'] ?? 0,
                        'quantity' => $product['quantity'] ?? 1
                    ];

                    // Check if this product has extras in the main extras array
                    if (isset($product['extras']) && !empty($product['extras'])) {
                        $productData['extras'] = array_map(function($extra) {
                            return [
                                'id' => $extra['id'] ?? null,
                                'name' => $extra['name'] ?? 'N/A',
                                'price' => $extra['price'] ?? 0,
                                'quantity' => $extra['quantity'] ?? 1
                            ];
                        }, $product['extras']);
                    } else {
                        $productData['extras'] = [];
                    }

                    $formattedProducts[] = $productData;
                }
                $order->products = $formattedProducts;
            }
        }

        return view('admin.orders', ['orders' => $orders]);
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

    foreach ($completedOrders as $order) {
        $order->products = is_string($order->products) ? json_decode($order->products, true) : $order->products;

        foreach ($order->products as $product) {
            $productDetails = Product::find($product['id']);

            if ($productDetails) {
                $typeId = $productDetails->type_id;
                $category = $this->getCategoryByTypeId($typeId);
                $price = $product['price'];
                $quantity = $product['quantity'] ?? 1; // Get the quantity, default to 1 if not set

                if (array_key_exists($category, $categorySales)) {
                    $categorySales[$category] += ($price * $quantity); // Multiply price by quantity
                    $categoryCounts[$category] += $quantity; // Add the actual quantity instead of incrementing by 1
                }

                $totalSales += ($price * $quantity);
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
        $status = $request->input('status');
        $validStatuses = ['Pending', 'On Process', 'Completed', 'Voided'];

        if (!in_array($status, $validStatuses)) {
            return response()->json(['success' => false, 'message' => 'Invalid status.'], 400);
        }

        // Try to find in Transaction first, then in Order
        $transaction = Transaction::find($id);
        $order = Order::find($id);

        if ($transaction) {
            // If status is 'On Process', update stock
            if ($status === 'On Process') {
                $products = is_string($transaction->products) ? json_decode($transaction->products, true) : $transaction->products;
                foreach ($products as $orderProduct) {
                    $product = Product::find($orderProduct['id']);
                    if ($product) {
                        $product->stock -= $orderProduct['quantity'];
                        $product->save();
                    }
                }
            }
            $transaction->status = $status;
            $transaction->save();
            return response()->json(['success' => true, 'status' => $transaction->status]);
        } elseif ($order) {
            $order->status = $status;
            $order->save();
            return response()->json(['success' => true, 'status' => $order->status]);
        } else {
            return response()->json(['success' => false, 'message' => 'Order/Transaction not found.'], 404);
        }
    }

public function deleteTransaction($id)
{
    try {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}




}
