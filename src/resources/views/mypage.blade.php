@extends('layouts.app1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="mypage__user">
        <div class="mypage__user-img">
            <img src="{{ asset($users->profile->img_url) }}" alt="">
        </div>
        <div class="mypage__user-name">
            <p>{{ $users->name }}</p>
        </div>
        <div class="mypage__user-profile">
            <a class="mypage__profile-link" href="/mypage/profile">プロフィールを編集する</a>
        </div>
    </div>
    <div class="mypage__tab">
        <a class="mypage__tab-sell" href="/mypage">出品した商品</a>
        <a class="mypage__tab-purchase" href="{{ route('purchase_list') }}">購入した商品</a>
    </div>
    <div class="item__list">
        @foreach($items as $item)
        <div class="item__list-card">
            <a class="item__list-link" href="/item/{{ $item->id }}"><img src="{{ asset($item->img_url) }}" alt="画像"></a>
            @if($item->sold_items->where('item_id',$item->id)->count()==1)
            <span class="sold_item">SOLD OUT</span>
            @endif
        </div>
        @endforeach
    </div>
    <div class="page">
        <span>{{ $items->links('vendor.pagination.tailwind2') }}</span>
        <span>{{ $items->firstItem() }}～{{ $items->lastItem() }} / 全{{ $items->total() }}件中</span>
    </div>
</div>
@endsection