@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品登録</h1>
    
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="product_name">商品名</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="商品名を入力" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            

        </div>

        <div class="form-group">
            <label for="price">値段</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ old('price') }}" placeholder="値段を入力" required>
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">商品画像</label>
            <input type="file" id="image" name="image" class="form-control-file" required>
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="seasons">季節</label>
            <select id="seasons" name="season" class="form-control" multiple>
                <option value="">選択してください</option>
                @foreach($seasons as $season)
                    <option value="{{ $season->id }}" {{ in_array($season->id, old('season', [])) ? 'selected' : '' }}>{{ $season->name }}</option>
                @endforeach
            </select>
            @error('season')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">商品説明</label>
            <textarea id="description" name="description" class="form-control" rows="4" placeholder="商品の説明を入力" required>{{ old('description') }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">登録</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
        </div>
    </form>
</div>
@endsection
