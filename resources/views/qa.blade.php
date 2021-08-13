@extends('layouts.app')
@section('title', 'Q&A')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')

<!-- Q&A -->
<section class="p-container p-container__ornament" id="qa">
  <h2 class="p-container__title"><span>Q&A</span></h2>
  <div class="p-container__body">
    <ul class="p-qa">
      <li class="p-qa__item">
          <span class="p-qa__title">
            Q：Twitterアカウントがないとサービス利用ができないですか？
          </span>
          <span class="p-qa__p">
            A：一部機能に制限はありますが利用はできます。「Twitterフォロー」「仮想通貨トレンド」の利用は、会員登録及びTwitterアカウントが必要になります。
          </span>
      </li>
      <li class="p-qa__item">
          <span class="p-qa__title">
            Q：「Twitterフォロー」の自動フォローでフォロー数が途中で止まりますが、制限がありますか？アカウントいですか？
          </span>
          <span class="p-qa__p">
            A：Twitterのリクエスト制限があるため、フォロー数の上限は「15/15min」「1000/1day」となっております。最終的には全アカウントをフォローできますのでお時間を空けて確認ください。
          </span>
      </li>
    </ul>
  </div>
</section>


@endsection
