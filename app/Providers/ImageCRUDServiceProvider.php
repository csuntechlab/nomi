<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImageCRUDServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Contracts\ImageCRUDContract',
            'App\Services\ImageCRUDService'
        );
    }
}
