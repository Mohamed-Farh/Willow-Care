<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TermsRequest extends FormRequest
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
                    'text_ar' => 'required|max:1000|string|regex:/^[\s\p{Arabic}]+$/u',
                    'text_en' => 'required|max:1000|string|regex:/^[\pL\s]+$/u',
                    'text_ro' => ['required', 'max:1000','string'],
                    'active'=>'nullable',
                    'category'=>'required|exists:categories,id'

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'text_ar' => 'required|max:1000|string|regex:/^[\s\p{Arabic}]+$/u',
                    'text_en' => 'required|max:1000|string|regex:/^[\pL\s]+$/u',
                    'active'=>'nullable',
                    'text_ro' => ['required', 'max:1000','string'],
                    'category'=>'required|exists:categories,id'


                ];
            }
            default: break;
        }
    }
}
