<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oak & Spoon</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=BIZ+UDPGothic&family=Bad+Script&family=Black+Ops+One&family=Dela+Gothic+One&family=Ephesis&family=Forum&family=IBM+Plex+Sans+JP&family=Kosugi+Maru&family=M+PLUS+1p&family=Montserrat:ital,wght@0,100..900;1,100..900&family=New+Tegomin&family=Noto+Serif+JP:wght@200..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Tenor+Sans&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
</head>

<body>
    <header>
        {{-- 「もしルート名が orders.index じゃなければ」表示する --}}
        @if (!Route::is('orders.index'))
            <h1><a href="{{ route('orders.index') }}">Oak & Spoon</a></h1>
        @endif
    </header>

    @yield('slider')

    <main>
        @if (session('status'))
            <p class="app-flash" role="status">{{ session('status') }}</p>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>&copy; 2026 Oak & Spoon</p>
    </footer>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.main-slider').slick({
                autoplay: true,    // 自動で動く
                dots: true,        // 下に丸い点々を出す
                arrows: false      // 左右の矢印はいらないならfalse
            });
        });
    </script>
</body>

</html>