<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ClinicRequest;
use App\Http\Requests\Api\Doctor\ClinicWorkTimeRequest;
use App\Http\Resources\Doctor\ClinicResource;
use App\Models\Clinic;
use Laravel\Passport\HasApiTokens;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    public function addClinic(ClinicRequest $request)
    {
        return $request->all();
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
            return $this->responseJson(200, "Addning New Clinic Successfully", new ClinicResource($clinic));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }


    // ClinicWorkTimeRequest
    public function addClinicWorkTime(ClinicWorkTimeRequest $request){
        // return $request->all();
        // return $request->all_days[0]['day'];
        // return $request->all_days[0]['setions_times'][0]['from'];
        $clinic = Clinic::where(['id'=> $request->clinic_id ,'doctor_id' => Auth::user()->id])->first();
        if(!$clinic){
            $this->responseJsonFailed(404, "this doctor can't control on this clinic");
        }
        $doctor_clinics = Clinic::where('doctor_id' , Auth::user()->id)->where('id', '!=' ,$request->clinic_id)->get();
        // return $doctor_clinics ;
        if($doctor_clinics->isEmpty()){
            $old_workouts = $clinic->workingTimes()->get();
            foreach($old_workouts as $workout){
                $workout->shifts()->delete();
            }   
            $clinic->workingTimes()->delete();
            foreach( $request->all_days as $single_day){
                $sigle_work_out = $clinic->workingTimes()->create([
                    'day' => $single_day['day'],
                    'from' => $single_day['from'],
                    'to' => $single_day['to']
                ]);
                $len = count($single_day['setions_times']);
                for($i= 0; $i < $len; $i++){
                    $sigle_work_out->shifts()->create([
                        'from'=> $single_day['setions_times'][$i]['from'],
                        'to' => $single_day['setions_times'][$i]['to'],
                    ]);
                }
            }
            $clinic->setting = $request->same_day;
            $clinic->save();
            return $this->responseJsonWithoutData();
        }else{
            return 'comming soon';
        }
        // return $request->all();
    }



}
