@extends('layouts.simple')

@section('content')
<div class="login-container">
    <h2 class="login-title">ログイン</h2>

    <form method="POST" action="/login">
        @csrf

        <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}">
            
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        
        </div>

        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password">
        
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        
        </div>

        <button type="submit" class="login-button">ログインする</button>

        <div class="register-link">
            <a href="/register">会員登録はこちら</a>
        </div>
    </form>
</div>
@endsection