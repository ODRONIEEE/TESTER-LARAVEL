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
           $orderType = session('orderType'); 
 
        return view('payment', compact('orderData', 'totalPrice','orderType'));
    }


    public function handleOnlinePayment()
    {
       $orderData = session('orderData');
        $totalPrice = session('totalPrice');
            $orderType = session('orderType'); 
        session(['payment_method' => 'online']);
        
       return view('online', compact('orderData', 'totalPrice','orderType'));
    }

    public function handleOtcPayment()
    {
        $orderData = session('orderData');
        $totalPrice = session('totalPrice');
             $orderType = session('orderType'); 
         session(['payment_method' => 'Over the Counter']);
        return view('otc', compact('orderData', 'totalPrice','orderType'));
    }
}
