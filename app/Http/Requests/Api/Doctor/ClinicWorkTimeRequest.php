<?php

namespace App\Http\Requests\Api\Doctor;

use App\Traits\ApiTraits;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

class ClinicWorkTimeRequest extends FormRequest
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
            "clinic_id" => "required|exists:clinics,id" ,
            "static_worktime" => "required|in:0,1",
            "days" => "array|required|min:1|in:0,1,2,3,4,5,6",
            "from" => "required|date_format:H:i",
            "to" => "required|date_format:H:i|after:from",
            "setions_times_from" => "array|required",
            "setions_times_to" => "array|required",
        ];
    }

    public function failedValidation(Validator $validator){
        throw new ValidationException($validator, $this->returnValidationError($validator));
    }
}
