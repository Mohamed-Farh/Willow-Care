<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ClinicRequest;
use App\Http\Requests\Api\Doctor\ClinicWorkTimeRequest;
use App\Http\Requests\Api\Doctor\HomeConculationRequest;
use App\Http\Requests\Api\Doctor\OnlineConculationRequest;
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

    public function getOnlineFreeTimes(Request $request)
    {
        $day = $request->header('day');
        try {
            $freeTimes = [];
            $doctor = Doctor::whereId(Auth::user()->id)->first();
            $clinics = $doctor->clinics;

            foreach( $clinics as $clinic)
            {
                $workingTimes =  $clinic->workingTimes()->where('day', $day)->get();

                foreach( $workingTimes as $workingTime)
                {
                    $shifts = $workingTime->shifts;
                    if($workingTime->from != $shifts[0]->from){
                        $startTime  = Carbon::parse($workingTime->from);
                        $finishTime = Carbon::parse($shifts[0]->from);
                        $totalDuration = $finishTime->diffInMinutes($startTime);

                        $space = intval($totalDuration / 30) ;
                        for ($j=0 ; $j< $space; $j++){
                            $t = ((object)['from' => $startTime->format('G:i'), 'to' => $startTime->addMinutes(30)->format('G:i')]);
                            $freeTimes[] = $t;
                        }
                    }

                    for($i=0; $i<$shifts->count(); $i++)
                    {
                        $startTime  = Carbon::parse($shifts[$i]->to);
                        try{
                            $finishTime = Carbon::parse($shifts[$i+1]->from);
                        } catch (Throwable $e) {
                            $finishTime = Carbon::parse($workingTime->to);
                        }

                        $totalDuration = $finishTime->diffInMinutes($startTime);

                        $space = intval($totalDuration / 30) ;
                        for ($j=0 ; $j< $space; $j++){
                            $t = ((object)['from' => $startTime->format('G:i'), 'to' => $startTime->addMinutes(30)->format('G:i')]);
                            $freeTimes[] = $t;
                        }
                    }
                }
            }

            foreach( $freeTimes as $key => $freeTime )
            {

                $check_from = OnlineConcultationWorkingTime::where('day', $day)
                                            ->where('from', '<=', $freeTime->from)
                                            ->where('to', '>=', $freeTime->from)
                                            ->get();
                if($check_from->count() > 0){
                    unset($freeTimes[$key]);
                }else{
                    $check_to = OnlineConcultationWorkingTime::where('day', $day)
                    ->where('from', '<=', $freeTime->to)
                    ->where('to', '>=', $freeTime->to)
                    ->get();
                    if($check_to->count() > 0){
                        unset($freeTimes[$key]);
                    }
                }
            }

            foreach( $freeTimes as $key => $freeTime )
            {
                $check_from = HomeConcultationWorkingTime::where('day', $day)
                                            ->where('from', '<=', $freeTime->from)
                                            ->where('to', '>=', $freeTime->from)
                                            ->get();
                if($check_from->count() > 0){
                    unset($freeTimes[$key]);
                }else{
                    $check_to = HomeConcultationWorkingTime::where('day', $day)
                    ->where('from', '<=', $freeTime->to)
                    ->where('to', '>=', $freeTime->to)
                    ->get();
                    if($check_to->count() > 0){
                        unset($freeTimes[$key]);
                    }
                }
            }
            //return $freeTimes;
            return $this->responseJson(200, "Online Avalible Time", $freeTimes);
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }


}