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

    public function addToCart($product, $quantity = 1, $extras = null, $temperature = null, $price = null)
    {
        $cart = $this->getCart();

        $itemId = $product->id . '-' . $temperature;

        $cartItem = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $price ?? $product->price,
            'quantity' => $quantity,
            'temperature' => $temperature,
            'extras' => $extras ? (is_array($extras) ? $extras : json_decode($extras, true)) : null
        ];

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += $quantity;
            // Update extras if provided
            if ($extras) {
                $cart[$itemId]['extras'] = $cartItem['extras'];
            }
        } else {
            $cart[$itemId] = $cartItem;
        }

        Session::put('cart', $cart);
    }

    public function removeFromCart($itemId)
    {
        $cart = $this->getCart();
        unset($cart[$itemId]);
        Session::put('cart', $cart);
    }

    public function updateCartSelection(array $selectedItems)
    {
        $cart = $this->getCart();

        foreach ($cart as $itemId => $item) {
            if (!in_array($item['id'], $selectedItems)) {
                unset($cart[$itemId]);
            }
        }

        Session::put('cart', $cart);
    }

    public function updateCartItemQuantity($itemId, $quantity)
    {
        $cart = $this->getCart();
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }
    }
}
