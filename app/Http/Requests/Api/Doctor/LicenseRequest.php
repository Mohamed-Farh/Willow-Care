<?php

namespace App\Http\Requests\Api\Doctor;

use App\Traits\ApiTraits;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

class LicenseRequest extends FormRequest
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
            "license_image" => 'array|required|min:1',
            "license_image*" => 'file',
            "specialty_id" => "array|required|exists:specialties,id",
        ];
    }

    public function failedValidation(Validator $validator){
        throw new ValidationException($validator, $this->returnValidationError($validator));
    }
}
