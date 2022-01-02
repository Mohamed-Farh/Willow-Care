<?php

namespace App\Http\Requests\Api\Doctor;

use App\Traits\ApiTraits;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UpdateClinicRequest extends FormRequest
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
            "clinic_id" => "required|exists:clinics,id",
            "name" => "nullable",
            "phone" => "nullable",
            "another_phone" => "nullable",
            "lat" => "nullable|numeric",
            "long" => "nullable|numeric",
            "location" => "nullable",
            "concultation_price" => "nullable",
            "renewal_price" => "nullable",
            "duration" => "nullable",
            "payment_method" => "nullable|in:1,2,3",
            "clinic_image" => "nullable|file|mimes:png,jpg,svg,gif",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $this->validator->errors();
        $er = implode(' |+| ', $errors->all());
        throw new HttpResponseException(
            $this->responseValidationJsonFailed($er)
        );
    }
}
