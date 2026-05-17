@extends('layouts.app')

@section('content')
<div class="profile-container">
    <h2 class="profile-title">プロフィール設定</h2>

    <form action="#" method="POST" enctype="multipart/form-data" class="profile-form">
        @csrf

        <!-- 画像 -->
        <div class="profile-image-section">
            <div class="profile-image"></div>
            <label class="image-button">
                画像を選択する
                <input type="file" style="display: none;">
            </label>
        </div>

        <!-- ユーザー名 -->
        <div class="profile-form-group">
            <label class="profile-label">ユーザー名</label>
            <input type="text" name="name" class="profile-input" value="{{ old('name', $user->name) }}">
        </div>

        <!-- 郵便番号 -->
        <div class="profile-form-group">
            <label class="profile-label">郵便番号</label>
            <input type="text" name="postal_code" class="profile-input" value="{{ old('postal_code', $user->postal_code) }}">
        </div>

        <!-- 住所 -->
        <div class="profile-form-group">
            <label class="profile-label">住所</label>
            <input type="text" name="address" class="profile-input" value="{{ old('address', $user->address) }}">
        </div>

        <!-- 建物名 -->
        <div class="profile-form-group">
            <label class="profile-label">建物名</label>
            <input type="text" name="building" class="profile-input" value="{{ old('building', $user->building) }}">
        </div>

        <button class="profile-button">更新する</button>
    </form>
</div>
@endsection