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
 * Routes for home page.
 */
Route::get('/home', function () {
    echo 'You Are Logged In!';
})->name('home')->middleware('auth');

/**
 * Route for logout. Not Yet Implemented.
 */
Route::get('/logout', function () {
});

Route::get('/courses', 'WebResourceController@courses');
Route::get('/roster', 'WebResourceController@roster');
