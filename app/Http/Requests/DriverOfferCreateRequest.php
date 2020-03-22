<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverOfferCreateRequest extends FormRequest
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
            'nameOfOrder'=>'required|min:5|max:80',
            'types.*'=>'required|numeric',
            'carType'=>'required|numeric',
            'country'=>'required|numeric',
            'region'=>'required|numeric',
            'city'=>'required|numeric',
            'price_per_km'=>'required|numeric',
            'internal_width'=>'nullable|numeric',
            'internal_height'=>'nullable|numeric',
            'internal_length'=>'nullable|numeric',
            'capacity'=>'nullable|numeric',
            'max_weight'=>'nullable|integer',
            'description'=>'nullable|string|max:2000',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
