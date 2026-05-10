<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="simple-header">
    <img src="{{ asset('img/logo.png') }}" alt="ロゴ">
</header>

<main>
    @yield('content')
</main>

</body>
</html>