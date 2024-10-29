<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    public function getCart()
    {
        return Session::get('cart', []);
    }

    public function getCartItemCount()
    {
        $cart = $this->getCart();
        return array_sum(array_column($cart, 'quantity'));
    }

    public function addToCart($product, $quantity = 1)
    {
        $cart = $this->getCart();

        $cartItem = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
        ];

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = $cartItem;
        }

        Session::put('cart', $cart);
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        Session::put('cart', $cart);
    }


}
