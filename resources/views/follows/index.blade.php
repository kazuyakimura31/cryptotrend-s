@extends('layouts.app')
@section('title', 'twitterフォロー')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')
<section class="p-container p-container__ornament" id="follows">
  <h2 class="p-container__title"><span><i class="fab fa-twitter"></i>twitterフォロー</span></h2>
    <p class="p-follows__title">
      Twitter上の『仮想通貨』関連ユーザーをフォローして、情報を効率的に取得しましょう。
    </p>

<section class="p-container__body">

<!--セッションにtoday_follow_endがある時、本日のフォローができない。-->
@if (session('today_follow_end'))

<div class="p-container">
  <p class="p-follows__text">
    本日分のフォロー数を超過しておりますので、これ以上のフォローはできません。<br>
    <a href="{{ url('qa') }}/#qa_limit">※フォロー制限について</a>
  </p>
</div>


@else

    <section id ="main">
    @if (session('user_token'))
    <!--ツイッター認証がある時は下記のコンポーネントを表示。-->
     <!--users：ログインユーザーがフォローしてないユーザー一覧-->
    <!--follow_check：セッションの状態。1の時は自動フォロー実施中。-->
    <!--follow_ajax：個別でフォローするポストのurl-->
    <!--follow_all_ajax：自動フォローをonにするポストのurl-->

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

    <!--ツイッター認証をしていない時に表示-->
      <p class="p-follows__text">各アカウントをフォローをするには「Twitter認証」をしてください。</p>
      <div class="c-btn c-btn__corp c-btn__l u-mt--xl">
        <a class="u-ft__btn" href="{{ url('auth/twitter') }}">Twitter認証をする</a>
      </div>

    @endif
    </section>

@endif

</section>
</section>

@endsection
