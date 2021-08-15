@extends('layouts.app')
@section('title', 'ログイン')
@section('description', 'CryptoTrendは、Twitterを使ってツイート数を銘柄毎に集計し各銘柄の話題性を教えてくれるWEBサービスです。')
@section('keywords', 'CryptoTrend,仮想通貨,仮想通貨トレンド,twitter,自動フォロー,仮想通貨ニュース')

@section('content')
<section class="p-container p-container__ornament" id="contact">
<h2 class="p-container__title"><span>ログイン</span></h2>
<div class="p-container__body">
    <form method="POST" action="{{ route('login') }}">
        @csrf

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
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">ログイン情報を保存する</label>
        </div>

        <div class="p-form p-form__m">
            <button type ="submit" class="c-btn c-btn__corp c-btn__l">ログイン</button>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">パスワードを忘れた人はコチラ</a>
            @endif
        </div>
        
    </form>
  </div>
</section>
@endsection
