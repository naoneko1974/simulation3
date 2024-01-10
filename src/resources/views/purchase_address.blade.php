@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase_address.css') }}">
@endsection

@section('content')
<div class="address">
    <form class="form__address" action="/purchase/address_update" method="post">
        @csrf
        <h3>住所の変更</h3>
        <div class="address__detail">
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="payment_id" value="{{ $payment_id }}">
            <p>郵便番号</p>
            <div class="address__item">
                <input type="text" name="postcode" id="郵便番号" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');" value="{{ $users->profile->postcode }}">
            </div>
            <div class="form__error">
                @error('postcode')
                {{ $message }}
                @enderror
            </div>
            <p>住所</p>
            <div class="address__item">
                <input type="text" name="address" id="住所" value="{{ $users->profile->address }}">
            </div>
            <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
            <p>建物名</p>
            <div class="address__item">
                <input type="text" name="building" value="{{ $users->profile->building }}">
            </div>
            <div class="form__error">
                @error('building')
                {{ $message }}
                @enderror
            </div>
            <div class="address__update">
                <button class="address__update-link" type="submit">更新する</button>
            </div>
            <a class="address__back" href="/purchase/{{ $id }}">戻る</a>
        </div>
    </form>
</div>
@endsection