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

// ニュースコントローラー
Route::get('/news/index', 'NewsController@index')->name('news.index');

// コインコントローラー
Route::get('/coins/index', 'CoinsController@index')->name('coins.index');//コイン情報indexページ
Route::get('/coins/hour','CoinsController@hour')->name('coins.hour');//1時間のツイート数を検索。cron定期実行。
Route::get('/coins/day','CoinsController@day')->name('coins.day');//1日のツイート数を検索。cron定期実行。
Route::get('/coins/week','CoinsController@week')->name('coins.week');//1週間のツイート数を検索。cron定期実行。
Route::get('/coins/highlow','CoinsController@highlow')->name('coins.highlow');//最高取引価格と最安取引価格を検索。cron定期実行。

// フォローコントローラー
Route::get('/follows/index','FollowsController@index')->name('follows.index');
Route::post('/follows/index','FollowsController@follow')->name('follows.follow');//フォロー

// twitter認証
Route::get('auth/twitter', 'Auth\TwitterController@redirectToProvider');// ログインURL
Route::get('auth/twitter/callback', 'Auth\TwitterController@handleProviderCallback');// コールバックURL
Route::get('auth/twitter/logout', 'Auth\TwitterController@logout');// ログアウトURL

//ajaxデータの表示
Route::get('ajax/coin', 'AjaxController@coin')->name('ajax.coin');;
Route::get('ajax/users', 'AjaxController@users')->name('ajax.users');;





