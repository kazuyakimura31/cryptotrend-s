<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Updatetime;
use App\Coin;

class CoinsController extends Controller
{
    //------------コイン情報indexページ------------
    public function index()
    {
        Log::debug("--------仮想通過トレンドindexページ--------");

        $coinsupdate = Updatetime::all();
        $hour = $coinsupdate[0]["updated_at"];
        $day = $coinsupdate[1]["updated_at"];
        $week = $coinsupdate[2]["updated_at"];
        $highlow = $coinsupdate[3]["updated_at"];

        return view('coins.index',
            [
                'hour' => $hour, 
                'day' => $day,
                'week' => $week,
                'highlow' => $highlow
            ]);
    }




    //------------DBにツイート数（１時間）を追加する：定期バッジ------------
    public static function hour()
    {

        return view('coins.hour');
    }




    //------------DBにツイート数（１日）を追加する：定期バッジ------------
    public static function day()
    {

        return view('coins.day');
    }




    //------------DBにツイート数（１週間）を追加する：定期バッジ------------
    public static function week()
    {

        return view('coins.week');
    }





    //------------coincheck APIから取引価格（最高・最安）を取得し保存：定期バッジ------------
    public static function highlow()
    {

        return view('coins.highlow');
    }



}
