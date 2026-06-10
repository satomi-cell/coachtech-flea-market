
@extends('layouts.app')

@section('content')
<div class="detail-container">
    <div class="detail-content">

        <!-- 左：画像 -->
        <div class="detail-image">
           <img
              src="{{ str_starts_with($item->image, 'http')
                  ? $item->image
                  : asset('storage/' . $item->image) }}"
              alt="{{ $item->name }}"
            >
        </div>

        <!-- 右：情報 -->
        <div class="detail-info">

             <h2 class="product-name">{{ $item->name }}</h2>
                @if($item->brand && $item->brand !== 'なし')
                  <p class="brand">{{ $item->brand }}</p>
                @endif
    
            <p class="price">¥{{ number_format($item->price) }} (税込)</p>

<!-- アイコン -->

<div class="icons">

  <div class="icon-item">

    @auth

        @if(auth()->user()->likeItems->contains($item->id))

            <form action="/item/{{ $item->id }}/like" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="like-button">
                    <img src="{{ asset('img/heart_red_logo.png') }}" alt="いいね" width="30">
                </button>
            </form>

        @else

            <form action="/item/{{ $item->id }}/like" method="POST">
                @csrf

                <button type="submit" class="like-button like-off">
                    <img src="{{ asset('img/heart_logo.png') }}" alt="いいね" width="30">
                </button>
            </form>

        @endif

    @else

        <img src="{{ asset('img/heart_logo.png') }}" alt="いいね" width="30">

    @endauth

    <span>{{ $item->likeUsers->count() }}</span>

  </div>
        <div class="icon-item">
            <img src="{{ asset('img/comment.png') }}" alt="コメント">
            <span>{{ $item->comments->count() }}</span>
        </div>
</div>
            
<form action="{{ route('purchase.create', $item) }}" method="GET">
    <button type="submit" class="purchase-btn">
        購入手続きへ
    </button>
</form>
            <!-- 商品説明 -->
            <h3>商品説明</h3>
            <p>{{ $item->description }}</p>

            <!-- 商品情報 -->
            <h3>商品の情報</h3>
            
            @if($item->categories->isNotEmpty())
                <div class="category-tags">
                      @foreach($item->categories as $category)
                           <span class="category-tag">{{ $category->name }}</span>
                      @endforeach
                </div>
            @endif
            
            <p>商品の状態：{{ $item->condition }}</p>

            <!-- コメント -->
           <h3>コメント({{ $item->comments->count() }})</h3>

           @foreach($item->comments as $comment)
               <div class="comment">
                   <strong>{{ $comment->user->name }}</strong>
                   <p>{{ $comment->content }}</p>
               </div>
           @endforeach

           <!-- コメント入力 -->
           <h3>商品へのコメント</h3>

           @auth
           <form action="{{ route('comments.store', $item) }}" method="POST">
              @csrf

              <textarea name="content" rows="4">{{ old('content') }}</textarea>

              @error('content')
                  <p class="error">{{ $message }}</p>
              @enderror

              <button type="submit" class="comment-btn">
                  コメントを送信する
              </button>
           </form>
           @endauth
        </div>
    </div>
</div>
@endsection
