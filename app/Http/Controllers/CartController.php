<?php
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
