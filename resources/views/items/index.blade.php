@extends('layouts.app')

@section('content')

<div class="container">

    <!-- タブ -->
    <div class="tabs">
        <a href="/" class="{{ $tab !== 'mylist' ? 'active' : '' }}">おすすめ</a>
        <a href="/?tab=mylist" class="{{ $tab === 'mylist' ? 'active' : '' }}">マイリスト</a>
    </div>

    <!-- 商品一覧 -->
    <div class="grid">
        @foreach ($items as $item)
          <a href="{{ route('items.show', $item->id) }}">
            <div class="card">

                <div class="image">
                    
                    @if ($item->image)
                      <img src="{{ $item->image }}">
                    @else
                        商品画像
                    @endif
                </div>

                <p class="name">{{ $item->name }}</p>

            </div>
          </a>
        @endforeach
    </div>

</div>

@endsection