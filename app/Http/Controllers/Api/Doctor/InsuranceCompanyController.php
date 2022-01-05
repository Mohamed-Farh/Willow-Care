<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\InsuranceCompanyRequest;
use App\Http\Requests\Api\Doctor\UpdateProfileRequest;
use App\Http\Resources\Doctor\Profile\ProfessionalTitleResource;
use App\Http\Resources\Doctor\Profile\ProfileInsuranceCompaniesResource;
use App\Http\Resources\Doctor\Profile\ProfileResource;
use App\Http\Resources\Doctor\Profile\ProfileSpecialtyResource;
use App\Models\Certification;
use App\Models\Doctor;
use App\Models\InsuranceCompany;
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

class InsuranceCompanyController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    //get all Insurance Companies belongs to auth doctor
    public function getAllInsuranceCompanies(Request $request)
    {
        try {
            $companies = InsuranceCompany::whereActive(1)->get();
            return $this->responseJson(200 , "All Insurance Companies", ProfileInsuranceCompaniesResource::collection($companies));
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }

    //get My Insurance Companies belongs to auth doctor
    public function getDoctorInsuranceCompanies(Request $request)
    {
        try {
            $doctor = Doctor::whereId(Auth::guard('api-doctor')->id())->first();
            $companies = $doctor->insuranceCompanies;
            return $this->responseJson(200 , "All Doctor Insurance Companies", ProfileInsuranceCompaniesResource::collection($companies));
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }


    //Add And Update Insurance Companies belongs to auth doctor
    public function addUpdateDoctorInsuranceCompanies(InsuranceCompanyRequest $request)
    {
        try {
            $doctor = Doctor::whereId(Auth::guard('api-doctor')->id())->first();
            $doctor->insuranceCompanies()->syncWithoutDetaching($request->insurance_company_id);

            $companies = $doctor->insuranceCompanies;
            return $this->responseJson(200 , "Insurance Companies Added OR Updated Successfully", ProfileInsuranceCompaniesResource::collection($companies));

        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }

    //Delete Insurance Companies belongs to auth doctor
    public function deleteDoctorInsuranceCompanies(InsuranceCompanyRequest $request)
    {
        try {
            $doctor = Doctor::whereId(Auth::guard('api-doctor')->id())->first();
            $doctor->insuranceCompanies()->detach($request->insurance_company_id);
            return $this->responseJsonWithoutData();
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }




}
