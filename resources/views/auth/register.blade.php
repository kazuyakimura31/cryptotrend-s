@extends('layouts.app')
@section('title', '新規登録')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')
<section class="p-container p-container__ornament" id="contact">
<h2 class="p-container__title"><span>新規登録</span></h2>
<div class="p-container__body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="p-form p-form__m">
            <label for="name">名前</label>
            <input id="name" type="text" class="p-input p-input__l form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="お名前" required  autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="p-form p-form__m">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" class="p-input p-input__l form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="メールアドレス" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="p-form p-form__m">
            <label for="password">パスワード</label>
            <input id="password" type="password" class="p-input p-input__l form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="パスワード" autocomplete="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="p-form p-form__m">
            <label for="password-confirm">パスワード再入力</label>
            <input id="password-confirm" type="password" class="p-input p-input__l form-control" name="password-confirmation" placeholder="パスワード再入力" required>
        </div>

        <div class="p-form p-form__m">
            <button type ="submit" class="c-btn c-btn__corp c-btn__l">送信</button>
        </div>
        
    </form>
  </div>
</section>
@endsection
