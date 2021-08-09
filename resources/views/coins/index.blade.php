@extends('layouts.app')
@section('title', '仮想通貨トレンド')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')
  <h2 class="">
    通貨トレンド
  </h2>

<!--コントローラーから持ってきたデータ。-->
<!--coin_ajaxはcoinのデータを取得するためのajaxに使うURL。-->
<!--hour,day,weekはそれぞれ期間分のツイート数を取得したもの。-->

<div id="coinsapp">
  <coins-component
  coin_ajax="{{ url('ajax/coin') }}"
  hour = "{{$hour}}"
  day = "{{$day}}"
  week = "{{$week}}"
  >
</coins-component>
</div>

@endsection
