<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'mogitate')</title>

    {{-- 共通CSS --}}
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    {{-- 各画面専用CSS --}}
    @stack('styles')
</head>
<body>

<header>
    <h1>mogitate</h1>

    @yield('header-actions')
</header>

<main class="container">
    @yield('content')
</main>

</body>
</html>


