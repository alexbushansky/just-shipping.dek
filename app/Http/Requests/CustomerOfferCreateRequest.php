<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerOfferCreateRequest extends FormRequest
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
            'nameOfOrder'=>'required|string|min:3|max:80',
            'types.*'=>'required|numeric',
            'country_one'=>'required|numeric',
            'region_one'=>'required|numeric',
            'city_one'=>'required|numeric',
            'street_one'=>'nullable|string|min:3|max:192',
            'house_one'=>'nullable|string|min:1|max:10',
            'country_two'=>'required|numeric',
            'region_two'=>'required|numeric',
            'city_two'=>'required|numeric',
            'street_two'=>'nullable|string|min:3|max:192',
            'house_two'=>'nullable|string|min:1|max:15',
            'price_per_km'=>'required|numeric',
            'internal_width'=>'nullable|numeric',
            'internal_height'=>'nullable|numeric',
            'internal_length'=>'nullable|numeric',
            'capacity'=>'nullable|numeric',
            'weight'=>'nullable|integer',
            'description'=>'nullable|string|max:2000',
            'photo.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'date_finish'=>'required|date|date_format:Y-m-d|after:today',
        ];
    }
}
