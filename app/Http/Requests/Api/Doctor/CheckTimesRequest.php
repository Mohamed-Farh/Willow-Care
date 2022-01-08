<?php

namespace App\Http\Requests\Api\Doctor;

use App\Traits\ApiTraits;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class CheckTimesRequest extends FormRequest
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
            "days" => "required|array|min:1",
            "from" => "nullable|date_format:H:i",
            "to" =>"nullable|date_format:H:i",
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
