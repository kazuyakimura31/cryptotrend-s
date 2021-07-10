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

// コインコントローラー
Route::get('/coins/index', 'CoinsController@index')->name('coins.index');//コイン情報indexページ
Route::get('/coin/hour','CoinsController@hour')->name('coins.hour');//1時間のツイート数を検索。cron実行。
Route::get('/coin/day','CoinsController@day')->name('coins.day');//1日のツイート数を検索。cron実行。
Route::get('/coin/week','CoinsController@week')->name('coins.week');//1週間のツイート数を検索。cron実行。
Route::get('/coin/highlow','CoinsController@highlow')->name('coins.highlow');//最高取引価格と最安取引価格を検索。cron実行。

// ニュースコントローラー
Route::get('/news/index', 'NewsController@index')->name('news.index');

