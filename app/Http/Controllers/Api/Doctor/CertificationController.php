<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Doctor\CertificationResource;
use App\Models\Certification;
use App\Models\Doctor;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CertificationController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    //get all certifiaction belongs to auth doctor
    public function getMyCertifications(Request $request)
    {
        try {
            $certificates = Certification::whereDoctorId(Auth::guard('api-doctor')->id())->whereActive(1)->get();

            return $this->responseJson(200 , "data", CertificationResource::collection($certificates));

        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }


    //Can Be Used In Add And Update
    public function addCertifications(Request $request)
    {
        try {
            $doctor = Doctor::whereId(Auth::guard('api-doctor')->id())->first();
            if( $request->certification_image){
                foreach ($request->certification_image as $image) {
                    $img = $this->uploadImages($image, "images/doctor/certification");
                    $doctor->certifications()->create(["image" => $img]);
                }
                return $this->responseJsonWithoutData();
            }else{
                return $this->responseValidationJsonFailed('Certification Image is required');
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }


    //Can Be Used In Add And Update
    public function deleteCertifications(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'certification_id' => 'required|exists:certifications,id',
            ]);
            if ($validator->fails()) {
                return $this->responseValidationJsonFailed('certification_id is incorrect or required');
            }

            if( $request->certification_id){
                foreach ($request->certification_id as $id) {
                    $certificate = Certification::whereDoctorId(Auth::guard('api-doctor')->id())
                                                ->whereId($id)
                                                ->whereActive(1)
                                                ->first();

                    if($certificate->image != null && File::exists($certificate->image)){
                        $old_file = $certificate->image; //get old photo
                        unlink($old_file);  //To Check If I'm On Locallhost
                    }elseif($certificate->image != null && File::exists('../'.$certificate->image)){
                        $old_file = $certificate->image; //get old photo
                        unlink('../'.$old_file);  //To Check If I'm On Server
                    }
                    $certificate->delete();
                }
                return $this->responseJsonWithoutData();
            }else{
                return $this->responseValidationJsonFailed('certification id is required');
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }




}
