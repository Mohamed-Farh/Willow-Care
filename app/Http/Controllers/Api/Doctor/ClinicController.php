<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ClinicRequest;
use App\Http\Requests\Api\Doctor\ClinicWorkTimeRequest;
use App\Http\Requests\Api\Doctor\UpdateClinicRequest;
use App\Http\Resources\Doctor\ClinicResource;
use App\Http\Resources\Doctor\ClinicWorkingTimeResource;
use App\Models\Clinic;
use App\Models\WorkingTime;
use Laravel\Passport\HasApiTokens;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ClinicController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;



    public function getClinic(Request $request)
    {
        try {
            $clinics = Clinic::where('doctor_id', Auth::user()->id)->get();
            return $this->responseJson(200, "Doctor Clinics", ClinicResource::collection($clinics));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

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
                "image" => $img,
                "doctor_id" => Auth::user()->id,
            ]);
            return $this->responseJson(200, "Addning New Clinic Successfully", new ClinicResource($clinic));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    public function updateClinic(UpdateClinicRequest $request)
    {
        try {
            $clinic = Clinic::where('id', $request->clinic_id)->first();

            if($clinic->doctor_id != Auth::user()->id){
                return $this->responseValidationJsonFailed('Clinic not belongs to this doctor');
            }else{
                $clinic->update($request->all());
                if($request->clinic_image){
                    $img = $this->uploadImages($request->clinic_image, 'images/doctor/clinic');
                    if($clinic->image != null && File::exists($clinic->image)){
                        $old_file = $clinic->image; //get old photo
                        unlink($old_file);  //To Check If I'm On Locallhost
                    }elseif($clinic->image != null && File::exists('../'.$clinic->image)){
                        $old_file = $clinic->image; //get old photo
                        unlink('../'.$old_file);  //To Check If I'm On Server
                    }
                    $clinic->update(["image" => $img]);
                }
                return $this->responseJson(200, "Updating Clinic Successfully", new ClinicResource($clinic));
            }
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    public function deleteClinic(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "clinic_id" => "required|exists:clinics,id",
            ]);
            if ($validator->fails()) {
                return $this->responseValidationJsonFailed('Clinic is incorrect or required');
            }

            $clinic = Clinic::where('id', $request->clinic_id)->first();

            if($clinic->doctor_id != Auth::user()->id){
                return $this->responseValidationJsonFailed('Clinic not belongs to this doctor');
            }else{
                $workingTimes = WorkingTime::where('clinic_id', $request->clinic_id)->get();
                foreach($workingTimes as $workingTime){
                    $workingTime->shifts()->delete();
                    $workingTime->delete();
                }

                if($clinic->image != '')
                {
                    if($clinic->image != null && File::exists($clinic->image)){
                        $old_file = $clinic->image; //get old photo
                        unlink($old_file);  //To Check If I'm On Locallhost
                    }elseif($clinic->image != null && File::exists('../'.$clinic->image)){
                        $old_file = $clinic->image; //get old photo
                        unlink('../'.$old_file);  //To Check If I'm On Server
                    }
                    $clinic->delete();
                }
                return $this->responseJsonWithoutData();
            }
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    public function getSingleClinicWorkTime(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'clinic_id' => 'required|exists:clinics,id',
            ]);
            if ($validator->fails()) {
                return $this->responseValidationJsonFailed('clinic_id is incorrect or required');
            }

            $clinic = Clinic::where('id', $request->clinic_id)->where('doctor_id', Auth::user()->id)->first();

            if(empty($clinic)){
                return $this->responseJsonFailed(422, "this doctor can't control on this clinic");
            }

            $worktime_days = [];
            for($x=0 ; $x<7 ; $x++){
                $workingTime = WorkingTime::where(['clinic_id' => $request->clinic_id , 'day' => $x])->get(['from','to']);
                $from = WorkingTime::where(['clinic_id' => $request->clinic_id , 'day' => $x])->min('from');
                $to = WorkingTime::where(['clinic_id' => $request->clinic_id , 'day' => $x])->max('to');
                if ($workingTime->count() == 0 ) continue;
                $work = (object)[
                    "day" => $x ,
                    "from" => $from,
                    "to" => $to,
                    "count" =>  $workingTime->count(),
                    "shifts" => $workingTime,
                ];
                $worktime_days[] = $work;
            }

            $data = (object) [
                "clinic_name" => $clinic->name,
                "worktime_days" => $worktime_days
            ];
            // return $this->responseJson(200, "Clinic WorkingTimes", ClinicWorkingTimeResource::collection($workingTime));
            return $this->responseJson(200, "Clinic WorkingTimes", $worktime_days);

        }catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    ###############################################################################################################
    ######################################### Clinic  Working Times ###############################################
    ###############################################################################################################
    // ClinicWorkTimeRequest
    // public function addClinicWorkTime(ClinicWorkTimeRequest $request){
    //     // return $request->all();
    //     // return $request->all_days[0]['day'];
    //     // return $request->all_days[0]['setions_times'][0]['from'];
    //     $clinic = Clinic::where(['id'=> $request->clinic_id ,'doctor_id' => Auth::user()->id])->first();
    //     if(!$clinic){
    //         $this->responseJsonFailed(404, "this doctor can't control on this clinic");
    //     }
    //     $doctor_clinics = Clinic::where('doctor_id' , Auth::user()->id)->where('id', '!=' ,$request->clinic_id)->get();
    //     // return $doctor_clinics ;
    //     if($doctor_clinics->isEmpty()){
    //         $old_workouts = $clinic->workingTimes()->get();
    //         foreach($old_workouts as $workout){
    //             $workout->shifts()->delete();
    //         }
    //         $clinic->workingTimes()->delete();
    //         foreach( $request->all_days as $single_day){
    //             $sigle_work_out = $clinic->workingTimes()->create([
    //                 'day' => $single_day['day'],
    //                 'from' => $single_day['from'],
    //                 'to' => $single_day['to']
    //             ]);
    //             $len = count($single_day['setions_times']);
    //             for($i= 0; $i < $len; $i++){
    //                 $sigle_work_out->shifts()->create([
    //                     'from'=> $single_day['setions_times'][$i]['from'],
    //                     'to' => $single_day['setions_times'][$i]['to'],
    //                 ]);
    //             }
    //         }
    //         $clinic->setting = $request->same_day;
    //         $clinic->save();
    //         return $this->responseJsonWithoutData();
    //     }else{
    //         return 'comming soon';
    //     }
    //     // return $request->all();
    // }



    // public function addClinicWorkTime(ClinicWorkTimeRequest $request)
    // {
    //     try{
    //         $clinic = Clinic::where(['id'=> $request->clinic_id ,'doctor_id' => Auth::user()->id])->first();
    //         if(!$clinic){
    //             $this->responseJsonFailed(404, "this doctor can't control on this clinic");
    //         }
    //         $doctor_clinics = Clinic::where('doctor_id' , Auth::user()->id)->where('id', '!=', $request->clinic_id)->get();

    //         foreach( $request->all_days as $single_day){
    //             $is_in_database = WorkingTime::where('day', $single_day['day'])->first();

    //             if($is_in_database != ''){

    //                 $check_big = WorkingTime::where('day', $single_day['day'])
    //                                         ->where('from', '<=', $single_day['from'])
    //                                         ->where('to', '>', $single_day['from'])
    //                                         ->first();

    //                 $check_small = WorkingTime::where('day', $single_day['day'])
    //                                         ->where('from', '>', $single_day['from'])
    //                                         ->where('from', '<=', $single_day['to'])
    //                                         ->first();
    //                 if($check_big != ''){
    //                     $check_big->update([
    //                         'day' => $single_day['day'],
    //                         'from' => $single_day['from'],
    //                         'to' => $single_day['to']
    //                     ]);
    //                 }elseif($check_small != ''){
    //                     $check_small->update([
    //                         'day' => $single_day['day'],
    //                         'from' => $single_day['from'],
    //                         'to' => $single_day['to']
    //                     ]);
    //                 }else{
    //                     $sigle_work_out = $clinic->workingTimes()->create([
    //                         'day' => $single_day['day'],
    //                         'from' => $single_day['from'],
    //                         'to' => $single_day['to']
    //                     ]);
    //                 }

    //             }else{
    //                 $sigle_work_out = $clinic->workingTimes()->create([
    //                     'day' => $single_day['day'],
    //                     'from' => $single_day['from'],
    //                     'to' => $single_day['to']
    //                 ]);
    //             }
    //         }
    //         // $clinic->setting = $request->same_day;
    //         // $clinic->save();
    //         return $this->responseJsonWithoutData();

    //     }catch (Throwable $e) {
    //         $this->responseJsonFailed();
    //     }
    // }



}
