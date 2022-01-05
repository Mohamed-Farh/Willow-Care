<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\LicenseRequest;
use App\Http\Resources\Doctor\LicenseResource;
use App\Models\Doctor;
use App\Models\License;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class LicenseController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    //Can Be Used In Add And Update
    public function addLicensesAndSpecialist(LicenseRequest $request)
    {
        try {
            $doctor = Doctor::whereId(Auth::guard('api-doctor')->id())->first();
            foreach ($request->license_image as $image) {
                $img = $this->uploadImages($image, "images/doctor/license");
                $doctor->licenses()->create(["image" => $image]);
            }
            $doctor->specialties()->syncWithoutDetaching($request->specialty_id);
            return $this->responseJsonWithoutData();
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }


    public function getLicenses()
    {
        try {
            $doctor = Doctor::whereId(Auth::guard('api-doctor')->id())->first();
            $licenses = $doctor->licenses;
            return $this->responseJson(200 , "All Doctor Licenses", LicenseResource::collection($licenses));
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }

    //Delete License belongs to auth doctor
    public function deleteLicense(Request $request)
    {
        try {
            // return 0;
            $license = License::whereId($request->license_id)->where('doctor_id', Auth::guard('api-doctor')->id())->first();
            // return $license;
            if($license == ''){
                return $this->responseJsonFailed(422, 'Check input data and try again');
            }else{
                if($license->image != null && File::exists($license->image)){
                    $old_file = $license->image; //get old photo
                    unlink($old_file);  //To Check If I'm On Locallhost
                }elseif($license->image != null && File::exists('../'.$license->image)){
                    $old_file = $license->image; //get old photo
                    unlink('../'.$old_file);  //To Check If I'm On Server
                }

                $license->delete();
                return $this->responseJsonWithoutData();
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }

}
