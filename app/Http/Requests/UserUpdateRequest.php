<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'    => 'nullable|email|unique:users,email,'.auth()->id(),
            'name' => ['nullable', 'string', 'min:2','max:100'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => 'nullable|min:9|max:13|regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/',
        ];
    }
}
