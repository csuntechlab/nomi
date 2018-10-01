<?php

declare(strict_types=1);
use Faker\Generator as Faker;

$factory->define(App\Models\UploadPermission::class, function (Faker $faker) {
    return [
        'user_id' => 'members:9999999',
    ];
});
