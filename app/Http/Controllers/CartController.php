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

        $products = json_decode($request->products, true);
        $formattedProducts = [];

        foreach ($products as $product) {
            $productData = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $product['quantity'] ?? 1,
                'extras' => []
            ];

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

        $transactionData = [
            'user_id' => $request->userId,
            'customer_name' => $request->customer_name,
            'total_price' => $request->total_price,
            'p_method' => $request->p_method,
            'order_type' => $request->order_type,
            'dateCreated' => now(),
            'products' => json_encode($formattedProducts),
            'status' => 'Pending'
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
        $orders = Order::all();

        foreach ($orders as $order) {
            $products = is_string($order->products) ? json_decode($order->products, true) : $order->products;

            if ($products) {
                $formattedProducts = [];
                foreach ($products as $product) {
                    $productData = [
                        'id' => $product['id'] ?? null,
                        'name' => $product['name'] ?? 'N/A',
                        'price' => $product['price'] ?? 0,
                        'quantity' => $product['quantity'] ?? 1
                    ];

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
        $completedOrders = Order::where('status', 'Completed')->get();

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
            'Burgers' => 0
        ];

        $categoryCounts = [
            'Coffee' => 0,
            'Non-Coffee' => 0,
            'Refreshers' => 0,
            'Tea' => 0,
            'Pastries' => 0,
            'Pasta' => 0,
            'Rice Meal' => 0,
            'Appetizer' => 0,
            'Burgers' => 0
        ];

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
            5 => 'Appetizer',
            6 => 'Pasta',
            7 => 'Burgers',
            8 => 'Rice Meal',
            9 => 'Pastries',
        ];

        return $categoryMap[$typeId] ?? 'Unknown';
    }

    public function updateStatus(Request $request, $id)
{
    $transaction = Transaction::find($id);
    if ($transaction) {
        if ($request->status === 'On Process') {
            // Decode the products from the transaction
            $products = json_decode($transaction->products, true);

            // Update stock for each product
            foreach ($products as $orderProduct) {
                $product = Product::find($orderProduct['id']);
                if ($product) {
                    // Deduct the ordered quantity from stock
                    $product->stock -= $orderProduct['quantity'];
                    $product->save();
                }
            }
        }

        $transaction->status = $request->status;
        $transaction->save();

        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 400);
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
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'temperature' => 'required|string',
            'extras' => 'nullable|array',
        ]);

        $product = [
            'id' => $request->product_id,
            'name' => $request->product_name,
            'quantity' => $request->quantity,
            'temperature' => $request->temperature,
            'price' => $request->price,
            'extras' => $request->extras ?? [],
        ];

        $cart = Session::get('cart', []);
        $cart[] = $product;
        Session::put('cart', $cart);

        // Generate a unique transaction ID
        $transactionId = strtoupper(uniqid('TXN'));
        Session::put('transactionId', $transactionId);

        return redirect()->route('payment.show')->with('success', 'Product added to cart!');
    }

    public function showPayment()
    {
        $transactionId = Session::get('transactionId');

        // Calculate total price
        $cart = Session::get('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('payment', compact('transactionId', 'totalPrice'));
    }

    public function showOnlinePayment()
    {
        $transactionId = Session::get('transactionId');


        $cart = Session::get('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('online', compact('transactionId', 'totalPrice'));
    }

    public function showOTCPayment()
    {
        $transactionId = Session::get('transactionId');


        $cart = Session::get('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('otc', compact('transactionId', 'totalPrice'));
    }


}
