<?php

declare(strict_types=1);
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Crypt;

$factory->define(App\Models\Note::class, function (Faker $faker) {
    return [
        'student_id' => 'members:9999999',
        'user_id' => 'members:8888888',
        'notepad' => Crypt::encrypt('This is a note'),
    ];
});
