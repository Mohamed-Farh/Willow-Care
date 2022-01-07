<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceCompanyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name_ar' => 'required|max:255|string|regex:/^[\s\p{Arabic}]+$/u',
                    'name_en' => 'required|max:255|string|regex:/^[\pL\s]+$/u',
                    'name_ro' => ['required', 'max:255','string'],
                    'active'=>'nullable',
                    'image'=> ['nullable','file','mimes:jpeg,png,jpg,gif,svg|max:2048'],
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name_ar' => 'required|max:255|string|regex:/^[\s\p{Arabic}]+$/u',
                    'name_en' => 'required|max:255|string|regex:/^[\pL\s]+$/u',
                    'name_ro' => ['required', 'max:255','string'],
                    'image'=> ['nullable','file','mimes:jpeg,png,jpg,gif,svg|max:2048'],
                    'active'=>'nullable',

                ];
            }
            default: break;
        }
    }
}
