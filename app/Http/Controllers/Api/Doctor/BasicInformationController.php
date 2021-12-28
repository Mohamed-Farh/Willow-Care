<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\UpdateProfileRequest;
use App\Http\Resources\Doctor\Profile\BasicInformationResource;
use App\Http\Resources\Doctor\Profile\ProfessionalTitleResource;
use App\Http\Resources\Doctor\Profile\ProfileSpecialtyResource;
use App\Models\Doctor;
use App\Models\ProfessionalTitle;
use App\Models\Specialty;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Throwable;
use Illuminate\Support\Facades\Auth;

class BasicInformationController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    //get all Specialties belongs to auth doctor
    public function getMySpecialties(Request $request)
    {
        try {
            $specialties = Specialty::whereActive(1)->get();
            return $this->responseJson(200 , "data", ProfileSpecialtyResource::collection($specialties));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }


    //get all Professional Titles In Database
    public function getProfessionalTitles(Request $request)
    {
        try {
            $titles = ProfessionalTitle::whereActive(1)->get();
            return $this->responseJson(200 , "data", ProfessionalTitleResource::collection($titles));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }


    public function updateDoctorProfile(UpdateProfileRequest $request)
    {
        try {
            $doctor = Doctor::whereId(Auth::guard('api-doctor')->id())->first();

            //update specialty
            $doctor->specialties()->syncWithoutDetaching($request->specialty_id);

            //update Doctor Information
            $doctor->update($request->all());
            $doctor->refresh();

            //Insert Licensce For Doctor
            foreach ($request->license as $image) {
                $img = $this->uploadImages($image, "images/doctor/license");
                $doctor->licenses()->create(["image" => 'public/'.$img]);
            }

            return $this->responseJson(200 , "data", new BasicInformationResource($doctor));

        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

}