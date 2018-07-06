<?php

declare(strict_types=1);
use Faker\Generator as Faker;

$factory->define(App\Models\Theme::class, function (Faker $faker) {
    return [
        'user_id' => 'members:8888888',
        'theme' => 'theme-bluesTheme',
    ];
});
