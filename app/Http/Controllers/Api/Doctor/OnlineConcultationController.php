<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ClinicRequest;
use App\Http\Requests\Api\Doctor\ClinicWorkTimeRequest;
use App\Http\Requests\Api\Doctor\HomeConculationRequest;
use App\Http\Requests\Api\Doctor\OnlineConculationRequest;
use App\Http\Requests\Api\Doctor\UpdateOnlineConculationRequest;
use App\Http\Resources\Doctor\ClinicResource;
use App\Http\Resources\Doctor\HomeConculationResource;
use App\Http\Resources\Doctor\OnlineConculationResource;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\HomeConcultation;
use App\Models\HomeConcultationWorkingTime;
use App\Models\OnlineConcultation;
use App\Models\OnlineConcultationWorkingTime;
use Laravel\Passport\HasApiTokens;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OnlineConcultationController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;


    public function getOnlineConcultation(Request $request)
    {
        try {
            $OlineConcultation = OnlineConcultation::where('doctor_id', Auth::user()->id)->get();
            return $this->responseJson(200, "Doctor Online Concultation", OnlineConculationResource::collection($OlineConcultation));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    public function addOnlineConcultation(OnlineConculationRequest $request)
    {
        try {
            $online = OnlineConcultation::create([
                "doctor_id" => Auth::user()->id,
                "price" => $request->price,
                "renewal_price" => $request->renewal_price,
            ]);
            return $this->responseJson(200, "Addning New Online Concultation Successfully", new OnlineConculationResource($online));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    public function updateOnlineConcultation(UpdateOnlineConculationRequest $request)
    {
        try {
            $online = OnlineConcultation::where('id', $request->online_concultation_id)->first();

            if($online->doctor_id != Auth::user()->id){
                return $this->responseValidationJsonFailed('OnlineConcultation not belongs to this doctor');
            }else{
                $online->update($request->all());
                return $this->responseJson(200, "Updating OnlineConcultation Successfully", new OnlineConculationResource($online));
            }
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    public function deleteOnlineConcultation(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "online_concultation_id" => "required|exists:online_concultations,id",
            ]);
            if ($validator->fails()) {
                return $this->responseValidationJsonFailed('OnlineConcultation is incorrect or required');
            }

            $online = OnlineConcultation::where('id', $request->online_concultation_id)->first();
            if($online->doctor_id != Auth::user()->id){
                return $this->responseValidationJsonFailed('OnlineConcultation not belongs to this doctor');
            }else{
                $online->workingTimes()->delete();
                $online->delete();

                return $this->responseJsonWithoutData();
            }
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    public function getOnlineWorkTime(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'online_id' => 'required|exists:online_concultations,id',
            ]);
            if ($validator->fails()) {
                return $this->responseValidationJsonFailed('online_id is incorrect or required');
            }

            $online = OnlineConcultation::where(['id'=> $request->online_id ,'doctor_id' => Auth::user()->id])->first();
            if(!$online){
                $this->responseJsonFailed(422, "this doctor can't control on this online concultation");
            }
            
            $worktime_days = [];
            for($x=0 ; $x<7 ; $x++){
                $workingTime = OnlineConcultationWorkingTime::where(['online_concultation_id' => $request->online_id , 'day' => $x])->get(['id','from','to']);
                $from = OnlineConcultationWorkingTime::where(['online_concultation_id' => $request->online_id , 'day' => $x])->min('from');
                $to = OnlineConcultationWorkingTime::where(['online_concultation_id' => $request->online_id , 'day' => $x])->max('to');
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
                "online_id" => $online->id,
                "worktime_days" => $worktime_days
            ];
            return $this->responseJson(200, "Online concultation WorkingTimes", $worktime_days);

        }catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }


    ###############################################################################################################
    #################################### Online Concultation Working Times ##########################################
    ###############################################################################################################

    // public function getOnlineFreeTimes(Request $request)
    // {
    //     $day = $request->header('day');
    //     try {
    //         $freeTimes = [];
    //         $doctor = Doctor::whereId(Auth::user()->id)->first();
    //         $clinics = $doctor->clinics;

    //         foreach( $clinics as $clinic)
    //         {
    //             $workingTimes =  $clinic->workingTimes()->where('day', $day)->get();

    //             foreach( $workingTimes as $workingTime)
    //             {
    //                 $shifts = $workingTime->shifts;
    //                 if($workingTime->from != $shifts[0]->from){
    //                     $startTime  = Carbon::parse($workingTime->from);
    //                     $finishTime = Carbon::parse($shifts[0]->from);
    //                     $totalDuration = $finishTime->diffInMinutes($startTime);

    //                     $space = intval($totalDuration / 30) ;
    //                     for ($j=0 ; $j< $space; $j++){
    //                         $t = ((object)['from' => $startTime->format('G:i'), 'to' => $startTime->addMinutes(30)->format('G:i')]);
    //                         $freeTimes[] = $t;
    //                     }
    //                 }

    //                 for($i=0; $i<$shifts->count(); $i++)
    //                 {
    //                     $startTime  = Carbon::parse($shifts[$i]->to);
    //                     try{
    //                         $finishTime = Carbon::parse($shifts[$i+1]->from);
    //                     } catch (Throwable $e) {
    //                         $finishTime = Carbon::parse($workingTime->to);
    //                     }

    //                     $totalDuration = $finishTime->diffInMinutes($startTime);

    //                     $space = intval($totalDuration / 30) ;
    //                     for ($j=0 ; $j< $space; $j++){
    //                         $t = ((object)['from' => $startTime->format('G:i'), 'to' => $startTime->addMinutes(30)->format('G:i')]);
    //                         $freeTimes[] = $t;
    //                     }
    //                 }
    //             }
    //         }

    //         foreach( $freeTimes as $key => $freeTime )
    //         {

    //             $check_from = OnlineConcultationWorkingTime::where('day', $day)
    //                                         ->where('from', '<=', $freeTime->from)
    //                                         ->where('to', '>=', $freeTime->from)
    //                                         ->get();
    //             if($check_from->count() > 0){
    //                 unset($freeTimes[$key]);
    //             }else{
    //                 $check_to = OnlineConcultationWorkingTime::where('day', $day)
    //                 ->where('from', '<=', $freeTime->to)
    //                 ->where('to', '>=', $freeTime->to)
    //                 ->get();
    //                 if($check_to->count() > 0){
    //                     unset($freeTimes[$key]);
    //                 }
    //             }
    //         }

    //         foreach( $freeTimes as $key => $freeTime )
    //         {
    //             $check_from = HomeConcultationWorkingTime::where('day', $day)
    //                                         ->where('from', '<=', $freeTime->from)
    //                                         ->where('to', '>=', $freeTime->from)
    //                                         ->get();
    //             if($check_from->count() > 0){
    //                 unset($freeTimes[$key]);
    //             }else{
    //                 $check_to = HomeConcultationWorkingTime::where('day', $day)
    //                 ->where('from', '<=', $freeTime->to)
    //                 ->where('to', '>=', $freeTime->to)
    //                 ->get();
    //                 if($check_to->count() > 0){
    //                     unset($freeTimes[$key]);
    //                 }
    //             }
    //         }
    //         //return $freeTimes;
    //         return $this->responseJson(200, "Online Avalible Time", $freeTimes);
    //     } catch (Throwable $e) {
    //         $this->responseJsonFailed();
    //     }
    // }


}
