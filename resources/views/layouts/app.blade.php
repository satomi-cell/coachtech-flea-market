<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>フリマアプリ</title>

    <!-- CSS読み込み -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('css')
</head>
<body>

<header class="header">
    <div class="header-inner">

        <!-- ロゴ -->
        <div class="logo">
            <a href="/">
                <img src="{{ asset('img/logo.png') }}" alt="ロゴ">
            </a>
        </div>

        <!-- 検索 -->
        <form class="search-form" action="/" method="GET">
            <input type="text" name="keyword" placeholder="なにをお探しですか？">
        </form>

        <!-- ナビ -->
      <nav class="nav">

         @guest
            <a href="/login">ログイン</a>
         @endguest

         @auth
             <form method="POST" action="/logout" style="display:inline;">
                 @csrf
                 <button type="submit" class="nav-link">ログアウト</button>
             </form>
         @endauth

         <a href="/mypage">マイページ</a>
         <a href="/sell" class="sell-btn">出品</a>

      </nav>
    </div>
</header>

<main>
    @yield('content')
</main>

</body>
</html>