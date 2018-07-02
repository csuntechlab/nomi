<?php

declare(strict_types=1);
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Models\Term::class, function (Faker $faker) {
    return [
        'term_id' => 2143,
        'begin_date' => Carbon::create(2014, 5, 10, 0, 0, 0),
        'end_date' => Carbon::create(2014, 5, 30, 0, 0, 0),
    ];
});
