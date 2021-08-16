<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coin;

class AjaxController extends Controller
{
    //ーーーーーーーーーーDBのcoinデータをajax出力
    public function coin(){
        return Coin::all();
    }
}
