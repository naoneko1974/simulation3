@extends('layouts.app1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="item">
    <div class="item__tab">
        <a class="item__tab-recommend" href="/">おすすめ</a>
        @if(Auth::check())
        <a class="item__tab-like" href="{{ route('like_list') }}">マイリスト</a>
        @else
        <a class="item__tab-like" href="" disabled>マイリスト</a>
        @endif
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