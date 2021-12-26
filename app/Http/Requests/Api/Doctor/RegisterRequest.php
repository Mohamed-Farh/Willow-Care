<?php

namespace App\Http\Requests\Api\Doctor;

use App\Traits\ApiTraits;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

class RegisterRequest extends FormRequest
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
            "name" => "required",
            "phone" => "required|unique:doctors,phone",
            "email" => "required|email|unique:doctors,email",
            "password" => "required|min:8",
            "country_id" => "required|exists:countries,id",
            "lang" => "nullable|in:ro,en,ar",
            "device_token" => "required",
         ];
    }

    public function failedValidation(Validator $validator){
        throw new ValidationException($validator, $this->returnValidationError($validator));
    }
}
