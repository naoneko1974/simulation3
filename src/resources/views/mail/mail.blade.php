@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mail.css') }}">
@endsection

@section('content')
<div class="mail">
    <h3>メール送信</h3>
    <form class="form__mail" action="/mail_send" method="post">
        @csrf
        <input type="hidden" name="email" value="{{ $user->email }}">
        <div class="form__mail-content">
            <p>ユーザー名</p>
            <div class="form__user-name">
                <input type="text" name="name" value="{{ $user->name }}">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__mail-content">
            <p>メッセージ</p>
            <div class="form__mail-message">
                <textarea name="message">{{ old('message') }}</textarea>
            </div>
            <div class="form__error">
                @error('message')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__mail-button">
            <button class="form__mail-submit">送信</button>
            @if(session('message'))
            <p>{{ session('message') }}
            @endif
        </div>
        <a class="back" href="/manage">戻る</a>
    </form>
</div>
@endsection