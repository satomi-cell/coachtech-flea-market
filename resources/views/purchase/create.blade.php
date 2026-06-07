@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')

<form action="/purchase/{{ $item->id }}" method="POST">
    @csrf
    
    <div class="purchase-page">

    {{-- 左側 --}}
    <div class="purchase-left">

        {{-- 商品情報 --}}
        <div class="item-section">

        <div class="item-image">
            <img src="{{ $item->image }}" alt="">
       </div>

            <div class="item-info">
                <h2>{{ $item->name }}</h2>
                <p>¥ {{ number_format($item->price) }}</p>
            </div>

        </div>

        {{-- 支払い方法 --}}
        <div class="section">
            <h3>支払い方法</h3>

            <select name="payment_method" id="payment_method">
                <option value="">選択してください</option>
                <option value="コンビニ払い">コンビニ払い</option>
                <option value="カード支払い">カード支払い</option>
            </select>

            @error('payment_method')
                    <p class="error">{{ $message }}</p>
            @enderror

        </div>

        {{-- 配送先 --}}
        <div class="section">

            <div class="address-header">
                <h3>配送先</h3>

                <a href="/purchase/address/{{ $item->id }}">
                    変更する
                </a>
            </div>

            <div class="address">

                <p>
                    〒 {{ $shippingAddress['postal_code'] }}
                </p>

                <p>
                    {{ $shippingAddress['address'] }}
                </p>

                <p>
                    {{ $shippingAddress['building'] }}
                </p>

            </div>

        </div>

    </div>

    {{-- 右側 --}}
    <div class="purchase-right">

        <div class="summary">

            <div class="summary-row">
                <span>商品代金</span>
                <span>
                    ¥ {{ number_format($item->price) }}
                </span>
            </div>

            <div class="summary-row">
                <span>支払い方法</span>

                <span id="payment_method_display">
                    購入時に選択
                </span>
            </div>

        </div>

        <button type="submit" class="purchase-button">
             購入する
        </button>

    </div>

  </div>
 
  <script>
  document.addEventListener('DOMContentLoaded', function () {

    const paymentMethod = document.getElementById('payment_method');
    const display = document.getElementById('payment_method_display');

    paymentMethod.addEventListener('change', function () {
        display.textContent = this.value || '購入時に選択';
    });

  });
 </script>
</form>

@endsection