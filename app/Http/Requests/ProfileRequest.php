<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'profile_image' => [
            'nullable',
            'mimes:jpeg,png',
        ],

        'name' => [
            'required',
            'max:20',
        ],

        'postal_code' => [
            'required',
            'regex:/^\d{3}-\d{4}$/',
        ],

        'address' => [
            'required',
        ],

        'building' => [
            'nullable',
        ],
      ];
    }

    public function messages(): array
   {
       return [
           'profile_image.mimes' =>
               'プロフィール画像はjpegまたはpng形式でアップロードしてください。',

           'name.required' =>
                'ユーザー名を入力してください。',

            'name.max' =>
                'ユーザー名は20文字以内で入力してください。',

            'postal_code.required' =>
                '郵便番号を入力してください。',

            'postal_code.regex' =>
                '郵便番号はハイフンあり（123-4567）で入力してください。',

            'address.required' =>
                '住所を入力してください。',
        ];
    }
}
