@extends('layouts.app1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
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
                    <td class="item__comment-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="blue">
                            <path d="M160-240q-33 0-56.5-23.5T80-320v-480q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v720L720-240H160Z" />
                        </svg>
                    </td>
                    @else
                    <td class="item__like-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                            <path d="m354-247 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-80l65-281L80-550l288-25 112-265 112 265 288 25-218 189 65 281-247-149L233-80Zm247-350Z" />
                        </svg>
                    </td>
                    <td class="item__comment-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
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
        <div class="comment">
            @foreach($items->comments as $comment)
            @if($comment->user_id==Auth::user()->id)
            <div class="comment__user-mine">
                <div class="comment__user-img">
                    <img src="{{ asset($comment->user->profile->img_url) }}" alt="">
                </div>
                <p>{{ $comment->user->name }}</p>
            </div>
            <div class="comment__list-mine">
                <p>{{ $comment->comment }}</p>
                <a class="comment__delete" href="{{ route('comment_destroy',$comment->id) }}">削除</a>
            </div>
            @else
            @if(!empty($comment->user->id))
            <div class="comment__user">
                <div class="comment__user-img">
                    <img src="{{ asset($comment->user->profile->img_url) }}" alt="">
                </div>
                <p>{{ $comment->user->name }}</p>
            </div>
            <div class="comment__list">
                <p>{{ $comment->comment }}</p>
            </div>
            @else
            <div class="comment__list">
                <p>ユーザーは削除されました</p>
            </div>
            @endif
            @endif
            @endforeach
        </div>
        <div class="comment__post">
            <form class="form__comment" action="/comment_store" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $items->id }}">
                <h5>商品へのコメント</h5>
                <div class="form__comment-text">
                    <textarea name="comment"></textarea>
                </div>
                <div class="form__comment-button">
                    <button class="form__comment-submit" type="submit">コメントを送信する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection