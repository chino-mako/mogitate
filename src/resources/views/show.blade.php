@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="container">
    <!-- 商品一覧へのリンク -->
    <a href="{{ route('products.index') }}" class="back-link">商品一覧 > {{ $product->name }}</a>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- 商品画像表示＆アップロード -->
        <div class="image-container">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
            @endif
            <input type="file" name="image">
            @if ($product->image)
                <input type="hidden" name="existing_image" value="{{ $product->image }}">
            @endif
            @error('image')<p class="error">{{ $message }}</p>@enderror
        </div>

        <!-- 商品名入力 -->
        <label>商品名</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
        @error('name')<p class="error">{{ $message }}</p>@enderror

        <!-- 値段入力 -->
        <label>値段</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
        @error('price')<p class="error">{{ $message }}</p>@enderror

        <!-- 季節選択（複数選択可能） -->
        <label>季節</label>
        <div class="season-container">
            @foreach($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}" 
                        {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
            @endforeach
        </div>
        @error('seasons')<p class="error">{{ $message }}</p>@enderror

        <!-- 商品説明入力 -->
        <label>商品説明</label>
        <textarea name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
        @error('description')<p class="error">{{ $message }}</p>@enderror

        <!-- ボタンエリア -->
        <div class="btn-container">
            <button type="submit" class="btn-save">変更を保存</button>
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
        </div>
    </form>

    <!-- 削除ボタン -->
    <form action="{{ route('products.delete', $product->id) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">🗑</button>
    </form>
</div>
@endsection