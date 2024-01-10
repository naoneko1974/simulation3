@extends('layouts.app1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="item">
    <div class="item__img">
        <img src="{{ asset($items->img_url) }}" alt="画像">
        @if($items->sold_items->where('item_id',$items->id)->count()==1)
        <span class="sold_item">SOLD OUT</span>
        @endif
    </div>
    <div class="item__detail">
        <div class="item__name">
            <p>{{ $items->name }}</p>
        </div>
        <div class="item__brand">
            <p>{{ $items->brand }}</p>
        </div>
        <div class="item__price">
            <p>&yen{{ $items->price }}（値段）</p>
        </div>
        <div class="item__tag">
            <table>
                <tr>
                    @if(Auth::check())
                    @if($items->likes()->where('user_id',Auth::user()->id)->count()==1)
                    <td class="item__like-icon">
                        <a href="{{ route('unnice',$items->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="red">
                                <path d="m233-80 65-281L80-550l288-25 112-265 112 265 288 25-218 189 65 281-247-149L233-80Z" />
                            </svg>
                        </a>
                    </td>
                    @else
                    <td class="item__like-icon">
                        <a href="{{ route('nice',$items->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="gray">
                                <path d="m233-80 65-281L80-550l288-25 112-265 112 265 288 25-218 189 65 281-247-149L233-80Z" />
                            </svg>
                        </a>
                    </td>
                    @endif
                    @if((Auth::user()->introduction)==1 and (Auth::user()->staff)!=1)
                    <td class="item__comment-icon">
                        <a href="/comment/{{ $items->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                <path d="M880-80 720-240H160q-33 0-56.5-23.5T80-320v-480q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v720ZM160-320h594l46 45v-525H160v480Zm0 0v-480 480Z" />
                            </svg>
                        </a>
                    </td>
                    @else
                    <td class="item__comment-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="gray">
                            <path d="M160-240q-33 0-56.5-23.5T80-320v-480q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v720L720-240H160Z" />
                        </svg>
                    </td>
                    @endif
                    @else
                    <td class="item__like-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                            <path d="m354-247 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-80l65-281L80-550l288-25 112-265 112 265 288 25-218 189 65 281-247-149L233-80Zm247-350Z" />
                        </svg>
                    </td>
                    <td class="item__comment-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="gray">
                            <path d="M160-240q-33 0-56.5-23.5T80-320v-480q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v720L720-240H160Z" />
                        </svg>
                    </td>
                    @endif
                </tr>
                <tr>
                    <td class="item__like-count">{{ $items->likes()->count() }}</td>
                    <td class="item__comment-count">{{ $items->comments()->count() }}</td>
                </tr>
            </table>
        </div>
        <div class="item__purchase">
            @if(Auth::check())
            @if(!empty($items->where('user_id',Auth::user()->id)->where('id',$items->id)->first()))
            <a class="item__purchase-link" href="" disabled>購入する</a>
            @else
            @if($items->sold_items->where('item_id',$items->id)->count()==1)
            <a class="item__purchase-link" href="" disabled>購入する</a>
            @else
            <a class="item__purchase-link" href="/purchase/{{ $items->id }}">購入する</a>
            @endif
            @endif
            @endif
        </div>
        <h3>商品説明</h3>
        <div class="item__description">
            <textarea readonly>{{ $items->description }}</textarea>
        </div>
        <h3>商品の情報</h3>
        <div class="item__category">
            <span>カテゴリー</span>
            @foreach($categories as $category)
            <p>{{ $category->name }}</p>
            @endforeach
        </div>
        <div class="item__condition">
            <span>商品の状態</span>
            <p>{{ $items->condition->condition }}</p>
        </div>
    </div>
</div>
@endsection