<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\OrderController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // ส่งค่าจำนวนสินค้าในตะกร้าไปยัง view ที่มี app
        view()->composer('layouts.app', function ($view) {
            $cartItemCount = OrderController::getCartItemCount();
            $view->with('cartItemCount', $cartItemCount);
        });
        view()->composer('home', function ($view) {
            $cartItemCount = OrderController::getCartItemCount();
            $view->with('cartItemCount', $cartItemCount);
        });
    }

}
