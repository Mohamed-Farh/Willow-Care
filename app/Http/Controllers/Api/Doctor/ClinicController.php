<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ClinicRequest;
use App\Http\Resources\Doctor\ClinicResource;
use App\Models\Clinic;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Throwable;
use App\Models\Specialty;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClinicController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    public function addClinic(ClinicRequest $request)
    {
        try {
            $img = $this->uploadImages($request->clinic_image, "images/doctor/clinic");
            $clinic = Clinic::create([
                "name" => $request->name,
                "phone" => $request->phone,
                "another_phone" => $request->another_phone,
                "lat" => $request->lat,
                "long" => $request->long,
                "location" => $request->location,
                "price" => $request->concultation_price,
                "renewal_price" => $request->renewal_price,
                "duration" => $request->duration,
                "payment_method" => $request->payment_method,
                "image" => 'public/'.$img,
                "doctor_id" => Auth::guard('api-doctor')->id(),
            ]);

            return $this->responseJson("200", "Addning New Clinic Successfully", new ClinicResource($clinic));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }




}
