<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DialogRequest extends FormRequest
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
            'description'=>'required|max:2000|min:5',
            'offer_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Поле описание объязательно',
        ];
    }
}
