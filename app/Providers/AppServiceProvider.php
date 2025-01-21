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
        // Redirect ke login jika session expired, kecuali untuk route tertentu
        // view()->composer('*', function ($view) {
        //     $excludedRoutes = ['login', 'register', 'password.request', 'password.reset'];

        //     if (!Auth::check() && request()->route() && !in_array(request()->route()->getName(), $excludedRoutes)) {
        //         redirect()->route('login')->send();
        //     }
        // });
    }
}
