<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'text' => ['required_without:profileIconImage', 'max:140'],
            'profileIconImage' => ['image:jpg,jpeg,png,gif'],
            'profileBackground' => ['image:jpg,jpeg,png,gif'],
        ];
    }

    public function messages()
    {
        return [
            'required_without' => 'プロフィールの入力、またはアイコンの選択のどちらかが必須です',
            'max' => ':max文字以内で入力してください',
            'image' => '形式はjpg,jpeg,png,gifを指定してください'
        ];
    }
}
