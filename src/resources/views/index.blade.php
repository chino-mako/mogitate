@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection


@section('content')
<div class="container">
    <h1 class="title">商品一覧</h1>

    <!-- 検索フォーム -->
    <div class="search-container">
        <form action="{{ route('products.search') }}" method="GET">
            <input type="text" name="search" placeholder="商品名で検索" value="{{ request('search') }}">
            <button type="submit" class="search-button">検索</button>
        </form>

        <!-- 検索結果がない場合の表示 -->
        @if($products->isEmpty())
            <p>該当する商品は見つかりませんでした。</p>
        @endif

    </div>

    <!-- 並び替えポップアップ -->
    <div class="sort-container">
        <button onclick="toggleSortPopup()" class="sort-button">並び替え</button>
        <div id="sort-popup" class="sort-popup">
            <form action="{{ route('products.index') }}" method="GET">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <button type="submit" name="sort" value="desc">価格が高い順</button>
                <button type="submit" name="sort" value="asc">価格が低い順</button>
            </form>
        </div>
    </div>

    <!-- 適用中の並び替え条件（タグ表示） -->
    @if(request('sort'))
        <div class="sort-tag">
            並び替え: {{ request('sort') == 'desc' ? '価格が高い順' : '価格が低い順' }}
            <a href="{{ route('products.index', ['search' => request('search')]) }}" class="sort-reset">×</a>
        </div>
    @endif

    <!-- 商品カード一覧 -->
    <div class="product-grid">
        @foreach($products as $product)
        <div class="product-card">
            <a href="{{ route('products.show', $product->id) }}">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <div class="product-info">
                    <h2>{{ $product->name }}</h2>
                    <p>￥{{ number_format($product->price) }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <!-- ページネーション -->
    <div class="pagination">
        {{ $products->links() }}
    </div>

    <!-- 商品追加ボタン -->
    <a href="{{ route('products.create') }}" class="add-product-button">+ 商品を追加</a>
</div>

<script>
    function toggleSortPopup() {
        let popup = document.getElementById("sort-popup");
        popup.style.display = (popup.style.display === "block") ? "none" : "block";
    }
</script>

@endsection
