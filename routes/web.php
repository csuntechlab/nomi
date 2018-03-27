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
Route::get('/data', 'SPAController@getData')->middleware('auth');

/** Route for logout. */
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
});

/** Web Service API Routes. */
Route::get('/courses/{term}', 'WebResourceController@courses');
Route::get('/roster/{term}/{course}', 'WebResourceController@roster');
Route::get('/media', 'WebResourceController@media');
Route::get('/student/{email}', 'WebResourceController@student');

/** Roster API Routes. */
Route::get('/students/{term}/{course}', 'RosterController@getStudents');
Route::get('/students/shuffle/{term}/{course}', 'RosterController@shuffleStudents');

/** Student API Routes */
Route::get('/student_profile/{email}', 'StudentProfileController@getProfile');
Route::get('/faculty_profile/{email}', 'FacultyProfileController@getProfile');

/** META+LAB Feedback Routes */
// Route::group(['middleware' => ['auth']], function () {
//     Route::get('support', '\CSUNMetaLab\Support\Http\Controllers\SupportController@create')->name('support.create');
//     Route::post('support', '\CSUNMetaLab\Support\Http\Controllers\SupportController@store')->name('support.store');
  
//     Route::get('feedback', '\CSUNMetaLab\Support\Http\Controllers\FeedbackController@create')->name('feedback.create');
//     Route::post('feedback', '\CSUNMetaLab\Support\Http\Controllers\FeedbackController@store')->name('feedback.store');
//   });
