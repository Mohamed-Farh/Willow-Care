<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\UpdateProfileRequest;
use App\Http\Resources\Doctor\Profile\ProfessionalTitleResource;
use App\Http\Resources\Doctor\Profile\ProfileResource;
use App\Http\Resources\Doctor\Profile\ProfileSpecialtyResource;
use App\Models\Certification;
use App\Models\Doctor;
use App\Models\ProfessionalTitle;
use App\Models\Specialty;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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
            $doctor = Doctor::where('id', Auth::guard('api-doctor')->id())->first();

            $doctor->update($request->all());
            $doctor->refresh();

            $doctor->specialties()->syncWithoutDetaching($request->specialty_id);

            foreach ($request->license as $image) {
                $img = $this->uploadImages($image, "images/doctor/license");
                $doctor->licenses()->create(["image" => 'public/'.$image]);
            }
            $doctor->specialties()->syncWithoutDetaching($request->specialty_id);

            return $this->responseJson(200 , "data", new ProfileResource($doctor));

        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }



}
