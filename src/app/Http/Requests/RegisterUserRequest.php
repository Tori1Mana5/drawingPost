<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'userName' => ['required', 'max:15', 'alpha_num:ascii'],
            'displayName' => ['required', 'between:4,50'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'alpha_num' => '半角英数字を入力してください',
            'required' => '必須項目です、入力してください',
            'between' => ':min文字以上:max文字以内で入力してください',
            'password.unique' => '指定したメールアドレスのアカウントは登録済みです',
        ];
    }
}
