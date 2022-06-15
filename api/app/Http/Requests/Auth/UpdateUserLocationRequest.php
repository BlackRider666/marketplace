<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'country_id'    =>  'required|int|exists:countries,id',
            'region_id'     =>  'required|int|exists:regions,id',
            'city_id'       =>  'required|int|exists:cities,id',
            'address'       =>  'required|string',
        ];
    }
}
