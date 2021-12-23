<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ClinicRequest;
use App\Http\Resources\Doctor\ClinicResource;
use App\Models\Clinic;
use App\Models\Doctor;
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

class CertificationController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    //Can Be Used In Add And Update
    public function addCertifications(Request $request)
    {
        try {
            $doctor = Doctor::whereId(Auth::guard('api-doctor')->id())->first();
            if( $request->certification_image){
                foreach ($request->certification_image as $image) {
                    $img = $this->uploadImages($image, "images/doctor/certification");
                    $doctor->certifications()->create(["image" => 'public/'.$img]);
                }
                return $this->responseJsonWithoutData();
            }else{
                return $this->responseJsonFailed('404','Certification Image is required');
            }
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }




}
