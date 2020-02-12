<?php

use App\Series;
use Illuminate\Support\Facades\Redis;

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

Route::get('/redis', function () {

    /* Redis::set('friend', 'momo'); */ //key:value -string
    /* dd(Redis::get('friend')); */


    /* Redis::lpush('frameworks', ['vue', 'laravel']); //key:value -list
    dd(Redis::lrange('frameworks', 0, -1)); */


    Redis::sadd('frontend-frameworks', ['angular', 'ember']); //key:value -set //similar to lists but doesn't repeat
    dd(Redis::smembers('frontend-frameworks'));
});

Route::get('/', 'FrontEndController@welcome');
Route::get('/watch-series/{series}', 'WatchSeriesController@index')->name('series.learning');
Route::get('/series/{series}/lesson/{lesson}', 'WatchSeriesController@showLesson')->name('series.watch');
Route::get('/series/{series}', 'FrontendController@showSeries')->name('series');
Route::post('/series/complete-lesson/{lesson}', 'WatchSeriesController@completeLesson');

Route::get('/profile', 'ProfileController@index');
Route::get('/register', function () {
    return view('register');
});

Route::get('/register/confirm', 'ConfirmEmailController@index')->name('confirm_email');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
});

/* Route::get('{series_by_id}', function (Series $series) {

    dd($series);
}); */  //testing to see route model binding works

/* Route::middleware('admin')->prefix('admin')->group(function () { */

/*  Route::resource('series', 'SeriesController');

    Route::resource('{series_by_id}/lessons', 'LessonsController'); */ //explicit  route binding
/* }); */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
