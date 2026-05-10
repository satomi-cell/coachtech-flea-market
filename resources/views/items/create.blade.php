@extends('layouts.app')

@section('content')
<div class="sell-container">
    <h2 class="sell-title">商品の出品</h2>

 <form action="/sell" method="POST">
        @csrf


    <div class="form-section">
        <label class="form-label">商品画像</label>
        <div class="image-upload">画像を選択する</div>
    </div>

   <div class="form-section">
       <h3 class="section-title">商品の詳細</h3>
   </div>

   <div class="form-section">
     <label class="form-label">カテゴリー</label>
       <div class="category-list">
         <button type="button" class="category-btn">ファッション</button>
         <button type="button" class="category-btn">家電</button>
         <button type="button" class="category-btn">インテリア</button>
         <button type="button" class="category-btn">レディース</button>
         <button type="button" class="category-btn">メンズ</button>
         <button type="button" class="category-btn">コスメ</button>
         <button type="button" class="category-btn">本</button>
         <button type="button" class="category-btn">ゲーム</button>
         <button type="button" class="category-btn">スポーツ</button>
         <button type="button" class="category-btn">キッチン</button>
         <button type="button" class="category-btn">ハンドメイド</button>
         <button type="button" class="category-btn">アクセサリー</button>
         <button type="button" class="category-btn">おもちゃ</button>
         <button type="button" class="category-btn">ベビー・キッズ</button>
       </div>
   </div>

  <div class="form-section">
      <label class="form-label">商品の状態</label>
      <select name="status" class="form-select">
          <option value="">選択してください</option>
          <option value="new">新品</option>
          <option value="like_new">未使用に近い</option>
          <option value="used">やや傷や汚れあり</option>
      </select>
  </div>

  <div class="form-section">
      <h3 class="section-title">商品名と説明</h3>
  </div>

  <div class="form-section">
        <label class="form-label">商品名</label>
        <input type="text" name="name" class="form-input">
  </div>

  <div class="form-section">
         <label class="form-label">ブランド名</label>
        <input type="text" name="brand" class="form-input">
  </div>

  <div class="form-section">
        <label class="form-label">商品の説明</label>
        <textarea name="description" class="form-textarea"></textarea>
  </div>

  <div class="form-section">
        <label class="form-label">販売価格</label>
        <div class="price-input">
           <span>¥</span>
           <input type="number" name="price" class="form-input">
        </div>
   </div>
    
   <button class="submit-btn">出品する</button>

 </form>
</div>

@endsection