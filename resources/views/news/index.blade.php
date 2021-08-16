@extends('layouts.app')
@section('title', '仮想通貨ニュース')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')
<!-- list_gnをjsonでvueに渡す -->
<section class="p-container p-container__ornament" id="cnews">
  <h2 class="p-container__title"><i class="fas fa-newspaper"></i>仮想通貨ニュース</span></h2>
  <p class="p-cnews__text u-mb--xl">
    Googleニュースから仮想通貨関連のニュースを提供しています。
  </p>


<div id="newsapp">
  <news-component
    v-bind:list_gn="{{ json_encode($list_gn) }}"
  >
  </news-component>
</div>

</section>

@endsection
