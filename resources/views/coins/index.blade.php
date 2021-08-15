@extends('layouts.app')
@section('title', '仮想通貨トレンド')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')
<section class="p-container p-container__ornament" id="coins">
  <h2 class="p-container__title"><span><i class="fab fa-bitcoin"></i>仮想通貨トレンド</span></h2>
  <p class="p-cnews__text u-mb--xl">
    Twitterでの各仮想通貨の「ツイート数」と「取引価格」を提供しています。
  </p>

<!--coinデータを取得するためのajaxのURL。-->
<!--それぞれ期間分（hour,day,week）のツイート数を取得。-->
<div id="coinsapp">
  <coins-component
  coin_ajax="{{ url('ajax/coin') }}"
  hour = "{{$hour}}"
  day = "{{$day}}"
  week = "{{$week}}"
  >
</coins-component>
</div>

</section>

@endsection
