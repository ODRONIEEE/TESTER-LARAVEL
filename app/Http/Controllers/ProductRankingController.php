<?php

namespace App\Http\Controllers;

// use App\Http\Requests\Transaction;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProductRankingController  extends Controller
{

    public function welcome()
    {
        // Fetch all transactions
        $transactions = Transaction::all();

        // Initialize an array to store quantities for each product
        $productQuantities = [];

        // Loop through each transaction and aggregate product quantities
        foreach ($transactions as $transaction) {
            $products = json_decode($transaction->products);
            if (!is_array($products) && !is_object($products)) {
                continue;
            }

            foreach ($products as $item) {
                $productId = $item->id;
                $quantity = $item->quantity;

                // Retrieve product details
                $product = Product::find($productId);

                // Skip if the product is not found
                if (!$product) {
                    continue;
                }

                // Accumulate quantities for each product
                if (isset($productQuantities[$productId])) {
                    $productQuantities[$productId]['quantity'] += $quantity;
                } else {
                    $productQuantities[$productId] = [
                        'product_id' => $productId,
                        'product_name' => $product->name,
                        'quantity' => $quantity,
                        'price' => $product->price,
                        'image' => $product->image ?? null,
                    ];
                }
            }
        }

        // Convert to array and sort by quantity in descending order
        $productQuantities = array_values($productQuantities);
        usort($productQuantities, function ($a, $b) {
            return $b['quantity'] <=> $a['quantity'];
        });

        // Get only the top 5 products
        $topProducts = array_slice($productQuantities, 0, 5);

        return view('welcome', ['topProducts' => $topProducts]);
    }

    public function rankBestSellingProducts()
    {
        // Fetch all transactions
        $transactions = Transaction::all();

        // Initialize an array to store the quantities of each product
        $productQuantities = [];

        // Loop through each transaction and aggregate product quantities
        foreach ($transactions as $transaction) {
            foreach (json_decode($transaction->products) as $item) {
                $productId = $item->id;
                $quantity = $item->quantity;

                // Retrieve product details, including type info
                $product = Product::with('type')->find($productId);

                // Accumulate quantities for each product
                if (isset($productQuantities[$productId])) {
                    $productQuantities[$productId]['quantity'] += $quantity;
                } else {
                    // Initialize the product details with type information
                    $productQuantities[$productId] = [
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'type_id' => $product->type->id ?? null,
                        'name' => $product->type->name ?? null,
                    ];
                }
            }
        }

        // Sort the products by total quantity in descending order
        usort($productQuantities, function ($a, $b) {
            return $b['quantity'] <=> $a['quantity'];
        });

        // Get only the top 10 products
        $top10Products = array_slice($productQuantities, 0, 10);

        // Return the ranked products to the view
        return view('product_ranking', ['rankedProducts' => $top10Products]);
    }

    public function rankBestSellingProductsByType()
    {
        // Fetch all transactions
        $transactions = Transaction::all();

        // Initialize an array to store quantities grouped by product type
        $productQuantitiesByType = [];

        // Loop through each transaction and aggregate product quantities
        foreach ($transactions as $transaction) {
            foreach (json_decode($transaction->products) as $item) {
                $productId = $item->id;
                $quantity = $item->quantity;

                // Retrieve product details, including type info
                $product = Product::with('type')->find($productId);

                // Skip if the product or its type is not found
                if (!$product || !$product->type) {
                    continue;
                }

                // Initialize the type group if it doesn't exist
                $typeId = $product->type->id;
                if (!isset($productQuantitiesByType[$typeId])) {
                    $productQuantitiesByType[$typeId] = [
                        'name' => $product->type->name,
                        'products' => []
                    ];
                }

                // Accumulate quantities for each product within the type
                if (isset($productQuantitiesByType[$typeId]['products'][$productId])) {
                    $productQuantitiesByType[$typeId]['products'][$productId]['quantity'] += $quantity;
                } else {
                    // Initialize the product details with type information
                    $productQuantitiesByType[$typeId]['products'][$productId] = [
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'product_name' => $product->name, // Assuming product has a name attribute
                    ];
                }
            }
        }

        // Sort each type's products by quantity in descending order and keep only the top 10
        foreach ($productQuantitiesByType as &$typeGroup) {
            usort($typeGroup['products'], function ($a, $b) {
                return $b['quantity'] <=> $a['quantity'];
            });
            $typeGroup['products'] = array_slice($typeGroup['products'], 0, 10);
        }

        // Return the ranked products to the new view
        return view('top_products_by_type', ['rankedProductsByType' => $productQuantitiesByType]);
    }
}
