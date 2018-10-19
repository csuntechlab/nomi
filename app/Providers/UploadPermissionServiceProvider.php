<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UploadPermissionServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\UploadPermissionContract',
            'App\Services\UploadPermissionService'
        );
    }
}
