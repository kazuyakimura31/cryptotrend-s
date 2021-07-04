<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        Log::debug("---------ニュースページです---------");

        set_time_limit(100);
        $max_num = 30;
        $keywords = "仮想通貨";
    
        //---- キーワード検索したいときのベースURL 
        $API_BASE_URL = "https://news.google.com/rss/search?ie=UTF-8&oe=UTF-8&hl=ja&gl=JP&ceid=JP:ja&q=";
    
        //----　キーワードの文字コード変更
        $query = urlencode(mb_convert_encoding($keywords,"UTF-8", "auto"));
    
        //---- APIへのリクエストURL生成
        $api_url = $API_BASE_URL.$query;
    
        //記事を取り出す
        $items = simplexml_load_file($api_url)->channel->item;
    
        //記事のタイトルとURLを取り出して配列に格納
        for ($i = 0; $i < count($items); $i++) {
    
            $list[$i]['title'] = mb_convert_encoding($items[$i]->title,"UTF-8", "auto");
            $list[$i]['url'] = mb_convert_encoding($items[$i]->link,"UTF-8", "auto");
            $list[$i]['pubDate'] = mb_convert_encoding($items[$i]->pubDate,"UTF-8", "auto");
            $list[$i]['description'] = mb_convert_encoding($items[$i]->description,"UTF-8", "auto");
    
        }
    
        //$max_num以上の記事数の場合は切り捨て
        if(count($list)>$max_num){
            for ($i = 0; $i < $max_num; $i++){
                $list_gn[$i] = $list{$i};
                $i++;
            }
        }else{
            $list_gn = $list;
        }

        return view('news.index', ['list_gn' => $list_gn]);
        
    }
}
