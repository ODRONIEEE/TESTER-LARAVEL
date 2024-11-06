<?php

// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Show the payment selection page
    public function showPaymentPage()
    {
    
        $orderData = session('orderData');
        $totalPrice = session('totalPrice');
        
 
        return view('payment', compact('orderData', 'totalPrice'));
    }


    public function handleOnlinePayment()
    {
       $orderData = session('orderData');
        $totalPrice = session('totalPrice');
        session(['payment_method' => 'online']);
        
       return view('online', compact('orderData', 'totalPrice'));
    }

    public function handleOtcPayment()
    {
        $orderData = session('orderData');
        $totalPrice = session('totalPrice');
         session(['payment_method' => 'Over the Counter']);
        return view('otc', compact('orderData', 'totalPrice'));
    }
}
