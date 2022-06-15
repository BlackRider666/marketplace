<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email,'.request()->user()->getKey(),
            'phone'         => 'required|string|max:255',
            'file'          =>  'nullable|sometimes|file',
            'company'           =>  'required|array',
            'company.code'      =>  'required|string|max:255',
            'company.site'      =>  'required|string|url',
            'company.contact_person'    =>  'required|string|max:255',
            'company.company_category_id'   =>  'required|int|exists:company_categories,id',
            'company.desc'                  =>  'required|string',
        ];
    }
}
