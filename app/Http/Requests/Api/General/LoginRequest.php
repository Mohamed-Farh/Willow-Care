<?php

namespace App\Http\Requests\Api\General;

use App\Traits\ApiTraits;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

class LoginRequest extends FormRequest
{
    use ApiTraits;
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
            "phone" => "required|exists:doctors,phone",
            "password" => "required|min:8",
            "app_type" => "required",
            "device_token" => "required",
        ];
    }

    public function failedValidation(Validator $validator){
        throw new ValidationException($validator, $this->returnValidationError($validator));
    }
}

