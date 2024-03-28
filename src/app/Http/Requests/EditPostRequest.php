<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest
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
            'text' => ['required_without:image', 'max:140'],
            'image' => ['image:jpg,jpeg,png,gif']
        ];
    }

    public function messages()
    {
        return [
            'required_without' => '作品説明の入力、または作品画像を指定してください',
            'max' => ':max文字以内で入力してください',
            'image' => '形式はjpg,jpeg,png,gifを指定してください'
        ];
    }
}
