<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '商品管理サイト')</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('css')
</head>
<body>
    <!-- ヘッダー -->
    <header>
        <div class="logo">
            <a href="{{ route('products.index') }}">mogitate</a>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main>
        @yield('content')
    </main>

    <!-- フッター -->
    <footer>
        <p>&copy; 2025 商品管理システム. All rights reserved.</p>
    </footer>
</body>
</html>
