@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell">
    <h3>商品の出品</h3>
    <form class="form__sell" action="/listing" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form__sell-content">
            <p>商品画像</p>
            <div class="form__sell-img-tag">
                <div class="form__sell-img">
                    <img src="" id="preview" alt="">
                </div>
                <div class="form__sell-img-label">
                    <label>
                        <input type="file" name="img_url" id="image" accept="image/*" value="{{ old('img_url') }}">画像を選択する
                    </label>
                    <p id="file_name"></p>
                </div>
            </div>
        </div>
        <h4>商品の詳細</h4>
        <div class="form__sell-content">
            <p>カテゴリー</p>
            <div class="form__sell-category">
                <select name="category_id">
                    <option value="">選択</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('category_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__sell-content">
            <p>商品の状態</p>
            <div class="form__sell-condition">
                <select name="condition_id">
                    <option value="">選択</option>
                    @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('condition_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <h4>商品名と説明</h4>
        <div class="form__sell-content">
            <p>商品名</p>
            <div class="form__sell-name">
                <input type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__sell-content">
            <p>ブランド</p>
            <div class="form__sell-brand">
                <input type="text" name="brand" value="{{ old('brand') }}">
            </div>
            <div class="form__error">
                @error('brand')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__sell-content">
            <p>商品の説明</p>
            <div class="form__sell-description">
                <textarea name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>
        <h4>販売価格</h4>
        <div class="form__sell-content">
            <p>販売価格</p>
            <div class="form__sell-price">
                <input type="text" name="price" value="{{ old('price') }}" placeholder="&yen">
            </div>
            <div class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">出品する</button>
        </div>
    </form>
</div>
@endsection