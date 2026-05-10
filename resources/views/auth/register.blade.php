@extends('layouts.simple')

@section('content')
<div class="register-container">
    <h2 class="register-title">会員登録</h2>

    <form action="/register" method="POST" class="register-form" novalidate>
        @csrf

        <div class="form-group">
            <label>ユーザー名</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>確認用パスワード</label>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit" class="register-button">登録する</button>
    </form>

    <div class="login-link">
        <a href="/login">ログインはこちら</a>
    </div>
</div>
@endsection