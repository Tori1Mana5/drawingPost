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
            'body.0' => ['max:140'],
            'body.1' => ['required', 'between:4,50'],
            'profile_image.0' => ['image:jpg,jpeg,png,gif'],
            'profile_image.1' => ['image:jpg,jpeg,png,gif'],
        ];
    }
}
