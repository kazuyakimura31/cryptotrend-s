@extends('layouts.app')
@section('title', 'パスワード再発行')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')
<section class="p-container p-container__body" id="contact">
<h2 class="p-container__title"><span>パスワードをリセットする</span></h2>
<p class="p-container__p">入力したメールアドレスにリセット用URLを送信します</p>

    <div class="p-container__body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="p-form p-form__m">
                <!-- <label for="email">メールアドレス</label> -->
                <input id="email" type="email" class="p-input p-input__l form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="メールアドレス" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="p-form p-form__m">
                <button type ="submit" class="c-btn c-btn__corp c-btn__l">送信</button>
            </div>
        </form>
    </div>

</section>
@endsection
