<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'text' => ['max:140'],
            'displayName' => ['required', 'between:4,50'],
            'profileIconImage' => ['image:jpg,jpeg,png,gif'],
            'profileBackground' => ['image:jpg,jpeg,png,gif'],
        ];
    }

    public function messages()
    {
        return [
            'max' => ':max以内で入力してください',
            'required' => ':attributeを入力してください',
            'between' => ':min以上、:max以内で入力してください',
            'image' => '形式はjpg,jpeg,png,gifを指定してください'
        ];
    }

    /**
     * Customize attribute name
     */

    public function attributes()
    {
        return [
            'displayName' => 'ニックネーム'
        ];
    }
}
