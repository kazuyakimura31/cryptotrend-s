<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
<div class="wrapper">

<!-- ヘッダー -->
<header class="l-header js-float-menu">
<h1 class="title"><a href="{{ url('/') }}">CryptoTrend</a></h1>

<div class="l-menu__trigger js-toggle-sp-menu">
    <span></span>
    <span></span>
    <span></span>
</div>

<nav class="l-nav__menu js-toggle-sp-menu-target">
    <ul class="l-menu">

        @guest
            <li class="l-menu__item"><a class="l-menu__link" href="{{ route('qa') }}">Q&A</a></li>
            <li class="l-menu__item"><a class="l-menu__link" href="{{ route('login') }}">ログイン</a></li>

            @if (Route::has('register'))
                <li class="l-menu__item"><a class="l-menu__link" href="{{ route('register') }}">新規登録</a></li>
            @endif
        @else

            @if (session('follow'))
            <li class="l-menu__item"><a class="l-menu__link p-twiiter__autofollow" href="{{ route('follows.index') }}">twitterフォロー</a></li>
            @else
            <li class="l-menu__item"><a class="l-menu__link" href="{{ route('follows.index') }}">twitterフォロー</a></li>
            @endif
            <li class="l-menu__item"><a class="l-menu__link" href="{{ route('coins.index') }}">仮想通貨トレンド</a></li>
            <li class="l-menu__item"><a class="l-menu__link" href="{{ route('news.index') }}">仮想通貨ニュース</a></li>
            <li class="l-menu__item"><a class="l-menu__link" href="{{ route('qa') }}">Q&A</a></li>
            
            <!--SPでのみ表示-->
            <li class="u-mark__sp">{{ Auth::user()->name }}</li> 
            <!--twitterアカウントがあれば表示-->
            @if (Auth::user()->nickname)
            <li class="u-mark__sp"><a href="https://twitter.com/{{ Auth::user()->nickname}}" target="_blank"><img src="{{ Auth::user()->avatar}}" class="p-header__icon"></a></li>
            @endif
            <li>本日のフォロー数：{{ Auth::user()->follow_count}}</li>
            <li><a href="{{ url('auth/twitter/logout')  }}">ログアウト</a></li>

            <!--PCでのみ表示-->
            <li class="p-header__user">{{Auth::user()->name}}</li>
            @if (Auth::user()->nickname)
            <li><a href="https://twitter.com/{{Auth::user()->nickname}}" target="_blank"><img src="{{Auth::user()->avatar}}" class="p-header__icon"></a></li>
            @endif

        @endguest
    </ul>

</nav>
</header>

<!-- フラッシュメッセージ -->
@if (session('flash_message'))
<div class="c-flash__message">
    {{ session('flash_message') }}
</div>
@endif

<!-- メインコンテンツ -->
<main id="main">
    @yield('content')
</main>

<!-- フッター -->
<footer id="footer">
    <p>Copyright © CryptoTrend. All Rights Reserved</p>
</footer>

<!-- Scripts -->
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

</div>
</body>
</html>
