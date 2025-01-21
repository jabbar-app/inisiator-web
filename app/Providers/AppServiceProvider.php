<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
    public function boot()
    {
        // Redirect ke login jika session expired
        view()->composer('*', function ($view) {
            if (!Auth::check() && request()->route() && !request()->routeIs('login')) {
                redirect()->route('login')->send();
            }
        });
    }
}
