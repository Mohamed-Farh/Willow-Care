<?php

namespace App\Http\Requests\Api\Doctor;

use App\Traits\ApiTraits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class HomeConculationWorkingTimesRequest extends FormRequest
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
            "day" => "required|in:0,1,2,3,4,5,6",
            "from" => "required|date_format:H:i",
            "to" => "required",
            "home_concultation_id" => "required|exists:home_concultations,id"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $this->validator->errors();
        $er = implode(' |+| ', $errors->all());
        throw new HttpResponseException(
            $this->responseJsonFailed(422 ,$er)
        );
    }
}