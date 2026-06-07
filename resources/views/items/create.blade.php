@extends('layouts.app')

@section('content')
<div class="sell-container">
    <h2 class="sell-title">商品の出品</h2>

 <form action="/sell" method="POST" enctype="multipart/form-data">
        @csrf


    <div class="form-section">
        <label class="form-label">商品画像</label>
        <input type="file" name="image">

        @error('image')
           <p>{{ $message }}</p>
        @enderror
    </div>

   <div class="form-section">
       <h3 class="section-title">商品の詳細</h3>
   </div>

   <div class="form-section">
     <label class="form-label">カテゴリー</label>
       <div class="category-list">
          @foreach($categories as $category)
             <label>
                 <input
                     type="checkbox"
                     name="categories[]"
                     value="{{ $category->id }}"
                  >
                 {{ $category->name }}
             </label>
         @endforeach
       </div>

       @error('categories')
           <p>{{ $message }}</p>
       @enderror
   </div>

  <div class="form-section">
      <label class="form-label">商品の状態</label>
      <select name="condition" class="form-select">
          <option value="">選択してください</option>
          <option value="良好">良好</option>
          <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
          <option value="やや傷や汚れあり">やや傷や汚れあり</option>
          <option value="状態が悪い">状態が悪い</option>
       </select>

       @error('condition')
           <p>{{ $message }}</p>
       @enderror
  </div>

  <div class="form-section">
      <h3 class="section-title">商品名と説明</h3>
  </div>

  <div class="form-section">
        <label class="form-label">商品名</label>
        <input type="text" name="name" class="form-input">

        @error('name')
           <p>{{ $message }}</p>
        @enderror
  </div>

  <div class="form-section">
        <label class="form-label">ブランド名</label>
        <input type="text" name="brand" class="form-input">
  </div>

  <div class="form-section">
        <label class="form-label">商品の説明</label>
        <textarea name="description" class="form-textarea"></textarea>

        @error('description')
            <p class="error-message">{{ $message }}</p>
        @enderror
  </div>

  <div class="form-section">
        <label class="form-label">販売価格</label>
        <div class="price-input">
           <span>¥</span>
           <input type="number" name="price" class="form-input">
        </div>

        @error('price')
            <p class="error-message">{{ $message }}</p>
        @enderror
   </div>
    
   <button class="submit-btn">出品する</button>

 </form>
</div>

@endsection