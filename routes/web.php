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

/**
 * Routes associated with login.
 */
Route::get('/', 'LoginController@index')->name('login');
Route::post('/', 'LoginController@validateUser');

/**
 * Route for home page. Takes us to the SPA.
 */
Route::get('/home', function () {
    echo 'You are logged IN.';
})->name('home')->middleware('auth');


/**
 * Route for logout.
 */
Route::get('/logout', function () {
    auth()->logout();
    echo 'You are logged OUT';
});

/**
 * Web Service Routes.
 */
Route::get('/courses', 'WebResourceController@courses');
Route::get('/roster', 'WebResourceController@roster');
Route::get('/media', 'WebResourceController@media');
