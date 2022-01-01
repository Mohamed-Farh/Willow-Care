<?php

namespace App\Http\Requests\Dashboard;

//use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
                    'name' => ['required', 'max:255'],
                    'email' => 'required|email|max:255|unique:admins',
                    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:admins',
                    'password'=>'required|min:5|confirmed',
                    'image'=> ['nullable','file','mimes:jpeg,png,jpg,gif,svg|max:2048'],
                    'active'=>'nullable'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
            return [
                      'name' => ['nullable', 'max:255'],
                      'email' => ['required', 'email', 'max:255', Rule::unique('admins')->ignore($this->admin)],
                       'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|',Rule::unique('admins')->ignore($this->admin),
                       'image'=> ['nullable','file','mimes:jpeg,png,jpg,gif,svg|max:2048'],


              ];
            }
            default: break;
        }
    }
}
