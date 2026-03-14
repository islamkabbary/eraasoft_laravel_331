<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        Gate::define("create-product",function($user){
            return $user->user_type === "admin";
        });
        Gate::define("delete-product",function($user,$product){
            return $user->id === $product->created_by;
        });
    }
}
