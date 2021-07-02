<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoinsController extends Controller
{
    // ページ表示
    public function index()
    {
        return view('coins.index');
    }
}
