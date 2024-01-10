@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <h3>会員登録</h3>
    <form class="form__register" action="/register" method="post">
        @csrf
        <div class="register__content-item">
            <p>メールアドレス</p>
            <div class="register__content-email">
                <input type="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="register__content-item">
            <p>パスワード</p>
            <div class="register__content-password">
                <input type="password" name="password">
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">会員登録する</button>
        </div>
    </form>
    <div class="login__content">
        <a class="login__link" href="/login">ログインはこちら</a>
    </div>
</div>
@endsection