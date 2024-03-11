<html>
    <head>
		<meta charset="utf-8">
        @vite(['resources/sass/app.scss', 'resources/js/app.js']) 
        <title>{{ config('app.name') }} - @yield('title')</title>
    </head>
    <body>
        <header>
            <!-- 共有のヘッダー -->
            @include('layouts.header')
        </header>
        <maim>
            <!-- メインコンテンツ -->
            @yield('content')
        </maim>
        <footer>
            <!-- 共通のフッター -->
            @include('layouts.footer')
        </footer>
    </body>
</html>
