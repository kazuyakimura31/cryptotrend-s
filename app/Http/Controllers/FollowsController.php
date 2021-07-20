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
    public function twitter(){
        // twitter認証
        $consumerKey       = "z0Sk38n1Y7uwvoTqUUBetJZHd";
        $consumerSecret    = "El5ccUzzyA0Eh8ZfDYfiVw73DGHtiM6W2fiayAIi395eTx9ILv";
        $accessToken       = (Session("1138383264320634881-OPgvL32hxWoFBENb4FGaGSiwOudVyw"));
        $accessTokenSecret = (Session("XjvViQKQDPHqwtvFtuoMeolqmesGo9bRWlW3jWewIGJ46"));

        $twitter = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
        dd($twitter);
        return $twitter;
    }
}
