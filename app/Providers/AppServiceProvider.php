<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        Schema::defaultStringLength(191);
		 View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->usertype == 'user') {
                $cartCount = 0;
                $view->with('cartCount', $cartCount);
            }
        });
    }
	
}
