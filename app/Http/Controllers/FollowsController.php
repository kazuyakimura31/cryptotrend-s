<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Follow;
use App\User;
use App\Updatetime;
use Illuminate\Support\Facades\Session;
use Abraham\TwitterOAuth\TwitterOAuth;


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
            Session::put('follow', true);//セッションにオートフォロー実施中である旨を入れる。
        }else{
            Session::forget('follow');
        }


        // --------前回のフォロー日付（follow_day）をDBから取得し、本日と別日であればリセット--------
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

        //1日のフォロー数制限が1000超えていたらフォローできないようにするフラグをonにする
        $follow_count = Auth::user()->follow_count;
        if($follow_count > 1000){
            Session::put('today_follow_end', true);
        }else{
            Session::put('today_follow_end', false);
        }

        //--------アカウント一覧を表示：ツイッター認証していない場合--------
        //何も表示しない


        //--------アカウント一覧を表示：ツイッター認証している場合--------
        //
        $follow_users = array();
        for($i = 0; $i < 15; $i++){
          $random_user = Follow::inRandomOrder()->first();
          array_push($follow_users,$random_user->screen_name);
        }

        $follow_users = implode(",", $follow_users);//クォーテーション付与。
        $twitteroauth = $this->twitteroauth();
        
        $lookup_users = $twitteroauth->get("users/lookup", ["screen_name" => "$follow_users"]);
        $get_users = count($lookup_users);

        $temp_users = array();

        for($i=0; $i<$get_users; $i++){
            if(!$lookup_users[$i]->following){
              $temp_users[] = ($lookup_users[$i]);
            }
          }
        
          $users = json_encode($temp_users,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        
        return view('follows.index',compact('users','follow_users','follow_check'));
    }


    public function follow(Request $request){
        Log::debug("--------フォローアクションです--------");

        header("Access-Control-Allow-Origin: *"); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With");
        $twitteroauth = $this->twitteroauth();
        $user_id = $request->data{"user_id"};
        $username = $request->data{"user_name"};

        Log::debug("フォローする。".$username);
        $oAuth->post("friendships/create", ["screen_name" => $username]);

        $now_follow_num = Auth::user()->follow_count;
        $sum = $now_follow_num + 1;
        Auth::user()->follow_count = $sum;
        Auth::user()->update();
    
        return response()->json(['result' => true]);
        
    }

    public function autoonfollow(Request $request){
        Log::debug("--------自動フォローのON/OFFを切替えます。--------");

        $user = Auth::user();
        $user->autofollow = $request['request'];
        $user->update();
        return;
      }


    //--------ユーザーをDB追加するメソッド。cron実施/日。既存ユーザー情報がある時はツイート更新。
    public static function addfollow(){
        Log::debug("------twitterユーザー(users/search)をDB追加開始------");

        // twitter認証
        $config = config('services');
        $consumerKey = $config['twitter']['client_id'];
        $consumerSecret = $config['twitter']['client_secret'];
        $accessToken = $config['twitter']['access_token'];
        $accessTokenSecret = $config['twitter']['access_token_secret'];
        
        $twitteroauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

        $search_key ='仮想通貨';

        // countは1-20回指定
        $options = array(
            'q'=> $search_key,
            'count'=> 20,
            'lang'=>'ja',
            'entities' => false,
        );

        $results = $twitteroauth->get("users/search", $options);

        $users = array();
        
        for($i=0; $i<20; $i++){
            $users[$i]['screen_name'] = $results[$i]->screen_name;
            $users[$i]['twitter_id'] = $results[$i]->id;
            $users[$i]['name'] = $results[$i]->name;
            $users[$i]['text'] = $results[$i]->status->text;
            $users[$i]['registtime'] = $results[$i]->created_at;
        }

        // dd($users);

        for($i=0; $i<20; $i++){
            $autofollow = Follow::updateOrCreate(
              [ 'screen_name' => $users[$i]['screen_name']],
              [
                'screen_name' => $users[$i]['screen_name'],
                'twitter_id' => $users[$i]['twitter_id'],
                'name' => $users[$i]['name'],
                'text' => $users[$i]['text'],
                'registtime' => $users[$i]['registtime'],
              ]
            );
          }

        //DBのupdatetimesテーブルを更新
        $now_time = date("Y-m-d H:i:s");
        $adduser_time_update = Updatetime::where('id', 5)->first();
        $data = ['updated_at' => $now_time];
        $adduser_time_update->update($data);

        //jsonにする処理
        header( "Content-Type: application/json; charset=utf-8" );
        $users_results = json_encode($users,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        // print_r($users_results);
        return;
    }


    // 自動フォロー機能。cron定期実行（15分に１回）。上限：15/15min 1000/1day。
    // DBの「$user->autofollow:１」の場合に実施。
    public static function autofollow(){
        Log::debug("------オートフォロー開始------");

        $auto_follow = array();
        for($i = 0; $i < 20; $i++){
            $randomUser = Follow::inRandomOrder()->first();
            array_push($auto_follow,$randomUser->screen_name);
        }
        $auto_follow = implode(",", $auto_follow);
        Log::debug("フォロー対象：".$auto_follow);

        // DBの「$user->autofollow:１」を検索。
        $autofollow_acount = User::where('autofollow', 1)->get();
        $autofollow_acount_count = count($autofollow_acount);

        if($autofollow_acount_count == 0){
            Log::debug("自動フォロー実行中の人はいません。");
            return;
        }

        // 各ユーザーで自動フォロー実行。
        // DBの「オートフォロー：１」の場合に実施。
        for($i = 0; $i < $autofollow_acount_count; $i++){

            //1日のフォロー数制限1000超えていたらフォローできないようにする＝フラグをonにする。
            $follow_count = $autofollow_acount[$i]->follow_count;
            Log::debug("本日のフォロー数".$follow_count);

            if($follow_count > 1000){
                Log::debug("本日のフォロー数が1000を超えています。終了します。");
            }else{
                Log::debug("フォロー数が1000を超えていないので、フォロー開始します。");
                $config = config('services');
                $consumerKey = $config['twitter']['client_id'];	// APIキー
                $consumerSecret = $config['twitter']['client_secret'];	// APIシークレット
                $accessToken = ($autofollow_acount[$i]->token);	// ログインユーザーのアクセストークン
                $accessTokenSecret = ($autofollow_acount[$i]->tokensecret);	// ログインユーザーのアクセストークンシークレット

                $twitteroauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

                // 複数ユーザーを取得する
                $lookupuser = $twitteroauth->get("users/lookup", [ "screen_name" => $auto_follow ]);
                
                // dd($lookupuser);

                $c = count($lookupuser);
                
                $temp_user = array();

                // $temp_userが15未満の場合
                if($c < 15){

                    for($j = 0;  $j < $c; $j++){//15を超えないように。
                        if(is_null($lookupuser[$j]->following)){
                          array_push($temp_user,$lookupuser[$j]->screen_name);
                        }
                    }
                // $temp_userが15以上の場合
                }elseif(15 <= $c){

                    for($j = 0;  $j < 15; $j++){//15を超えないように。
                        if(is_null($lookupuser[$j]->following)){
                        array_push($temp_user,$lookupuser[$j]->screen_name);
                        }
                    }

                }


                Log::debug("temp_user一覧をフォローします");
                Log::debug($temp_user);

                foreach ($temp_user as $value)
                {
                  $twitteroauth->post("friendships/create", ["screen_name" => $value]);
                  Log::debug($value."をフォローしました");
                }

                $count = count($temp_user);
                $now_follow_num = $autofollow_acount[$i]->follow_count;
                $now_follow_num = $now_follow_num + $count;
                $now_usertwiiter_id = $autofollow_acount[$i]->twitter_id;

                $user = User::where('twitter_id', $now_usertwiiter_id)->first();
                $user->follow_count = $now_follow_num;
                $user->update();

                Log::debug("フォロー処理を終了します。");
            }
            Log::debug($autofollow_acount[$i]->name."さんの処理が終了しました。");
        }
        Log::debug("-------オートフォロー全処理を終了します-------");
    }

}
