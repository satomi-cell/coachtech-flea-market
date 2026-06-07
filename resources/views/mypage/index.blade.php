@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

<div class="mypage">

    {{-- プロフィール --}}
    <div class="profile">

        @if ($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" 
                 class="profile-icon">
        @else
            <div class="default-icon"></div>
        @endif

        <h2>{{ $user->name }}</h2>

        <a href="/mypage/profile">プロフィールを編集</a>
    </div>
    
    {{-- タブ --}}
    <div class="tabs">

       <a href="/mypage?page=sell"
          class="{{ $page !== 'buy' ? 'active' : '' }}">
            出品した商品
       </a>

       <a href="/mypage?page=buy"
          class="{{ $page === 'buy' ? 'active' : '' }}">
            購入した商品
       </a>
    </div>

    <div class="item-list">

      {{-- 出品一覧 --}}
      @if ($page !== 'buy')

        @foreach ($sellItems as $item)

            <div class="item-card">

                <div class="image">

                    @if ($item->image)
                        <img src="{{ $item->image }}">
                    @else
                        商品画像
                    @endif

                </div>

                <p>{{ $item->name }}</p>

            </div>

        @endforeach


      {{-- 購入一覧 --}}
      @else

        @foreach ($buyItems as $item)


           <div class="item-card">

                <div class="image">

                    @if ($item->image)
                        <img src="{{ $item->image }}">
                    @else
                        商品画像
                    @endif

                </div>

                <p>{{ $item->name }}</p>

            </div>

        @endforeach

      @endif
</div>

</div>
@endsection