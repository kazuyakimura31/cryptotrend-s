<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coin;

class AjaxController extends Controller
{
    public function coin(){
        return Coin::all();
    }
}
