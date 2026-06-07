@extends('layouts.simple')

@section('content')
<div class="verify-container">
    <p class="verify-text">
        登録していただいたメールアドレスに認証メールを送付しました。<br>
        メール認証を完了してください。
    </p>

   <a href="/verify-email" class="verify-button">
        認証はこちらから
   </a>
    
   <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="resend-link">
            認証メールを再送する
        </button>
    </form>
</div>
@endsection