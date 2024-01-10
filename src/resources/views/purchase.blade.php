@extends('layouts.app1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">
    <form class="form__purchase" action="/purchase/purchase_store" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $items->id }}">
        <div class="purchase__item">
            <div class="purchase__item-detail">
                <div class="item__img">
                    <img src="{{ asset($items->img_url) }}" alt="画像">
                </div>
                <div class="item__detail">
                    <div class="item__name">
                        <p>{{ $items->name }}</p>
                    </div>
                    <div class="item__price">
                        <p>&yen{{ $items->price }}</p>
                    </div>
                </div>
            </div>
            <div class="item__payment">
                <h4>支払い方法</h4>
                <select name="payment_id" id="payment">
                    <option value="">選択</option>
                    @foreach($payments as $payment)
                    <option value="{{ $payment->id }}">{{ $payment->payment }}</option>
                    @endforeach
                </select>
                <input type="button" class="payment__change" value="変更する" onclick="clickBtn()">
            </div>
            <div class="form__error" id="payment_error">
                @error('payment_id')
                {{ $message }}
                @enderror
            </div>
            <div class="purchase__address">
                <h4>配送先</h4>
                <div class="purchase__address-detail">
                    @if(!empty($postcode))
                    <input type="text" name="postcode" value="{{ $postcode }}" readonly>
                    @else
                    @if(!empty($users->profile->postcode))
                    <input type="text" name="postcode" value="{{ $users->profile->postcode }}" readonly>
                    @else
                    <input type="text" name="postcode" value="" placeholder="未登録" readonly>
                    @endif
                    @endif
                    <div class="form__error">
                        @error('postcode')
                        {{ $message }}
                        @enderror
                    </div>
                    @if(!empty($address))
                    <input type="text" name="address" value="{{ $address }}" readonly>
                    @else
                    @if(!empty($users->profile->address))
                    <input type="text" name="address" value="{{ $users->profile->address }}" readonly>
                    @else
                    <input type="text" name="address" value="" placeholder="未登録" readonly>
                    @endif
                    @endif
                    <div class="form__error">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </div>
                    @if(!empty($building))
                    <input type="text" name="building" value="{{ $building }}" readonly>
                    @else
                    @if(!empty($users->profile->building))
                    <input type="text" name="building" value="{{ $users->profile->building }}" readonly>
                    @else
                    <input type="text" name="building" value="" placeholder="未登録" readonly>
                    @endif
                    @endif
                    <div class="form__error">
                        @error('building')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="address__change">
                    <a class="address__change-link" href="/purchase/purchase_address/{{ $items->id }}/{{ $payment->id }}">変更する</a>
                </div>
            </div>
        </div>
        <div class="purchase__detail">
            <table>
                <tr>
                    <td class="purchase__detail-ttl">商品代金</td>
                    <td class="purchase__detail-item">&yen{{ $items->price }}</td>
                </tr>
                <tr>
                    <td class="purchase__detail-ttl">支払い金額</td>
                    <td class="purchase__detail-item">&yen{{ $items->price }}</td>
                </tr>
                <tr>
                    <td class="purchase__detail-ttl">支払い方法</td>
                    <td class="purchase__detail-item"><span id="payment_change"></span></td>
                </tr>
            </table>
            <div class="purchase__button">
                <button class="purchase__button-submit" type="submit">購入する</button>
            </div>
        </div>
    </form>
</div>
<script>
    function clickBtn() {
        const select = document.getElementById('payment');
        const selectValue = document.getElementById('payment_change');
        selectValue.innerHTML = select.options[select.selectedIndex].innerHTML;
        document.getElementById('payment_error').textContent = '';
    }
</script>
@endsection