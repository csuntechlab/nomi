<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WebResourceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Contracts\WebResourceRetrieverContract',
            'App\Services\WebResourceRetrieverService'
        );
    }
}
