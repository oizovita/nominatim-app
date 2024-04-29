<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        RateLimiter::for('refresh', function (Request $request) {
            return Limit::perMinute(1)->response(function (Request $request, array $headers) {
                return response()->json([
                    'message' => 'Too many requests',
                ], 429, $headers);
            });
        });
    }
}
