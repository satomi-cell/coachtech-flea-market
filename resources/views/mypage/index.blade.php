@extends('layouts.app')

@section('content')

<div class="mypage">

    {{-- プロフィール --}}
    <div class="profile">

        @if ($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" width="150">
        @endif

        <h2>{{ $user->name }}</h2>

        <a href="/mypage/profile">プロフィールを編集</a>
    </div>

</div>

@endsection