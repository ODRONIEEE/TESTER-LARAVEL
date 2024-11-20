<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartService
{


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



    public function getRecommendations()
    {
        $cart = $this->getCart();

        // Initialize counters
        $drinkCount = 0;
        $foodCount = 0;

        // Count items by category in cart
        foreach ($cart as $cartItem) {
            $product = Product::with('type')->find($cartItem['id']);
            if ($product && $product->type) {
                $quantity = isset($cartItem['quantity']) ? $cartItem['quantity'] : 1;
                if ($product->type->category === 'drink') {
                    $drinkCount += $quantity;
                } else {
                    $foodCount += $quantity;
                }
            }
        }

        // Determine which category to recommend
        if ($drinkCount > $foodCount) {
            $recommendCategory = 'food';
        } elseif ($foodCount > $drinkCount) {
            $recommendCategory = 'drink';
        } else {
            $recommendCategory = 'both';
        }

        // Get transactions and calculate top products
        $transactions = Transaction::all();
        $productQuantities = [];

        foreach ($transactions as $transaction) {
            $products = json_decode($transaction->products);
            if (!is_array($products) && !is_object($products)) continue;

            foreach ($products as $item) {
                $product = Product::with('type')->find($item->id);
                if (!$product || !$product->type) continue;

                // For 'both' category or matching category
                if ($recommendCategory === 'both' ||
                    $product->type->category === $recommendCategory) {

                    $productId = $product->id;
                    if (!isset($productQuantities[$productId])) {
                        $productQuantities[$productId] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'image' => $product->image,
                            'type_id' => $product->type->id,
                            'category' => $product->type->category,
                            'quantity' => 0
                        ];
                    }
                    $productQuantities[$productId]['quantity'] += $item->quantity;
                }
            }
        }

        // Convert to array and sort by quantity
        $recommendations = array_values($productQuantities);
        usort($recommendations, function($a, $b) {
            return $b['quantity'] <=> $a['quantity'];
        });

        // Get top 4 recommendations
        $recommendations = array_slice($recommendations, 0, 4);

        return [
            'recommendations' => $recommendations,
            'recommendationType' => $recommendCategory,
            'counts' => [
                'drinks' => $drinkCount,
                'food' => $foodCount
            ]
        ];
    }

    /**
     * Conditional Handling for Recommendations for V2:
     *
     * When drinkCount > foodCount, only food-related products are considered for recommendations.
     * When foodCount > drinkCount, only drink-related products are considered.
     * When both are equal, all product categories are included.
     * Efficient Filtering:
     * 
     * The loop over transactions now explicitly checks the recommendCategory and processes items accordingly.
     */

    public function getRecommendations_v2()
    {
        $cart = $this->getCart();

   
        $drinkCount = 0;
        $foodCount = 0;

        // // Count items by category in cart
        // foreach ($cart as $cartItem) {
        //     $product = Product::with('type')->find($cartItem['id']);
        //     if ($product && $product->type) {
        //         $quantity = isset($cartItem['quantity']) ? $cartItem['quantity'] : 1;
        //         if ($product->type->category === 'drink') {
        //             $drinkCount += $quantity;
        //         } else {
        //             $foodCount += $quantity;
        //         }
        //     }
        // }

         // Count items by category in cart
         foreach ($cart as $cartItem) {
            $product = Product::with('category')->find($cartItem['id']);
            if ($product && $product->category) {
                $quantity = isset($cartItem['quantity']) ? $cartItem['quantity'] : 1;
                if ($product->category->id == 1) {
                    $drinkCount += $quantity;
                } elseif ($product->category->id == 2) {
                    $foodCount += $quantity;
                }
            }
        }


        /**
         * Category table
         * 1	Drinks
         * 2	Foods
         */
   
        // Initialize counters
        // Determine which category to recommend
        if ($drinkCount > $foodCount) {
            $recommendCategory = 'food';
        } elseif ($foodCount > $drinkCount) {
            $recommendCategory = 'drink';
        } else {
            $recommendCategory = 'both';
        }

  
        // Get transactions and calculate top products
        $transactions = Transaction::all();
        $productQuantities = [];

        foreach ($transactions as $transaction) {
            $products = json_decode($transaction->products);
            if (!is_array($products) && !is_object($products)) continue;

            foreach ($products as $item) {
                $product = Product::with('category')->find($item->id);
                if (!$product || !$product->category) continue;

                // Logic based on recommendation category
                if ($recommendCategory === 'food' && $product->category->id == 2 ) { # FOOD 
                    // Increment food product quantities
                    $productId = $product->id;
                    if (!isset($productQuantities[$productId])) {
                        $productQuantities[$productId] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'image' => $product->image,
                            'type_id' => $product->type->id,
                            'category' => $product->category->id,
                            'category_name' => $product->category->name,
                            'quantity' => 0
                        ];
                    }
                    $productQuantities[$productId]['quantity'] += $item->quantity;
                } elseif ($recommendCategory === 'drink' & $product->category->id == 1 ) { # DRINKS
                    // Increment drink product quantities
                    $productId = $product->id;
                    if (!isset($productQuantities[$productId])) {
                        $productQuantities[$productId] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'image' => $product->image,
                            'type_id' => $product->type->id,
                            'category' => $product->category->id,
                            'category_name' => $product->category->name,
                            'quantity' => 0
                        ];
                    }
                    $productQuantities[$productId]['quantity'] += $item->quantity;
                } elseif ($recommendCategory === 'both') { # GENERAL & LOCALE ?
                    // Include all categories for both
                    $productId = $product->id;
                    if (!isset($productQuantities[$productId])) {
                        $productQuantities[$productId] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'image' => $product->image,
                            'type_id' => $product->type->id,
                            'category' => $product->category->id,
                            'category_name' => $product->category->name,
                            'quantity' => 0
                        ];
                    }
                    $productQuantities[$productId]['quantity'] += $item->quantity;
                }
            }
        }

        // echo '<pre>';
        // print_r($cart );
        // print_r('drink: ' . $drinkCount);
        // print_r(' |food: ' . $foodCount);
        // print_r('<br> recom: '. $recommendCategory. '<br>');
        // print_r($productQuantities);
        // exit();


        // Convert to array and sort by quantity
        $recommendations = array_values($productQuantities);
        usort($recommendations, function($a, $b) {
            return $b['quantity'] <=> $a['quantity'];
        });

        // Get top 4 recommendations
        $recommendations = array_slice($recommendations, 0, 4);

        return [
            'recommendations' => $recommendations,
            'recommendationType' => $recommendCategory,
            'counts' => [
                'drinks' => $drinkCount,
                'food' => $foodCount
            ]
        ];
    }


    public function getCart()
    {
        return Session::get('cart', []);
    }

}