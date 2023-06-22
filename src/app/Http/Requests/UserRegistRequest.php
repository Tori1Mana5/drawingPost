<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistRequest extends FormRequest
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
            'body.0' => ['required', 'max:15'],
            'body.1' => ['required', 'between:4,50'],
            'body.2' => ['required', 'email'],
            'body.3' => ['required', 'min:8'],
        ];
    }
}
