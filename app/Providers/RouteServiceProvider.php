<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\Ratelimiting\Limit;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function(Request $request){
            return Limit::perMinute(10)->by($request->ip());
        });

        RateLimiter::for('reaction', function(Request $request){
            return Limit::perMinute(10)->by($request->ip());
        });
    }
}
