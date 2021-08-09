@extends('layouts.app')
@section('title', 'twitterフォロー')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')

<div class="p-desc__container">
  <h2 class="p-desc__title c-text">
    <i class="fab fa-twitter"></i>twitterフォロー
  </h2>
  <p class="p-desc__text c-text">
    Twitter上の『仮想通貨』関連ユーザーをフォローして、情報を効率的に取得しましょう。
  </p>
</div>
<div class="u-mark__small">本機能の仕組みについては<a href="{{ url('qa') }}/#about_twitter" target="_blank">[こちら]</a>を参照してください。</div>



@if (session('today_follow_end'))
<!--セッション情報にtoday_follow_endが入っている場合、本日のフォローができない。-->>

<div class="p-desc__container">
  <p class="p-desc__text c-text">
    本日はすでに多くのフォローを実施しているため、フォローは実施できません。<br>
    明日以降アクセスしてください。<br>
    <a href="{{ url('about') }}/#about_limit">※フォロー制限について</a>
  </p>
  <div class="u-short"></div>


@else

    <section class="l-main__twitter">
    @if (session('user_token'))
    <!--ツイッター認証をしている場合は下記コンポーネントを表示。受け渡す変数の内容は以下の通りです。-->
    <!--follow_checkはセッションの状態。1ならば自動フォロー実施中。-->
    <!--users_resultsはログインユーザーがフォローしてないユーザー一覧のスクリーンネーム。-->
    <!--follow_ajaxは個別フォローするurlへのポストの時のurl-->
    <!--follow_all_ajaxは自動フォローをonにするポストのurl-->

    <!--$follow_checkこの値で現在オートフォロー中か判断-->
    <div id="followsapp">
    <follows-component
        :users="{{ $users }}"
        follow_users="{{$follow_users}}"
        follow_check = "{{ $follow_check }}"
        follow_ajax = "{{ url('follows') }}"
        follow_all_ajax = "{{ url('follows/autoonfollow') }}"
    >
    </follows-component>
    </div>

    @else

    <!--ツイッター認証をしていない場合は下記を表示-->
    <div class="c-text p-twiiter__top">
    <p>各アカウントのフォローをするには<br>「Twitter認証」をしてください。</p>
    <a href="/auth/twitter" class=""><i class="fab fa-twitter"></i>Twitter認証を行う。</a>
    </div>

    @endif
    </section>

@endif



@endsection
