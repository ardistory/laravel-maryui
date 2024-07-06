<?php

namespace App\Providers;

use App\Api\RouterosAPI;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RouterOsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RouterosAPI::class, function (Application $app) {
            return new RouterosAPI();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
