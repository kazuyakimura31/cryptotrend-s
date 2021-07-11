@extends('layouts.app')

@section('content')
  <h2 class="">
    通貨トレンド
  </h2>

<!--コントローラーから持ってきたデータ。-->
<!--coin_ajaxはcoinのデータを取得するためのajaxに使うURL。-->
<!--hour,day,weekはそれぞれ期間分のツイート数を取得したもの。-->

<div id="coinsapp">
  <coins-component
  coin_ajax="{{ url('ajax/coin') }}"
  hour = "{{$hour}}"
  day = "{{$day}}"
  week = "{{$week}}"
  >
</coins-component>
</div>

@endsection
