<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Requests\Api\Doctor\HomeConculationRequest;
use App\Http\Requests\Api\Doctor\HomeConculationWorkingTimesRequest;
use App\Http\Requests\Api\Doctor\UpdateHomeConculationRequest;
use App\Http\Resources\Doctor\HomeConculationResource;
use App\Models\Doctor;
use App\Models\HomeConcultation;
use App\Models\HomeConcultationWorkingTime;
use App\Models\OnlineConcultationWorkingTime;
use Laravel\Passport\HasApiTokens;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeConcultationController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    public function getHomeConcultation(Request $request)
    {
        // try {
            // $HomeConcultation = HomeConcultation::where('doctor_id', Auth::user()->id)->get();
            // return $this->responseJson(200, "Doctor Home Concultation", HomeConculationResource::collection($HomeConcultation));
            $HomeConcultation = HomeConcultation::where('doctor_id', Auth::user()->id)->first();

            return $this->responseJson(200, "Doctor Home Concultation", new HomeConculationResource($HomeConcultation));
        // } catch (Throwable $e) {
            // return $this->responseJsonFailed();
        // }
    }

    public function addHomeConcultation(HomeConculationRequest $request)
    {
        try {
            $home = HomeConcultation::create([
                "doctor_id" => Auth::user()->id,
                "price" => $request->price,
                "renewal_price" => $request->renewal_price,
                "payment_method" => $request->payment_method,
            ]);
            return $this->responseJson(200, "Addning New Home Concultation Successfully", new HomeConculationResource($home));
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }

    public function updateHomeConcultation(UpdateHomeConculationRequest $request)
    {
        try {
            $home = HomeConcultation::where('id', $request->home_concultation_id)->first();

            if($home->doctor_id != Auth::user()->id){
                return $this->responseValidationJsonFailed('HomeConcultation not belongs to this doctor');
            }else{
                $home->update($request->all());

                return $this->responseJson(200, "Updating HomeConcultation Successfully", new HomeConculationResource($home));
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }

    public function deleteHomeConcultation(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "home_concultation_id" => "required|exists:home_concultations,id",
            ]);
            if ($validator->fails()) {
                return $this->responseValidationJsonFailed('HomeConcultation is incorrect or required');
            }

            $home = HomeConcultation::where('id', $request->home_concultation_id)->first();
            if($home->doctor_id != Auth::user()->id){
                return $this->responseValidationJsonFailed('HomeConcultation not belongs to this doctor');
            }else{
                $home->workingTimes()->delete();
                $home->delete();

                return $this->responseJsonWithoutData();
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }


    public function getHomeWorkTime(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'home_id' => 'required|exists:home_concultations,id',
            ]);
            if ($validator->fails()) {
                return $this->responseValidationJsonFailed('home_id is incorrect or required');
            }

            $home = HomeConcultation::where(['id'=> $request->home_id ,'doctor_id' => Auth::user()->id])->first();
            if(!$home){
                $this->responseJsonFailed(422, "this doctor can't control on this home concultation");
            }

            $worktime_days = [];
            for($x=0 ; $x<7 ; $x++){
                $workingTime = HomeConcultationWorkingTime::where(['home_concultation_id' => $request->home_id , 'day' => $x])->get(['id','from','to']);
                $from = HomeConcultationWorkingTime::where(['home_concultation_id' => $request->home_id , 'day' => $x])->min('from');
                $to = HomeConcultationWorkingTime::where(['home_concultation_id' => $request->home_id , 'day' => $x])->max('to');
                if ($workingTime->count() == 0 ) continue;
                foreach($workingTime as $single){
                    $single->from = \Carbon\Carbon::createFromTimeStamp(strtotime($single->from))->format('H:i');
                    $single->to = \Carbon\Carbon::createFromTimeStamp(strtotime($single->to))->format('H:i');
                }
                $work = (object)[
                    "day" => $x ,
                    "booking_type" => '2',
                    "type_id" => $request->home_id,
                    "from" => \Carbon\Carbon::createFromTimeStamp(strtotime($from))->format('H:i'),
                    "to" => \Carbon\Carbon::createFromTimeStamp(strtotime($to))->format('H:i'),
                    "count" =>  $workingTime->count(),
                    "shifts" => $workingTime,
                ];
                $worktime_days[] = $work;
            }

            $data = (object) [
                "home_id" => $home->id,
                "worktime_days" => $worktime_days
            ];
            return $this->responseJson(200, "home concultation WorkingTimes", $worktime_days);

        }catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }


    ###############################################################################################################
    #################################### Home Concultation Working Times ##########################################
    ###############################################################################################################
    // public function getHomeFreeTimes(Request $request)
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

    //                     $space = intval($totalDuration / 60) ;
    //                     for ($j=0 ; $j< $space; $j++){
    //                         $t = ((object)['from' => $startTime->format('G:i'), 'to' => $startTime->addMinutes(60)->format('G:i')]);
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

    //                     $space = intval($totalDuration / 60) ;
    //                     for ($j=0 ; $j< $space; $j++){
    //                         $t = ((object)['from' => $startTime->format('G:i'), 'to' => $startTime->addMinutes(60)->format('G:i')]);
    //                         $freeTimes[] = $t;
    //                     }
    //                 }
    //             }
    //         }

    //         foreach( $freeTimes as $key => $freeTime )
    //         {
    //             $check_from = OnlineConcultationWorkingTime::where('day', $day)
    //                                         ->where('from', '<=', $freeTime->from)
    //                                         ->where('to', '>', $freeTime->from)
    //                                         ->get();
    //             if($check_from->count() > 0){
    //                 unset($freeTimes[$key]);
    //             }
    //             else{
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
    //                                         ->where('to', '>', $freeTime->from)
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

    //         return $this->responseJson(200, "Home Avalible Time", $freeTimes);
    //     } catch (Throwable $e) {
    //         return $this->responseJsonFailed();
    //     }
    // }



    // public function addHomeWorkingTime(HomeConculationWorkingTimesRequest $request)
    // {
    //     $day = $request->day;
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

    //                     $space = intval($totalDuration / 60) ;
    //                     for ($j=0 ; $j< $space; $j++){
    //                         $t = ((object)['from' => $startTime->format('G:i'), 'to' => $startTime->addMinutes(60)->format('G:i')]);
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

    //                     $space = intval($totalDuration / 60) ;
    //                     for ($j=0 ; $j< $space; $j++){
    //                         $t = ((object)['from' => $startTime->format('G:i'), 'to' => $startTime->addMinutes(60)->format('G:i')]);
    //                         $freeTimes[] = $t;
    //                     }
    //                 }
    //             }
    //         }

    //         foreach( $freeTimes as $key => $freeTime )
    //         {
    //             $check_from = OnlineConcultationWorkingTime::where('day', $day)
    //                                         ->where('from', '<=', $freeTime->from)
    //                                         ->where('to', '>', $freeTime->from)
    //                                         ->get();
    //             if($check_from->count() > 0){
    //                 unset($freeTimes[$key]);
    //             }
    //             else{
    //                 $check_to = OnlineConcultationWorkingTime::where('day', $day)
    //                                                         ->where('from', '<=', $freeTime->to)
    //                                                         ->where('to', '>=', $freeTime->to)
    //                                                         ->get();
    //                 if($check_to->count() > 0){
    //                     unset($freeTimes[$key]);
    //                 }
    //             }
    //         }

    //         foreach( $freeTimes as $key => $freeTime )
    //         {
    //             $check_from = HomeConcultationWorkingTime::where('day', $day)
    //                                                     ->where('from', '<=', $freeTime->from)
    //                                                     ->where('to', '>', $freeTime->from)
    //                                                     ->get();
    //             if($check_from->count() > 0){
    //                 unset($freeTimes[$key]);
    //             }else{
    //                 $check_to = HomeConcultationWorkingTime::where('day', $day)
    //                                                         ->where('from', '<=', $freeTime->to)
    //                                                         ->where('to', '>=', $freeTime->to)
    //                                                         ->get();
    //                 if($check_to->count() > 0){
    //                     unset($freeTimes[$key]);
    //                 }
    //             }
    //         }

    //         ///////////////////////////////////////////////////////////////////////////
    //         //Add Home working Time
    //         $saved = 0;
    //         foreach( $freeTimes as $key => $freeTime )
    //         {
    //             if( ($request->from <= $freeTime->from) && ($request->to > $freeTime->from) ){
    //                 $saved = 1;
    //                 unset($freeTimes[$key]);
    //             }
    //         }
    //         if($saved == 1){
    //             $home = HomeConcultationWorkingTime::create([
    //                 "day" => $day,
    //                 "from" => $request->from,
    //                 "to" => $request->to,
    //                 "home_concultation_id" => $request->home_concultation_id,
    //             ]);
    //             return $this->responseJson(200, "Home Concultation Working Time Created Successfully", $home);
    //         }else{
    //             return $this->responseJsonFailed(422, 'Check input data and try again');
    //         }

    //     } catch (Throwable $e) {
    //         return $this->responseJsonFailed();
    //     }
    // }


}
