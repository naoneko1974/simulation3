@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manage.css') }}">
@endsection

@section('content')
<div class="manage">
    <h3>管理画面</h3>
    @if((Auth::user()->authority)==1)
    <div class="user__list">
        <div class="user__list-tag">
            <h4>ユーザー管理</h4>
            @if(session('user_message'))
            <p>{{ session('user_message') }}
                @endif
            <form class="user__search" action="/manage/search" method="get">
                <input class="user__search-txt" type="text" name="name_keyword" placeholder="ユーザー名検索">
                <button class="user__search-button" type="submit">
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" style="fill:lightgray">
                        <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                    </svg>
                </button>
            </form>
        </div>
        <table class="user__table">
            <tr class="user__ttl">
                <td width="30px">id</td>
                <td width="100px">ユーザー名</td>
                <td width="80px">郵便番号</td>
                <td width="300px">住所</td>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->profile->postcode }}</td>
                <td>{{ $user->profile->address }}</td>
                @if(($user->introduction)!=1)
                <td><a class="user__introduction" href="{{ route('introduction',$user->id) }}">招待</a></td>
                @else
                <td>
                    <p>招待済</p>
                </td>
                @endif
                <td><a class="user__sendMail" href="/mail/{{ $user->id }}">メール送信</a></td>
                @if(($user->authority)==3)
                <td><a class="user__authority" href="{{ route('authority',$user->id) }}">個人</a></td>
                @else
                <td><a class="user__authority" href="{{ route('authority',$user->id) }}">店舗</a></td>
                @endif
                <td><a class="user__delete" href="{{ route('user_destroy',$user->id) }}">削除</a></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="page">
        <span>{{ $users->links('vendor.pagination.tailwind2') }}</span>
        <span>{{ $users->firstItem() }}～{{ $users->lastItem() }} / 全{{ $users->total() }}件中</span>
    </div>
    <div class="user__list">
        <div class="user__list-ttl">
            <h4>削除済みユーザー管理</h4>
            @if(session('delete_user_message'))
            <p>{{ session('delete_user_message') }}
                @endif
        </div>
        <table class="user__table">
            <tr class="user__ttl">
                <td width="30px">id</td>
                <td width="100px">ユーザー名</td>
                <td width="80px">郵便番号</td>
                <td width="250px">住所</td>
                <td width="150px">削除日</dt>
            </tr>
            @foreach($deletes as $delete)
            <tr>
                <td>{{ $delete->id }}</td>
                <td>{{ $delete->name }}</td>
                <td>{{ $delete->profile->postcode }}</td>
                <td>{{ $delete->profile->address }}</td>
                <td>{{ $delete->deleted_at }}</td>
                <td><a class="user__restoration" href="{{ route('user_restoration',$delete->id) }}">復元</a></td>
                <td><a class="user__force-delete" href="{{ route('user_forcedelete',$delete->id) }}">完全削除</a></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="page">
        <span>{{ $deletes->links('vendor.pagination.tailwind2') }}</span>
        <span>{{ $deletes->firstItem() }}～{{ $deletes->lastItem() }} / 全{{ $deletes->total() }}件中</span>
    </div>
    @endif
    @if((Auth::user()->authority)==2)
    <div class="user__list">
        <div class="user__list-tag">
            <h4>ショップスタッフ管理</h4>
            @if(session('user_message'))
            <p>{{ session('user_message') }}
                @endif
            <form class="user__search" action="/manage/search" method="get">
                <input class="user__search-txt" type="text" name="name_keyword" placeholder="ユーザー名検索">
                <button class="user__search-button" type="submit">
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" style="fill:lightgray">
                        <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                    </svg>
                </button>
            </form>
        </div>
        <table class="user__table">
            <tr class="user__ttl">
                <td width="30px">id</td>
                <td width="100px">ユーザー名</td>
                <td width="80px">郵便番号</td>
                <td width="300px">住所</td>
            </tr>
            @foreach($staffs as $staff)
            <tr>
                <td>{{ $staff->id }}</td>
                <td>{{ $staff->name }}</td>
                <td>{{ $staff->profile->postcode }}</td>
                <td>{{ $staff->profile->address }}</td>
                @if($staff->staffs->where('shopcode',Auth::user()->id)->count()==1)
                <td><a class="user__staff" href="{{ route('staff_destroy',$staff->id) }}">削除</a></td>
                @else
                <td><a class="user__staff" href="{{ route('staff_store',$staff->id) }}">招待</a></td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
    <div class="page">
        <span>{{ $staffs->links('vendor.pagination.tailwind2') }}</span>
        <span>{{ $staffs->firstItem() }}～{{ $staffs->lastItem() }} / 全{{ $staffs->total() }}件中</span>
    </div>
    @endif
</div>
@endsection