<?php

namespace App\Http\Requests\Api\Doctor;

use App\Traits\ApiTraits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateHomeConculationRequest extends FormRequest
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
            "home_concultation_id" => "required",
            "price" => "nullable",
            "renewal_price" => "nullable",
            "payment_method" => "nullable|in:1,2,3",
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
