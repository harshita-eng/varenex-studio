<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TableSchemaService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind the service class to the container
        $this->app->singleton(TableSchemaService::class, function ($app) {
            return new TableSchemaService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
