<?php

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
    return view('index');
})->name('index');

Route::get('/qa', function () {
    return view('qa');
})->name('qa');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/coins/index', 'CoinsController@index')->name('coins.index');
Route::get('/news/index', 'NewsController@index')->name('news.index');

