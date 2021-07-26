<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Follow;
use App\User;
use App\Updatetime;
use Abraham\TwitterOAuth\TwitterOAuth;
use Session;

class FollowsController extends Controller
{
    // twitter認証
    public function twitteroauth(){
        $config = config('services');
        $consumerKey = $config['twitter']['client_id'];	
        $consumerSecret = $config['twitter']['client_secret'];
        $accessToken = (Session('user_token'));	// ログインユーザーのアクセストークン
        $accessTokenSecret = (Session('user_tokensecret'));	// ログインユーザーのアクセストークンシークレット

        $twitteroauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
        return $twitteroauth;
    }

    //Sessionに'today_follow_end';が入っているとフォロー不可にする。(395人以上/日で制限)
    public function index(){
        Log::debug("--------twitterフォローのindexページ--------");

        $follow_check = Auth::user()->follow;
        Log::debug("follow_check：".$follow_check);

        if($follow_check == 1){
            Session::put('autofollow', true);//セッションにオートフォロー実施中である旨を入れる。
        }else{
            Session::forget('autofollow');
        }

        // 前回のフォロー日付（follow_day）をDBから取得し、本日と別日であればリセット
        $today = date("Y-m-d");
        $follow_day =Auth::user()->follow_day;

        if($today !== $follow_day){
            Log::debug("日付が異なる。DB上のフォロー数は０、日付も本日にする。");
            Auth::user()->follow_count = 0;
            Auth::user()->follow_day = $today;
            Auth::user()->save();
            Session::forget('today_follow_end');
        }else{
            Log::debug("日付が同じ。DB上のフォロー数はそのまま。");
        }


        $twitteroauth = $this->twitteroauth();//関数

        
        return view('follows.index',compact('users_results','follow_users','autofollow_check'));
    }

    public function follow(Request $request){

        $twitteroauth = $this->twitteroauth();
       
    }

}
