<?php

namespace App\Http\Requests\Api\Doctor;

use App\Traits\ApiTraits;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

class ClinicRequest extends FormRequest
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
            "phone" => "required",
            "another_phone" => "nullable",
            "lat" => "required|numeric",
            "long" => "required|numeric",
            "location" => "required",
            "concultation_price" => "required",
            "renewal_price" => "required",
            "duration" => "required",
            "payment_method" => "nullable|in:0,1,2",
            "clinic_image" => "required|file|mimes:png,jpg,svg,gif",

        ];
    }

    public function failedValidation(Validator $validator){
        throw new ValidationException($validator, $this->returnValidationError($validator));
    }
}