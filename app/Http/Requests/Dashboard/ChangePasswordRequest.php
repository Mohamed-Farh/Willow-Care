<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\ChangeAdminPassword;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        return [
            'password' => ['required', new ChangeAdminPassword],
            'new_password' => ['required','min:5'],
            'new_password_confirmation' => ['same:new_password'],
        ];
    }
}
