@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase_done.css') }}">
@endsection

@section('content')
<div class="done">
    <h2>購入が完了しました！</h2>
    <div class="done__link">
        <a href="/">商品一覧へ</a>
    </div>
</div>
@endsection