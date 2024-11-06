<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        try {
      
            $orderData = $request->input('order');
            $totalPrice = $request->input('totalPrice');

           session()->put('orderData', $orderData);
           session()->put('totalPrice', $totalPrice);
      

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
    ]);

 
    $products = json_decode($request->products, true);



  
    $allExtras = [];
    foreach ($products as $product) {
        if (isset($product['extras']) && !empty($product['extras'])) {
    
            foreach ($product['extras'] as $key => $extra) {
                if (is_array($extra)) {
       
                    $allExtras[] = $extra;
                } elseif (is_string($extra)) {
              
                    $allExtras[] = [
                        'id' => $extra,
                        'name' => 'Unknown',
                        'price' => 0, 
                    ];
                } else {
          
     
                }
            }
        }
    }


    $transactionData = [
        'customer_name' => $request->customer_name,
        'total_price' => $request->total_price,
        'p_method' => $request->p_method,
        'dateCreated' => now(),
        'products' => json_encode($products), 
        'extras' => json_encode($allExtras),   
    ];

    try {

        $transaction = Transaction::create($transactionData);

  
        // return redirect()->route('cart')->with('success', 'Transaction added successfully!');
    } catch (\Exception $e) {


    }
}
  public function showOrders()
    {
        // Fetch all orders
        $orders = Order::all();

        // Return orders in JSON format
      return view('admin/orders', compact('orders'));
    }


}


