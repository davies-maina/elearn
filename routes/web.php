<?php

use App\Series;

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


Route::get('/register', function () {
    return view('register');
});

Route::get('/register/confirm', 'ConfirmEmailController@index')->name('confirm_email');

Route::get('/logout', function () {
    auth()->logout();
});

/* Route::get('{series_by_id}', function (Series $series) {

    dd($series);
}); */  //testing to see route model binding works

Route::middleware('admin')->prefix('admin')->group(function () {

    Route::resource('series', 'SeriesController');

    Route::resource('{series_by_id}/lessons', 'LessonsController'); //explicit  route binding
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
