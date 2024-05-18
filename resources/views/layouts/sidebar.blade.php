<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AtlasBulletinBoard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="all_content">
  <div class="d-flex">
    <div class="sidebar">
      @section('sidebar')
      <div class="menu">
        <div><img src="{{ asset('/image/icon1.png')}}" width="20px" height="20px" class="images"></div>
        <p><a href="{{ route('top.show') }}">マイページ</a></p>
      </div>

      <div class="menu">
        <div><img src="{{ asset('/image/icon2.png')}}" width="20px" height="20px" class="images"></div>
        <p><a href="/logout">ログアウト</a></p>
      </div>

      <div class="menu">
        <div><img src="{{ asset('/image/icon3.png')}}" width="20px" height="20px" class="images"></div>
        <p><a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}">スクール予約</a></p>
      </div>

      <!-- 講師アカウントにだけ表示させる・・・・・ -->

      @if(Auth::user()->role >= 1 && Auth::user()->role <= 3)
      <!-- バリュー属性が1 以上かつ 3 以下である場合に、表示させる -->

      <div class="menu">
        <div><img src="{{ asset('/image/icon4.png')}}" width="20px" height="20px" class="images"></div>
        <p><a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}">スクール予約確認</a></p>
      </div>

      <div class="menu">
        <div><img src="{{ asset('/image/icon5.png')}}" width="20px" height="20px" class="images"></div>
        <p><a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}">スクール枠登録</a></p>
      </div>

      @endif

      <!-- ・・・・・・・・・・・・・・・・・・・・ -->

      <div class="menu">
        <div><img src="{{ asset('/image/icon6.png')}}" width="20px" height="20px" class="images"></div>
        <p><a href="{{ route('post.show') }}">掲示板</a></p>
      </div>

      <div class="menu">
        <div><img src="{{ asset('/image/icon7.png')}}" width="20px" height="20px" class="images"></div>
        <p><a href="{{ route('user.show') }}">ユーザー検索</a></p>
      </div>
      @show
    </div>
    <div class="main-container">
      @yield('content')
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
</body>
</html>
