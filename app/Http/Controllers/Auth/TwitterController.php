<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;
use Socialite;
use Session;

class TwitterController extends Controller
{
    use AuthenticatesUsers;

    // ログイン
    public function redirectToProvider(){
        return Socialite::driver('twitter')->redirect();
    }

    // コールバック
    public function handleProviderCallback(){
        try {
            $twitterUser = Socialite::driver('twitter')->user();
            dd($twitterUser);
            // $user_token = $twitterUser->token;
            // $user_tokensecret = $twitterUser->tokenSecret;
            // //セッション情報としてツイッターユーザーの情報を保持。
            // Session::put('user_token', $user_token);
            // Session::put('user_tokensecret', $user_tokensecret);

        } catch (Exception $e) {
            return redirect('auth/twitter');
        }

        // 各自ログイン処理
        // 例
        // $user = User::where('auth_id', $twitterUser->id)->first();
        // if (!$user) {
        //     $user = User::create([
        //         'auth_id' => $twitterUser->id
        //   ]);
        // }
        // Auth::login($user);

    //ログインしているか確認
    if(Auth::check()){
        //ログインしている＝すでにユーザー登録済みなので、ユーザーIDを取得し
        //そのカラムにツイッター情報を追加する
  
        $user_id = Auth::id();
        $user_date = User::where('id',$user_id)->first();
  
        //Log::debug('最新のTwitter情報をdbに登録します。');
        //userカラムのtwiiter関連データにツイッター情報を挿入
        $user_date->fill([
          'twitter_id' => $twitterUser->id,
          'nickname' => $twitterUser->nickname,
          'avatar' => $twitterUser->avatar_original,
          'token' => $user_token,
          'tokensecret' => $user_tokensecret
          ])->save();
          Auth::login($user_date, true);
          return redirect()->route('follows');
  
          //ログインしてないなら、ツイッターアカウントのあるユーザーに登録しログインする
        }else{
          $user_date = $this->findOrCreateUser($twitterUser);
          Auth::login($user_date, true);
          return redirect()->route('index');
        }
      }
  
      //ログインしていない状態でツイッターデータのあるカラムを探し、なければ作る。
      private function findOrCreateUser($twitterUser){
        //Log::debug(print_r("findOrCreateUser実施", true));
        $user_date = User::where('twitter_id',$twitterUser->id)->first();
        //ツイッターのidがすでにテーブルにあれば同じツイッターidのユーザー情報を返す
        if($user_date){
          //Log::debug(print_r("twiiteridがDBにあり", true));
          return $user_date;
        }else{
          //なければそのまま作成。
          //Log::debug(print_r("twiiteridがDBになし", true));
          return User::create([
            'twitter_id' => $twitterUser->id,
            'nickname' => $twitterUser->nickname,
            'avatar' => $twitterUser->avatar_original
          ]);
        }
      }
  


    // ログアウト
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('index');
    }

}
