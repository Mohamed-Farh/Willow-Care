<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SpecialityRequest extends FormRequest
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
                    'icon'=> ['nullable','file','mimes:jpeg,png,jpg,gif,svg|max:2048'],
                    'category'=>'required|min:1',
                    "category.*"  => "required|distinct|min:1",
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name_ar' => 'required|max:255|string|regex:/^[\s\p{Arabic}]+$/u',
                    'name_en' => 'required|max:255|string|regex:/^[\pL\s]+$/u',
                    'name_ro' => ['required', 'max:255','string'],
                    'icon'=> ['nullable','file','mimes:jpeg,png,jpg,gif,svg|max:2048'],
                    'active'=>'nullable',
                    'category'=>'required|min:1',
                    "category.*"  => "required|distinct|min:1",

                ];
            }
            default: break;
        }
    }
}
