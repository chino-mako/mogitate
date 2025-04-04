@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品登録</h1>
    
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名入力 -->
        <div class="form-group">
            <label for="name">商品名 <span class="required">必須</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="商品名を入力">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- 値段入力 -->
        <div class="form-group">
            <label for="price">値段 <span class="required">必須</span></label>
            <input type="number" id="price" name="price" class="form-control" value="{{ old('price') }}" placeholder="値段を入力">
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- 商品画像アップロード -->
        <div class="form-group">
            <label for="image">商品画像 <span class="required">必須</span></label>
            <input type="file" id="image" name="image" class="form-control-file">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- 季節選択（複数選択可能） -->
        <div class="form-group">
            <label for="seasons">季節 <span class="required">必須</span> <span class="optional">複数選択可</span></label>
            <div class="season-group">
                @foreach($seasons as $season)
                    <label class="season-label">
                        <input type="checkbox" name="seasons[]" value="{{ $season->id }}" 
                            {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                @endforeach
            </div>
            @error('seasons')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- 商品説明入力 -->
        <div class="form-group">
            <label for="description">商品説明 <span class="required">必須</span></label>
            <textarea id="description" name="description" class="form-control" rows="4" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- ボタン -->
        <div class="form-group button-group">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
    </form>
</div>
@endsection
