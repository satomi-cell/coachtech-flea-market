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
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

   <div class="form-section">
       <h3 class="section-title">商品の詳細</h3>
   </div>

   <div class="form-section">
     <label class="form-label">カテゴリー</label>
       <div class="category-list">
         @foreach($categories as $category)
             <label class="category-tag">
                 <input
                    type="checkbox"
                    name="categories[]"
                    value="{{ $category->id }}"
                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                  >
                 <span>{{ $category->name }}</span>
             </label>
         @endforeach 
        </div>

       @error('categories')
           <p class="error-message">{{ $message }}</p>
       @enderror
   </div>

  <div class="form-section">
      <label class="form-label">商品の状態</label>
        <select name="condition" class="form-select">
           <option value="" disabled {{ old('condition') ? '' : 'selected' }}></option>

           <option value="良好"
              {{ old('condition') == '良好' ? 'selected' : '' }}>
              良好
           </option>

           <option value="目立った傷や汚れなし"
              {{ old('condition') == '目立った傷や汚れなし' ? 'selected' : '' }}>
              目立った傷や汚れなし
           </option>

           <option value="やや傷や汚れあり"
              {{ old('condition') == 'やや傷や汚れあり' ? 'selected' : '' }}>
              やや傷や汚れあり
           </option>

           <option value="状態が悪い"
              {{ old('condition') == '状態が悪い' ? 'selected' : '' }}>
              状態が悪い
           </option>
        </select>
       
        @error('condition')
           <p class="error-message">{{ $message }}</p>
        @enderror
  </div>

  <div class="form-section">
      <h3 class="section-title">商品名と説明</h3>
  </div>

  <div class="form-section">
        <label class="form-label">商品名</label>
        <input type="text" name="name" class="form-input" value="{{ old('name') }}">

        @error('name')
           <p class="error-message">{{ $message }}</p>
        @enderror
  </div>

  <div class="form-section">
        <label class="form-label">ブランド名</label>
        <input type="text" name="brand" class="form-input" value="{{ old('brand') }}">
  </div>

  <div class="form-section">
        <label class="form-label">商品の説明</label>
        <textarea name="description" class="form-textarea">{{ old('description') }}</textarea>

        @error('description')
            <p class="error-message">{{ $message }}</p>
        @enderror
  </div>

  <div class="form-section">
        <label class="form-label">販売価格</label>
        <div class="price-input">
           <span>¥</span>
           <input type="number" name="price" class="form-input" value="{{ old('price') }}">
        </div>

        @error('price')
            <p class="error-message">{{ $message }}</p>
        @enderror
   </div>
    
   <button class="submit-btn">出品する</button>

 </form>
</div>

@endsection