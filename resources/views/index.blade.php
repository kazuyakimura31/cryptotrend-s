@extends('layouts.app')
@section('title', 'TOP')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')

<!-- メインビジュアル -->
<section class="p-hero p-container__fluid js-float-menu-target">
  <div class="p-hero__title">
    <h2>Cryptotrend</h2>
    <p>仮想通貨の最新情報を集めるサイト</p>
  </div>
</section>


<!-- Cryptotrendとは -->
<section class="u-bgColor--lightGray" id="about">
  <div class="p-container p-container--lightGray">
    <h2 class="p-container__title p-container__title--lightGray"><span>ABOUT</span></h2>
    <div class="p-container__body">
      <p>Cryptotrendは、仮想通貨の情報収集をお手伝いするWEBサービスです。
        TwitterのAPIを使って、仮想通貨に関するツイート数を銘柄毎に集計し、各銘柄の話題性をお伝えします。
        また他にも、Twitterの仮想通貨関連アカウントの一覧表示、Googleニュースからの仮想通貨関連ニュースの一覧表示を提供しています。
      </p>
    </div>
  </div>
</section>

<!-- 新着ニュース -->
<section class="p-container p-container__ornament" id="news">
  <h2 class="p-container__title"><span>NEWS</span></h2>
  <div class="p-container__body">
    <ul class="p-news">
      <li class="p-news__item">
          <span class="p-news__date">2021.08.01</span>
          <span class="p-news__title">仮想通貨トレンドにOMGを追加しました。</span>
      </li>
      <li class="p-news__item">
          <span class="p-news__date">2021.07.15</span>
          <span class="p-news__title">Twitterフォロー機能に自動フォロー機能を追加しました。</span>
      </li>
      <li class="p-news__item">
          <span class="p-news__date">2021.07.01</span>
          <span class="p-news__title">CryptoTrendのサービスを開始しました。</span>
      </li>
    </ul>
  </div>
</section>


<!-- サービス３つの説明 -->
<section class="u-bgColor--lightGray" id="cource">
  <div class="p-container p-container--lightGray">
    <h2 class="p-container__title"><span>３つの機能</span></h2>
    <div class="p-container__body">
      <div class="p-panel__group p-panel__group--flex">
        <div class="p-panel p-panel__border p-panel__cource">
          <div class="p-panel__head">
            <span class="u-ft__corp u-ft__l">Twitterフォロー</span><br>自動でまとめて
          </div>
          <div class="p-panel__foot">
            <p>「Twitter」から仮想通貨に関連したアカウントを選んでフォローできます。<br>
            さらに「まとめてフォロー機能」を使うと自動でフォローすることもできます。<br>
            </p>
          </div>
        </div>
        <div class="p-panel p-panel__border p-panel__cource">
          <div class="p-panel__head">
            <span class="u-ft__corp u-ft__l">仮想通貨トレンド</span><br>最新トレンドをいちはやく
          </div>
          <div class="p-panel__foot">
            <p>今どのコインがツイッターで話題なのか？<br>
            各仮想通貨のツイート数を基準にランキング形式で一覧表示。<br>
            過去の『1時間/1日/一週間』の期間データを提供しています。
            </p>
          </div>
        </div>
        <div class="p-panel p-panel__border p-panel__cource">
          <div class="p-panel__head">
            <span class="u-ft__corp u-ft__l">仮想通貨ニュース</span><br>最新ニュースをまとめて
          </div>
          <div class="p-panel__foot">
            <p class="c-text">界隈のニュースも見逃さないようにしましょう。<br>
            「仮想通貨」のキーワードでGoogleニュースを提供しています。最新ニュースをまとめて確認できます。
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- はじめよう -->
<section class="p-container p-container__ornament" id="start">
  <h2 class="p-container__title"><span>さっそく、はじめてみる</span></h2>
  <div class="p-container__body">
    <div class="p-panel__group p-panel__group--flex">
        <div class="p-panel p-panel__border p-panel__cource">
            <div class="p-panel__head">
              <span class="u-ft__corp u-ft__l"><a href="{{ route('follows.index') }}">twitterフォロー</a></span>
            </div>
        </div>
        <div class="p-panel p-panel__border p-panel__cource">
          <div class="p-panel__head">
            <span class="u-ft__corp u-ft__l"><a href="{{ route('coins.index') }}">仮想通貨トレンド</a></span>
          </div>
        </div>
        <div class="p-panel p-panel__border p-panel__cource">
          <div class="p-panel__head">
            <span class="u-ft__corp u-ft__l"><a href="{{ route('news.index') }}">仮想通貨ニュース</a></span>
          </div>
        </div>
    </div>
  </div>
</section>


  @guest
  <section class="p-container p-container__ornament" id="start">
  <h2 class="p-container__subtitle"><span>未登録、未ログインの方はこちらから</span></h2>
  <div class="p-container__body">
    <div class="p-panel__group p-panel__group--flex p-panel__login ">

        <div class="c-btn c-btn__corp c-btn__l u-mb--xl">
          <a class="u-ft__btn" href="{{ route('register') }}">新規登録</a>
        </div>
        <div class="c-btn c-btn__corp c-btn__l">
            <a class="u-ft__btn" href="{{ route('login') }}">ログイン</a>
        </div>
        
    </div>
  </div>
  </section>

  @endguest

  @endsection

