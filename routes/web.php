<?php

declare(strict_types=1);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/guzz', function () {
    $client = new \GuzzleHttp\Client();

    return $client->get(
        'http://api.metalab.csun.edu/curriculum/api/terms/Spring-2015/classes/comp'
    )->getBody()->getContents();
});
