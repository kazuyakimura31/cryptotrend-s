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
        $config = config('services');
        $consumerKey = $config['twitter']['client_id'];
        $consumerSecret = $config['twitter']['client_secret'];
        $accessToken = $config['twitter']['access_token'];
        $accessTokenSecret = $config['twitter']['access_token_secret'];
        $now_time = date("Y-m-d_H:i:s")."_JST";//現在日時
        $before_time = date('Y-m-d_H:i:s', strtotime('-1 hour', time()))."_JST";//１時間前
        
        $twitter = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

        // dd($twitter);

        $search_key ='"仮想通貨" OR "BTC" OR "ビットコイン" OR "ETH" OR "イーサリアム" OR
            "ETC" OR "イーサリアムクラシック" OR "LSK" OR "リスク" OR "FCT" OR "ファクトム" OR "XRP" OR "リップル" OR
            "XEM" OR "ネム" OR "LTC" OR "ライトコイン" OR "BCH" OR "ビットコインキャッシュ" OR "MONA" OR "モナコイン" OR
            "XLM" OR "ステラルーメン" OR "QTUM" OR "クアンタム" OR "BAT" OR "ベーシックアテンショントークン" OR
            "IOST" OR "アイオーエスティー" OR "ENJ" OR "エンジンコイン" OR "OMG" OR "オーエムジー" OR "PLT" OR "パレットトークン"';

        $options = array(
            'q'=> $search_key,
            'count'=>100,
            'lang'=>'ja',
            'result_type' => 'recent',
            'since' => $before_time,
            'until' => $now_time
        );
        
        // ツイート取得
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
        
        $btc = $eth = $etc = $lsk = $fct = $xrp = $xem = $ltc = $bch = $mona = $xlm = $qtum = $bat = $iost = $enj = $omg = $plt = 0;
        $tweet_count = count($tweet_results);

        //一致するテキストがあればカウント
        for($i = 0; $i < $tweet_count; $i++){
            if(stristr($tweet_results[$i]['text'],"ビットコイン") !== false || stristr($tweet_results[$i]['text'],"btc") !== false){
                $btc++;
            }
            if(stristr($tweet_results[$i]['text'],"イーサリアム") !== false || stristr($tweet_results[$i]['text'],"eth") !== false){
                $eth++;
            }
            if(stristr($tweet_results[$i]['text'],"イーサリアムクラシック") !== false || stristr($tweet_results[$i]['text'],"etc") !== false){
                $etc++;
            }
            if(stristr($tweet_results[$i]['text'],"リスク") !== false || stristr($tweet_results[$i]['text'],"lsk") !== false){
                $lsk++;
            }
            if(stristr($tweet_results[$i]['text'],"ファクトム") !== false || stristr($tweet_results[$i]['text'],"fct") !== false){
                $fct++;
            }
            if(stristr($tweet_results[$i]['text'],"リップル") !== false || stristr($tweet_results[$i]['text'],"xrp") !== false){
                $xrp++;
            }
            if(stristr($tweet_results[$i]['text'],"ネム") !== false || stristr($tweet_results[$i]['text'],"xem") !== false){
                $xem++;
            }
            if(stristr($tweet_results[$i]['text'],"ライトコイン") !== false || stristr($tweet_results[$i]['text'],"ltc") !== false){
                $ltc++;
            }
            if(stristr($tweet_results[$i]['text'],"ビットコインキャッシュ") !== false || stristr($tweet_results[$i]['text'],"bch") !== false){
                $bch++;
            }
            if(stristr($tweet_results[$i]['text'],"モナコイン") !== false || stristr($tweet_results[$i]['text'],"mona") !== false){
                $mona++;
            }
            if(stristr($tweet_results[$i]['text'],"ステラルーメン") !== false || stristr($tweet_results[$i]['text'],"xlm") !== false){
                $xlm++;
            }
            if(stristr($tweet_results[$i]['text'],"クアンタム") !== false || stristr($tweet_results[$i]['text'],"qtum") !== false){
                $qtum++;
            }
            if(stristr($tweet_results[$i]['text'],"ベーシックアテンショントークン") !== false || stristr($tweet_results[$i]['text'],"bat") !== false){
                $bat++;
            }
            if(stristr($tweet_results[$i]['text'],"アイオーエスティー") !== false || stristr($tweet_results[$i]['text'],"iost") !== false){
                $iost++;
            }
            if(stristr($tweet_results[$i]['text'],"エンジンコイン") !== false || stristr($tweet_results[$i]['text'],"enj") !== false){
                $enj++;
            }
            if(stristr($tweet_results[$i]['text'],"オーエムジー") !== false || stristr($tweet_results[$i]['text'],"omg") !== false){
                $omg++;
            }
            if(stristr($tweet_results[$i]['text'],"パレットトークン") !== false || stristr($tweet_results[$i]['text'],"plt") !== false){
                $plt++;
            }
        }

        $coin_btc = Coin::where('id', 1)->first();
        $coin_btc->hour = $btc;
        $coin_btc->save();

        $coin_eth = Coin::where('id', 2)->first();
        $coin_eth->hour = $eth;
        $coin_eth->save();

        $coin_etc = Coin::where('id', 3)->first();
        $coin_etc->hour = $etc;
        $coin_etc->save();

        $coin_lsk = Coin::where('id', 4)->first();
        $coin_lsk->hour = $lsk;
        $coin_lsk->save();

        $coin_fct = Coin::where('id', 5)->first();
        $coin_fct->hour = $fct;
        $coin_fct->save();

        $coin_xrp = Coin::where('id', 6)->first();
        $coin_xrp->hour = $xrp;
        $coin_xrp->save();

        $coin_xem = Coin::where('id', 7)->first();
        $coin_xem->hour = $xem;
        $coin_xem->save();

        $coin_ltc = Coin::where('id', 8)->first();
        $coin_ltc->hour = $ltc;
        $coin_ltc->save();

        $coin_bch = Coin::where('id', 9)->first();
        $coin_bch->hour = $bch;
        $coin_bch->save();

        $coin_mona = Coin::where('id', 10)->first();
        $coin_mona->hour = $mona;
        $coin_mona->save();

        $coin_xlm = Coin::where('id', 11)->first();
        $coin_xlm->hour = $xlm;
        $coin_xlm->save();

        $coin_qtum = Coin::where('id', 12)->first();
        $coin_qtum->hour = $qtum;
        $coin_qtum->save();

        $coin_bat = Coin::where('id', 13)->first();
        $coin_bat->hour = $bat;
        $coin_bat->save();

        $coin_iost = Coin::where('id', 14)->first();
        $coin_iost->hour = $iost;
        $coin_iost->save();

        $coin_enj = Coin::where('id', 15)->first();
        $coin_enj->hour = $enj;
        $coin_enj->save();

        $coin_omg = Coin::where('id', 16)->first();
        $coin_omg->hour = $omg;
        $coin_omg->save();

        $coin_plt = Coin::where('id', 17)->first();
        $coin_plt->hour = $plt;
        $coin_plt->save();

        // dd($coin_btc);

        $now_time = date("Y-m-d H:i:s");
        $time_update = Updatetime::where('id', 1)->first();
        $data = ['updated_at' => $now_time];
        $time_update->update($data);

        return;

        // return view('coins.hour');
    }




    //------------DBにツイート数（１日）を追加する：定期バッジ------------
    public static function day()
    {
        // twitter認証
        $config = config('services');
        $consumerKey = $config['twitter']['client_id'];
        $consumerSecret = $config['twitter']['client_secret'];
        $accessToken = $config['twitter']['access_token'];
        $accessTokenSecret = $config['twitter']['access_token_secret'];
        $now_time = date("Y-m-d_H:i:s")."_JST";//現在日時
        $before_time = date('Y-m-d_H:i:s', strtotime('-1 day', time()))."_JST";//１日前
        
        $twitter = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

        $search_key ='"仮想通貨" OR "BTC" OR "ビットコイン" OR "ETH" OR "イーサリアム" OR
            "ETC" OR "イーサリアムクラシック" OR "LSK" OR "リスク" OR "FCT" OR "ファクトム" OR "XRP" OR "リップル" OR
            "XEM" OR "ネム" OR "LTC" OR "ライトコイン" OR "BCH" OR "ビットコインキャッシュ" OR "MONA" OR "モナコイン" OR
            "XLM" OR "ステラルーメン" OR "QTUM" OR "クアンタム" OR "BAT" OR "ベーシックアテンショントークン" OR
            "IOST" OR "アイオーエスティー" OR "ENJ" OR "エンジンコイン" OR "OMG" OR "オーエムジー" OR "PLT" OR "パレットトークン"';

        $options = array(
            'q'=> $search_key,
            'count'=>100,
            'lang'=>'ja',
            'result_type' => 'recent',
            'since' => $before_time,
            'until' => $now_time
        );
        
        // ツイート取得
        $content = $twitter->get("search/tweets", $options);

        $request_page = 24;
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
        
        $btc = $eth = $etc = $lsk = $fct = $xrp = $xem = $ltc = $bch = $mona = $xlm = $qtum = $bat = $iost = $enj = $omg = $plt = 0;
        $tweet_count = count($tweet_results);

        //一致するテキストがあればカウント
        for($i = 0; $i < $tweet_count; $i++){
            if(stristr($tweet_results[$i]['text'],"ビットコイン") !== false || stristr($tweet_results[$i]['text'],"btc") !== false){
                $btc++;
            }
            if(stristr($tweet_results[$i]['text'],"イーサリアム") !== false || stristr($tweet_results[$i]['text'],"eth") !== false){
                $eth++;
            }
            if(stristr($tweet_results[$i]['text'],"イーサリアムクラシック") !== false || stristr($tweet_results[$i]['text'],"etc") !== false){
                $etc++;
            }
            if(stristr($tweet_results[$i]['text'],"リスク") !== false || stristr($tweet_results[$i]['text'],"lsk") !== false){
                $lsk++;
            }
            if(stristr($tweet_results[$i]['text'],"ファクトム") !== false || stristr($tweet_results[$i]['text'],"fct") !== false){
                $fct++;
            }
            if(stristr($tweet_results[$i]['text'],"リップル") !== false || stristr($tweet_results[$i]['text'],"xrp") !== false){
                $xrp++;
            }
            if(stristr($tweet_results[$i]['text'],"ネム") !== false || stristr($tweet_results[$i]['text'],"xem") !== false){
                $xem++;
            }
            if(stristr($tweet_results[$i]['text'],"ライトコイン") !== false || stristr($tweet_results[$i]['text'],"ltc") !== false){
                $ltc++;
            }
            if(stristr($tweet_results[$i]['text'],"ビットコインキャッシュ") !== false || stristr($tweet_results[$i]['text'],"bch") !== false){
                $bch++;
            }
            if(stristr($tweet_results[$i]['text'],"モナコイン") !== false || stristr($tweet_results[$i]['text'],"mona") !== false){
                $mona++;
            }
            if(stristr($tweet_results[$i]['text'],"ステラルーメン") !== false || stristr($tweet_results[$i]['text'],"xlm") !== false){
                $xlm++;
            }
            if(stristr($tweet_results[$i]['text'],"クアンタム") !== false || stristr($tweet_results[$i]['text'],"qtum") !== false){
                $qtum++;
            }
            if(stristr($tweet_results[$i]['text'],"ベーシックアテンショントークン") !== false || stristr($tweet_results[$i]['text'],"bat") !== false){
                $bat++;
            }
            if(stristr($tweet_results[$i]['text'],"アイオーエスティー") !== false || stristr($tweet_results[$i]['text'],"iost") !== false){
                $iost++;
            }
            if(stristr($tweet_results[$i]['text'],"エンジンコイン") !== false || stristr($tweet_results[$i]['text'],"enj") !== false){
                $enj++;
            }
            if(stristr($tweet_results[$i]['text'],"オーエムジー") !== false || stristr($tweet_results[$i]['text'],"omg") !== false){
                $omg++;
            }
            if(stristr($tweet_results[$i]['text'],"パレットトークン") !== false || stristr($tweet_results[$i]['text'],"plt") !== false){
                $plt++;
            }
        }

        $coin_btc = Coin::where('id', 1)->first();
        $coin_btc->day = $btc;
        $coin_btc->save();

        $coin_eth = Coin::where('id', 2)->first();
        $coin_eth->day = $eth;
        $coin_eth->save();

        $coin_etc = Coin::where('id', 3)->first();
        $coin_etc->day = $etc;
        $coin_etc->save();

        $coin_lsk = Coin::where('id', 4)->first();
        $coin_lsk->day = $lsk;
        $coin_lsk->save();

        $coin_fct = Coin::where('id', 5)->first();
        $coin_fct->day = $fct;
        $coin_fct->save();

        $coin_xrp = Coin::where('id', 6)->first();
        $coin_xrp->day = $xrp;
        $coin_xrp->save();

        $coin_xem = Coin::where('id', 7)->first();
        $coin_xem->day = $xem;
        $coin_xem->save();

        $coin_ltc = Coin::where('id', 8)->first();
        $coin_ltc->day = $ltc;
        $coin_ltc->save();

        $coin_bch = Coin::where('id', 9)->first();
        $coin_bch->day = $bch;
        $coin_bch->save();

        $coin_mona = Coin::where('id', 10)->first();
        $coin_mona->day = $mona;
        $coin_mona->save();

        $coin_xlm = Coin::where('id', 11)->first();
        $coin_xlm->day = $xlm;
        $coin_xlm->save();

        $coin_qtum = Coin::where('id', 12)->first();
        $coin_qtum->day = $qtum;
        $coin_qtum->save();

        $coin_bat = Coin::where('id', 13)->first();
        $coin_bat->day = $bat;
        $coin_bat->save();

        $coin_iost = Coin::where('id', 14)->first();
        $coin_iost->day = $iost;
        $coin_iost->save();

        $coin_enj = Coin::where('id', 15)->first();
        $coin_enj->day = $enj;
        $coin_enj->save();

        $coin_omg = Coin::where('id', 16)->first();
        $coin_omg->day = $omg;
        $coin_omg->save();

        $coin_plt = Coin::where('id', 17)->first();
        $coin_plt->day = $plt;
        $coin_plt->save();

        // dd($coin_btc);

        $now_time = date("Y-m-d H:i:s");
        $time_update = Updatetime::where('id', 2)->first();
        $data = ['updated_at' => $now_time];
        $time_update->update($data);

        return;

        // return view('coins.day');
    }




    //------------DBにツイート数（１週間）を追加する：定期バッジ------------
    public static function week()
    {
        // twitter認証
        $config = config('services');
        $consumerKey = $config['twitter']['client_id'];
        $consumerSecret = $config['twitter']['client_secret'];
        $accessToken = $config['twitter']['access_token'];
        $accessTokenSecret = $config['twitter']['access_token_secret'];
        $now_time = date("Y-m-d_H:i:s")."_JST";//現在日時
        $before_time = date('Y-m-d_H:i:s', strtotime('-7 day', time()))."_JST";//１週間前
        
        $twitter = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

        $search_key ='"仮想通貨" OR "BTC" OR "ビットコイン" OR "ETH" OR "イーサリアム" OR
            "ETC" OR "イーサリアムクラシック" OR "LSK" OR "リスク" OR "FCT" OR "ファクトム" OR "XRP" OR "リップル" OR
            "XEM" OR "ネム" OR "LTC" OR "ライトコイン" OR "BCH" OR "ビットコインキャッシュ" OR "MONA" OR "モナコイン" OR
            "XLM" OR "ステラルーメン" OR "QTUM" OR "クアンタム" OR "BAT" OR "ベーシックアテンショントークン" OR
            "IOST" OR "アイオーエスティー" OR "ENJ" OR "エンジンコイン" OR "OMG" OR "オーエムジー" OR "PLT" OR "パレットトークン"';

        $options = array(
            'q'=> $search_key,
            'count'=>100,
            'lang'=>'ja',
            'result_type' => 'recent',
            'since' => $before_time,
            'until' => $now_time
        );
        
        // ツイート取得
        $content = $twitter->get("search/tweets", $options);

        $request_page = 100;
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
        
        $btc = $eth = $etc = $lsk = $fct = $xrp = $xem = $ltc = $bch = $mona = $xlm = $qtum = $bat = $iost = $enj = $omg = $plt = 0;
        $tweet_count = count($tweet_results);

        //一致するテキストがあればカウント
        for($i = 0; $i < $tweet_count; $i++){
            if(stristr($tweet_results[$i]['text'],"ビットコイン") !== false || stristr($tweet_results[$i]['text'],"btc") !== false){
                $btc++;
            }
            if(stristr($tweet_results[$i]['text'],"イーサリアム") !== false || stristr($tweet_results[$i]['text'],"eth") !== false){
                $eth++;
            }
            if(stristr($tweet_results[$i]['text'],"イーサリアムクラシック") !== false || stristr($tweet_results[$i]['text'],"etc") !== false){
                $etc++;
            }
            if(stristr($tweet_results[$i]['text'],"リスク") !== false || stristr($tweet_results[$i]['text'],"lsk") !== false){
                $lsk++;
            }
            if(stristr($tweet_results[$i]['text'],"ファクトム") !== false || stristr($tweet_results[$i]['text'],"fct") !== false){
                $fct++;
            }
            if(stristr($tweet_results[$i]['text'],"リップル") !== false || stristr($tweet_results[$i]['text'],"xrp") !== false){
                $xrp++;
            }
            if(stristr($tweet_results[$i]['text'],"ネム") !== false || stristr($tweet_results[$i]['text'],"xem") !== false){
                $xem++;
            }
            if(stristr($tweet_results[$i]['text'],"ライトコイン") !== false || stristr($tweet_results[$i]['text'],"ltc") !== false){
                $ltc++;
            }
            if(stristr($tweet_results[$i]['text'],"ビットコインキャッシュ") !== false || stristr($tweet_results[$i]['text'],"bch") !== false){
                $bch++;
            }
            if(stristr($tweet_results[$i]['text'],"モナコイン") !== false || stristr($tweet_results[$i]['text'],"mona") !== false){
                $mona++;
            }
            if(stristr($tweet_results[$i]['text'],"ステラルーメン") !== false || stristr($tweet_results[$i]['text'],"xlm") !== false){
                $xlm++;
            }
            if(stristr($tweet_results[$i]['text'],"クアンタム") !== false || stristr($tweet_results[$i]['text'],"qtum") !== false){
                $qtum++;
            }
            if(stristr($tweet_results[$i]['text'],"ベーシックアテンショントークン") !== false || stristr($tweet_results[$i]['text'],"bat") !== false){
                $bat++;
            }
            if(stristr($tweet_results[$i]['text'],"アイオーエスティー") !== false || stristr($tweet_results[$i]['text'],"iost") !== false){
                $iost++;
            }
            if(stristr($tweet_results[$i]['text'],"エンジンコイン") !== false || stristr($tweet_results[$i]['text'],"enj") !== false){
                $enj++;
            }
            if(stristr($tweet_results[$i]['text'],"オーエムジー") !== false || stristr($tweet_results[$i]['text'],"omg") !== false){
                $omg++;
            }
            if(stristr($tweet_results[$i]['text'],"パレットトークン") !== false || stristr($tweet_results[$i]['text'],"plt") !== false){
                $plt++;
            }
        }

        $coin_btc = Coin::where('id', 1)->first();
        $coin_btc->week = $btc;
        $coin_btc->save();

        $coin_eth = Coin::where('id', 2)->first();
        $coin_eth->week = $eth;
        $coin_eth->save();

        $coin_etc = Coin::where('id', 3)->first();
        $coin_etc->week = $etc;
        $coin_etc->save();

        $coin_lsk = Coin::where('id', 4)->first();
        $coin_lsk->week = $lsk;
        $coin_lsk->save();

        $coin_fct = Coin::where('id', 5)->first();
        $coin_fct->week = $fct;
        $coin_fct->save();

        $coin_xrp = Coin::where('id', 6)->first();
        $coin_xrp->week = $xrp;
        $coin_xrp->save();

        $coin_xem = Coin::where('id', 7)->first();
        $coin_xem->week = $xem;
        $coin_xem->save();

        $coin_ltc = Coin::where('id', 8)->first();
        $coin_ltc->week = $ltc;
        $coin_ltc->save();

        $coin_bch = Coin::where('id', 9)->first();
        $coin_bch->week = $bch;
        $coin_bch->save();

        $coin_mona = Coin::where('id', 10)->first();
        $coin_mona->week = $mona;
        $coin_mona->save();

        $coin_xlm = Coin::where('id', 11)->first();
        $coin_xlm->week = $xlm;
        $coin_xlm->save();

        $coin_qtum = Coin::where('id', 12)->first();
        $coin_qtum->week = $qtum;
        $coin_qtum->save();

        $coin_bat = Coin::where('id', 13)->first();
        $coin_bat->week = $bat;
        $coin_bat->save();

        $coin_iost = Coin::where('id', 14)->first();
        $coin_iost->week = $iost;
        $coin_iost->save();

        $coin_enj = Coin::where('id', 15)->first();
        $coin_enj->week = $enj;
        $coin_enj->save();

        $coin_omg = Coin::where('id', 16)->first();
        $coin_omg->week = $omg;
        $coin_omg->save();

        $coin_plt = Coin::where('id', 17)->first();
        $coin_plt->week = $plt;
        $coin_plt->save();

        // dd($coin_btc);

        $now_time = date("Y-m-d H:i:s");
        $time_update = Updatetime::where('id', 3)->first();
        $data = ['updated_at' => $now_time];
        $time_update->update($data);

        return;

        // return view('coins.week');
    }





    //------------coincheck APIから取引価格（最高・最安）を取得し保存：定期バッジ------------
    public static function highlow()
    {
        $btc_url ="https://coincheck.com/api/ticker";
        $file= file_get_contents($btc_url);
        $file = mb_convert_encoding($file, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $btc = json_decode($file, true);


        $coin_btc = Coin::where('id', 1)->first();
        $coin_btc->high = $btc['high'];
        $coin_btc->low = $btc['low'];
        $coin_btc->save();


        $now_time = date("Y-m-d H:i:s");
        $time_update = Updatetime::where('id', 4)->first();
        $data = ['updated_at' => $now_time];
        $time_update->update($data);

        return;


        // return view('coins.highlow');
    }



}
