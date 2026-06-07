@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')

<div class="address-page">

    <h2 class="address-title">
        住所の変更
    </h2>

    <form action="/purchase/address/{{ $item->id }}" method="POST">

        @csrf

        <div class="form-group">
            <label>郵便番号</label>

            <input
                type="text"
                name="postal_code"
                value="{{ old('postal_code', $user->postal_code) }}"
            >

            @error('postal_code')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>住所</label>

            <input
                type="text"
                name="address"
                value="{{ old('address', $user->address) }}"
            >

            @error('address')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>建物名</label>

            <input
                type="text"
                name="building"
                value="{{ old('building', $user->building) }}"
            >
        </div>

        <button type="submit" class="update-button">
            更新する
        </button>

    </form>

</div>

@endsection