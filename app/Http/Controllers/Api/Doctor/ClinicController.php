<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ClinicRequest;
use App\Http\Requests\Api\Doctor\ClinicWorkTimeRequest;
use App\Http\Resources\Doctor\ClinicResource;
use App\Models\Clinic;
use App\Models\Doctor;
use Laravel\Passport\HasApiTokens;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Throwable;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\countOf;
use function PHPUnit\Framework\isEmpty;

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
                "doctor_id" => Auth::user()->id,
            ]);
            return $this->responseJson("200", "Addning New Clinic Successfully", new ClinicResource($clinic));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }


    public function addClinicWorkTime(ClinicWorkTimeRequest $request){
        $clinic = Clinic::where(['id'=> $request->clinic_id ,'doctor_id' => Auth::user()->id])->first();
        if(!$clinic){
            $this->responseJsonFailed("404", "this doctor can't control on this clinic");
        }
        $doctor_clinics = Clinic::where('doctor_id' , Auth::user()->id)->where('id', '!=' ,$request->clinic_id)->get();
        // return $doctor_clinics ;
        if($doctor_clinics->isEmpty()){
            $old_workouts = $clinic->workingTimes()->get();
            foreach($old_workouts as $workout){
                $workout->shifts()->delete();
            }   
            $clinic->workingTimes()->delete();
            foreach( $request->days as $day){
                $sigle_work_out = $clinic->workingTimes()->create([
                    'day' => $day,
                    'from' => $request->from,
                    'to' => $request->to
                ]);
                // return $request->setions_times_to[0];
                $len = count($request->setions_times_from);
                for($i= 0; $i < $len; $i++){
                    $sigle_work_out->shifts()->create([
                        'from'=> $request->setions_times_from[$i],
                        'to' => $request->setions_times_to[$i],
                    ]);
                }

            }
            $clinic->setting = $request->static_worktime;
            $clinic->save();
            return $this->responseJsonWithoutData();
        }else{
            return 'comming soon';
        }
        // return $request->all();
    }



}
