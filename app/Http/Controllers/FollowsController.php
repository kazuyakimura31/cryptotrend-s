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
        $consumerKey       = "z0Sk38n1Y7uwvoTqUUBetJZHd";
        $consumerSecret    = "El5ccUzzyA0Eh8ZfDYfiVw73DGHtiM6W2fiayAIi395eTx9ILv";
        $accessToken       = (Session("1138383264320634881-OPgvL32hxWoFBENb4FGaGSiwOudVyw"));
        $accessTokenSecret = (Session("XjvViQKQDPHqwtvFtuoMeolqmesGo9bRWlW3jWewIGJ46"));

        $twitteroauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
        return $twitteroauth;
    }

    //Sessionに'today_follow_end';が入っているとフォロー不可にする。(395人以上/日で制限)
    public function index(){
        Log::debug("--------twitterフォローのindexページ--------");

        // $follow_check = Auth::user()->follow;
        // Log::debug("follow_check".$follow_check);

        $twitteroauth = $this->twitteroauth();//関数
        // dd($twitteroauth);

        

        return view('follows.index',compact('users_results','follow_users','autofollow_check'));
    }

    public function follow(Request $request){

        $twitteroauth = $this->twitteroauth();
       
    }

}
