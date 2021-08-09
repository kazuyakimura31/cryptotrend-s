@extends('layouts.app')
@section('title', '仮想通貨ニュース')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')
<!--グーグルニュース/コントローラーからのlist_gnをjsonにしてvueに渡す-->
<div class="p-desc__container">

  <h2 class="p-desc__title c-text">
    <i class="far fa-newspaper"></i>仮想通貨ニュース一覧
  </h2>
  <p class="p-desc__text c-text">
    Googleニュースより仮想通貨関連のニュースを抜粋しました。
  </p>
</div>

<div id="newsapp">
  <news-component
    v-bind:list_gn="{{ json_encode($list_gn) }}"
  >
  </news-component>
</div>

@endsection
