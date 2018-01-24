<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CurriculumServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Contracts\CurriculumRetrieverContract',
            'App\Services\CurriculumRetrieverService'
        );
    }
}
