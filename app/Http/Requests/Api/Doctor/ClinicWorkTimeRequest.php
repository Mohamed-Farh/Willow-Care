<?php

namespace App\Http\Requests\Api\Doctor;

use App\Traits\ApiTraits;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            "same_day" => "required|in:0,1",
            "clinic_id" => "required|exists:clinics,id",
            "all_days" => "array|required|min:1",
            "all_days.*.day" => "required|min:1|in:0,1,2,3,4,5,6",
            "all_days.*.from" => "required|date_format:H:i",
            "all_days.*.to" => "required|date_format:H:i|after:all_days.*.from",
            "all_days.*.setions_times.*.from" => "required|date_format:H:i",
            "all_days.*.setions_times.*.to" =>"required|date_format:H:i|after:all_days.*.setions_times.*.from",
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
