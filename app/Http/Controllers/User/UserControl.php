<?php

namespace App\Http\Controllers\User;


use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Services\CartService;



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
        $product = Product::findOrFail($request->product_id);
        $this->cartService->addToCart($product, $request->quantity ?? 1);
        return redirect()->back()->with('success', 'Product added to cart');
    }

    public function viewCart()
    {
        $cart = $this->cartService->getCart();
        return view('cart', compact('cart'));
    }

    public function removeFromCart(Request $request)
    {
        $this->cartService->removeFromCart($request->product_id);
        return redirect()->back()->with('success', 'Product removed from cart');
    }

}
