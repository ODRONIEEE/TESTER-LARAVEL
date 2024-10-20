<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function drinkItems($category)
    {
        $items =[
        'coffee' => ['Americano', 'Cafe Latte', 'Mocha', 'White Chocolate', 'Salted Caramel', 'Caramel Macchiato', 'Butter Scotch', 'Cafe Con Leche', 'Dirty Green Matcha'],
        'non-coffee' => ['Strawberry Latte', 'Chocolate Latte', 'Matcha Latte', 'Chocolate Strawberry Latte', 'Matcha Chocolate', 'Sea Salt Matcha'],
        'refreshers' => ['Green Apple', 'Lychee', 'Kiwi', 'Passion Fruit', 'Pink Blossom'],
        'tea' => ['Blue Citron', 'Blue Honey', 'Black Tea']
        ];

        return response()->json($items[$category] ?? []);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
