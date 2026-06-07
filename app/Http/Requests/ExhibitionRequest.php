<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],

            'description' => ['required', 'max:255'],

            'image' => [
                'required',
                'image',
                'mimes:jpeg,png',
            ],

            'condition' => ['required'],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'categories' => ['required', 'array', 'min:1'],
        ];
    }

    public function messages(): array
    {
      return [
          'name.required' => '商品名を入力してください',

          'description.required' => '商品の説明を入力してください',
          'description.max' => '商品の説明は255文字以内で入力してください',

          'image.required' => '商品画像を選択してください',
          'image.mimes' => '商品画像はjpegまたはpng形式でアップロードしてください',

          'categories.required' => 'カテゴリを選択してください',
          'categories.min' => 'カテゴリを1つ以上選択してください',

          'condition.required' => '商品の状態を選択してください',

          'price.required' => '販売価格を入力してください',
          'price.numeric' => '販売価格は数値で入力してください',
          'price.min' => '販売価格は0円以上で入力してください',
       ];
    }

}
