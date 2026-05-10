@extends('layouts.app')

@section('content')
<div class="detail-container">
    <div class="detail-content">

        <!-- 左：画像 -->
        <div class="detail-image">
            <img src="{{ $item->image }}" alt="{{ $item->name }}">
        </div>

        <!-- 右：情報 -->
        <div class="detail-info">

            <h2 class="product-name">{{ $item->name }}</h2>
            <p class="brand">ブランド名</p>

            <p class="price">¥{{ number_format($item->price) }} (税込)</p>

            <!-- アイコン -->

            <div class="icons">

             <div class="icon-item">
                  <img src="{{ asset('img/heart_logo.png') }}" alt="いいね">
                  <span>0</span>
             </div>

            <div class="icon-item">
                  <img src="{{ asset('img/comment.png') }}" alt="コメント">
                  <span>0</span>
            </div>
        </div>
            
        <button class="purchase-btn">購入手続きへ</button>

            <!-- 商品説明 -->
            <h3>商品説明</h3>
            <p>{{ $item->description }}</p>

            <!-- 商品情報 -->
            <h3>商品の情報</h3>
            <p>カテゴリー：未設定</p>
            <p>商品の状態：良好</p>

            <!-- コメント -->
            <h3>コメント(0)</h3>

            <div class="comment">
                <strong>admin</strong>
                <p>ここにコメントが入ります</p>
            </div>

            <!-- コメント入力 -->
            <h3>商品へのコメント</h3>
            <textarea rows="4"></textarea>

            <button class="comment-btn">コメントを送信する</button>

        </div>
    </div>
</div>
@endsection

