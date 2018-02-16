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

/** Routes associated with login. */
Route::get('/', 'LoginController@index')->name('login');
Route::post('/', 'LoginController@validateUser');

/** Route for home page. Takes us to the SPA. */
Route::get('/home', 'SPAController@index')->name('home')->middleware('auth');

/** Test route for course view */
Route::get('/classes', 'SPAController@courses')->name('classes')->middleware('auth');

/** Route for logout. */
Route::get('/logout', function () {
    auth()->logout();

    return redirect('/');
});

/** Web Service API Routes. */
Route::get('/courses/{term}', 'WebResourceController@courses');
Route::get('/roster/{term}/{course}', 'WebResourceController@roster');
Route::get('/media', 'WebResourceController@media');

/** Roster API Routes. */
Route::get('/students/{term}/{course}', 'RosterController@getStudents');
Route::get('/students/shuffle/{term}/{course}', 'RosterController@shuffleStudents');

/** Update recognized routes */
Route::post('/markAsRecognized', 'RecognizedController@markAsRecognized')->middleware('auth');
Route::post('/markAsUnrecognized', 'RecognizedController@markAsUnrecognized')->middleware('auth');

/** META+LAB Feedback Routes */
// Route::group(['middleware' => ['auth']], function () {
//     Route::get('support', '\CSUNMetaLab\Support\Http\Controllers\SupportController@create')->name('support.create');
//     Route::post('support', '\CSUNMetaLab\Support\Http\Controllers\SupportController@store')->name('support.store');
  
//     Route::get('feedback', '\CSUNMetaLab\Support\Http\Controllers\FeedbackController@create')->name('feedback.create');
//     Route::post('feedback', '\CSUNMetaLab\Support\Http\Controllers\FeedbackController@store')->name('feedback.store');
//   });
