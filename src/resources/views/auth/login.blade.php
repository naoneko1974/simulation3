@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <h3>ログイン</h3>
    <form class="form__login" action="/login" method="post">
        @csrf
        <div class="login__content-item">
            <p>メールアドレス</p>
            <div class="login__content-email">
                <input type="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="login__content-item">
            <p>パスワード</p>
            <div class="login__content-password">
                <input type="password" name="password">
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログインする</button>
        </div>
    </form>
    <div class="register__content">
        <a class="register__link" href="/register">会員登録はこちら</a>
    </div>
</div>
@endsection