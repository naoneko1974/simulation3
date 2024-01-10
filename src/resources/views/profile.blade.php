@extends('layouts.app1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile">
    <h3>プロフィール設定</h3>
    <form class="form__profile" action="/mypage/profile_update" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="id" value="{{ $users->profile->id }}">
        <div class="form__profile-user">
            <div class="form__profile-img-tag">
                <div class="form__profile-img">
                    <img src="{{ asset($users->profile->img_url) }}" id="preview" alt="">
                </div>
                <div class="form__profile-img-label">
                    <label>
                        <input type="file" name="select_img" id="image" accept="image/*" value="{{ $users->profile->img_url }}">画像を選択する
                    </label>
                    <p id="file_name">{{ $users->profile->img_url }}</p>
                </div>
            </div>
            <p>ユーザー名</p>
            <div class="form__profile-item">
                <input type="text" name="name" value="{{ $users->name }}">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <p>郵便番号</p>
            <div class="form__profile-item">
                <input type="text" name="postcode" id="郵便番号" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');" value="{{ $users->profile->postcode }}">
            </div>
            <div class="form__error">
                @error('postcode')
                {{ $message }}
                @enderror
            </div>
            <p>住所</p>
            <div class="form__profile-item">
                <input type="text" name="address" id="住所" value="{{ $users->profile->address }}">
            </div>
            <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
            <p>建物名</p>
            <div class="form__profile-item">
                <input type="text" name="building" value="{{ $users->profile->building }}">
            </div>
            <div class="form__error">
                @error('building')
                {{ $message }}
                @enderror
            </div>
            <div class="form__profile-button">
                <button class="form__profile-submit" type="submit">更新する</button>
            </div>
        </div>
    </form>
</div>
@endsection