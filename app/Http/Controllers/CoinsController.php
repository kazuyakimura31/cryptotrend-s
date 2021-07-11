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
        // twitter認証
        $consumerKey       = "z0Sk38n1Y7uwvoTqUUBetJZHd";
        $consumerSecret    = "El5ccUzzyA0Eh8ZfDYfiVw73DGHtiM6W2fiayAIi395eTx9ILv";
        $accessToken       = "1138383264320634881-OPgvL32hxWoFBENb4FGaGSiwOudVyw";
        $accessTokenSecret = "XjvViQKQDPHqwtvFtuoMeolqmesGo9bRWlW3jWewIGJ46";
        $now_time = date("Y-m-d_H:i:s")."_JST";//現在日時
        $before_time = date('Y-m-d_H:i:s', strtotime('-1 hour', time()))."_JST";//１時間前
        
        $twitter = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

        $search_key ='"仮想通過" OR "BTC" OR "ビットコイン"';

        $options = array(
            'q'=> $search_key,
            'count'=>10,
            'lang'=>'ja',
            'result_type' => 'recent',
            'since' => $before_time,
            'until' => $now_time
        );

        $content = $twitter->get("search/tweets", $options);

        $request_page = 1;
        $tweet_results = array();

        // ツイートを配列に格納
        for($i=0; $i<$request_page; $i++){
            foreach($content->statuses as $val){
                $tweet_results[]['text'] = $val->text; //ツイートを配列へ挿入
            }
            // ページ分を取得
            if(isset($content->search_metadata->next_results)){
                $max_id = preg_replace('/.*?max_id=([0-9]+)&.*/', '$1', $content->search_metadata->next_results);
                $options['max_id'] = $max_id;
            }else{
                break; 
            }
        }
        
        $btc = $eth = $etc = $lsk = $fct = $xrp = $xem = $ltc = $bch = $mona = $xlm = $otum = $bat = $iost = $enj = $omg = 0;
        $tweet_count = count($tweet_results);//ツイート数

        for($i = 0; $i < $tweet_count; $i++){
            if(stristr($tweet_results[$i]['text'],"ビットコイン") !== false || stristr($tweet_results[$i]['text'],"btc") !== false){
                $btc++;
            }
        }

        // dd($btc);

        $coin_btc = Coin::where('id', 1)->first();

        $coin_btc->hour = $btc;
        $coin_btc->save();

        // dd($coin_btc);

        $now_time = date("Y-m-d H:i:s");
        $time_update = Updatetime::where('id', 1)->first();
        $data = ['updated_at' => $now_time];
        $time_update->update($data);

        // dd($time_update);

        return;

        // return view('coins.hour');
    }




    //------------DBにツイート数（１日）を追加する：定期バッジ------------
    public static function day()
    {

        // return view('coins.day');
    }




    //------------DBにツイート数（１週間）を追加する：定期バッジ------------
    public static function week()
    {

        // return view('coins.week');
    }





    //------------coincheck APIから取引価格（最高・最安）を取得し保存：定期バッジ------------
    public static function highlow()
    {

        // return view('coins.highlow');
    }



}
