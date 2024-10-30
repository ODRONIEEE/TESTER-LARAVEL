<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\CartService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // $this->app->singleton('cart_item_count', function ($app) {

        //     return $app->make(CartService::class)->getCartItemCount();
        // });

        // $this->callAfterResolving('view', function ($view, $app) {
        //     View::composer('*', function ($view) use ($app) {
        //         $view->with('cartItemCount', $app->make('cart_item_count'));
        //     });
        // });
    }
}
