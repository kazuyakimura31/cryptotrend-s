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

Auth::routes();

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('qa', function () {
    return view('qa');
})->name('qa');


// 仮想通貨ニュース（NewsController）
Route::get('news/index', 'NewsController@index')->name('news.index');

// 仮想通貨トレンド（CoinsController）
Route::get('coins/index', 'CoinsController@index')->name('coins.index');//コイン情報indexページ
Route::get('coins/hour','CoinsController@hour')->name('coins.hour');//[cron定期実行]:1時間のツイート数を検索
Route::get('coins/day','CoinsController@day')->name('coins.day');//[cron定期実行]:1日のツイート数を検索
Route::get('coins/week','CoinsController@week')->name('coins.week');//[cron定期実行]:1週間のツイート数を検索
Route::get('coins/highlow','CoinsController@highlow')->name('coins.highlow');//[cron定期実行]:最高取引価格と最安取引価格を検索

// Twittwerフォロー（FollowsController）
Route::get('follows/index','FollowsController@index')->name('follows.index');
Route::post('follows/index','FollowsController@follow')->name('follows.follow');//フォロー
Route::get('follows/addfollow','FollowsController@addfollow')->name('follows.addfollow');//[cron定期実行]:DBにツイッターアカウント追加
Route::get('follows/autofollow','FollowsController@autofollow')->name('follows.autofollow');//[cron定期実行]:自動フォロー。15分毎。
Route::post('follows/autoonfollow','FollowsController@autoonfollow')->name('follows.autoonfollow');//自動フォローをON

// twitter認証（Auth\TwitterController）
Route::get('auth/twitter', 'Auth\TwitterController@redirectToProvider')->name('auth.twitter');// ログインURL
Route::get('auth/twitter/callback', 'Auth\TwitterController@handleProviderCallback')->name('auth.twitter.callback');// コールバックURL
Route::get('auth/twitter/logout', 'Auth\TwitterController@logout')->name('auth.twitter.logout');// ログアウトURL

//ajaxデータの表示（AjaxController）
Route::get('ajax/coin', 'AjaxController@coin')->name('ajax.coin');
Route::get('ajax/users', 'AjaxController@users')->name('ajax.users');


//未ログインの時は、リダイレクト。
Route::group(['middleware' => 'check'],function(){
    Route::get('auth/twitter', 'Auth\TwitterController@redirectToProvider');
    Route::get('follows/index','FollowsController@index')->name('follows.index');
    Route::get('coins/index','CoinsController@index')->name('coins.index');
  });

//ログイン時は、トップページにリダイレクト。
Route::group(['middleware' => 'logout'],function(){
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('login','Auth\LoginController@showLoginForm')->name('login');
  });
