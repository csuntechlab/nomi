<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UpdateRecognizedServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\UpdateRecognizedContract',
            'App\Services\UpdateRecognizedService'
        );
    }
}
