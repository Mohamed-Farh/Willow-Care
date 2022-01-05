<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Requests\Api\Doctor\SingleWorkTimeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\CheckTimeRequest;
use App\Http\Requests\Api\Doctor\CheckTimesRequest;
use App\Http\Requests\Api\Doctor\MultiWorkTimeRequest;
use App\Models\Clinic;
use App\Models\HomeConcultation;
use App\Models\OnlineConcultation;
use App\Traits\ApiTraits;
use Illuminate\Support\Facades\Auth;

class WorkTimeController extends Controller
{
    use ApiTraits;
    public function single(SingleWorkTimeRequest $request){
        if($request->booking_type == 0){
            $clinic = Clinic::where(['id'=> $request->type_id ,'doctor_id' => Auth::user()->id])->first();
            if(!$clinic){
                $this->responseJsonFailed(404, "this doctor can't control on this clinic");
            }
            $clinic->workingTimes()->where('day',$request->day_id )->delete();
            foreach($request->shifts  as $shift){
                $sigle_work_out = $clinic->workingTimes()->create([
                    'day' => $request->day_id,
                    'from' => $shift['from'],
                    'to' => $shift['to']
                ]);
            }
            return $this->responseJsonWithoutData();

        }elseif($request->booking_type == 1){
            $home = HomeConcultation::where(['id'=> $request->type_id ,'doctor_id' => Auth::user()->id])->first();
            if(!$home){
                $this->responseJsonFailed(404, "this doctor can't control on this Home Concultaion");
            }
            $home->workingTimes()->where('day',$request->day_id )->delete();
            foreach($request->shifts  as $shift){
                $sigle_work_out = $home->workingTimes()->create([
                    'day' => $request->day_id,
                    'from' => $shift['from'],
                    'to' => $shift['to']
                ]);
            }
            return $this->responseJsonWithoutData();
        }elseif($request->booking_type == 2){
            $online = OnlineConcultation::where(['id'=> $request->type_id ,'doctor_id' => Auth::user()->id])->first();
            if(!$online){
                $this->responseJsonFailed(404, "this doctor can't control on this Home Concultaion");
            }
            $online->workingTimes()->where('day',$request->day_id )->delete();
            foreach($request->shifts  as $shift){
                $sigle_work_out = $online->workingTimes()->create([
                    'day' => $request->day_id,
                    'from' => $shift['from'],
                    'to' => $shift['to']
                ]);
            }
            return $this->responseJsonWithoutData();
        }else{
            return $this->responseJsonFailed('200' ,'The selected booking type is invalid.');
        }
    }

    public function multiIndex(MultiWorkTimeRequest $request){
        if($request->booking_type == 0){
            $clinic = Clinic::where(['id'=> $request->type_id ,'doctor_id' => Auth::user()->id])->first();
            if(!$clinic){
                $this->responseJsonFailed(404, "this doctor can't control on this clinic");
            }
            $clinic->workingTimes()->delete();
            foreach( $request->days_ids as $day){
                foreach($request->shifts  as $shift){
                    $sigle_work_out = $clinic->workingTimes()->create([
                        'day' => $day,
                        'from' => $shift['from'],
                        'to' => $shift['to']
                    ]);
                }
            }    
            return $this->responseJsonWithoutData();
        }elseif($request->booking_type == 1){
            $home = HomeConcultation::where(['id'=> $request->type_id ,'doctor_id' => Auth::user()->id])->first();
            if(!$home){
                $this->responseJsonFailed(404, "this doctor can't control on this clinic");
            }
            $home->workingTimes()->delete();
            foreach( $request->days_ids as $day){
                foreach($request->shifts  as $shift){
                    $sigle_work_out = $home->workingTimes()->create([
                        'day' => $day,
                        'from' => $shift['from'],
                        'to' => $shift['to']
                    ]);
                }
            }    
            return $this->responseJsonWithoutData();
        }elseif($request->booking_type == 2){
            $online = OnlineConcultation::where(['id'=> $request->type_id ,'doctor_id' => Auth::user()->id])->first();
            if(!$online){
                $this->responseJsonFailed(404, "this doctor can't control on this clinic");
            }
            $online->workingTimes()->delete();
            foreach( $request->days_ids as $day){
                foreach($request->shifts  as $shift){
                    $sigle_work_out = $online->workingTimes()->create([
                        'day' => $day,
                        'from' => $shift['from'],
                        'to' => $shift['to']
                    ]);
                }
            }    
            return $this->responseJsonWithoutData();
        }else{
            return $this->responseJsonFailed('200' ,'The selected booking type is invalid.');
        }
    }


    public function checkTime(CheckTimeRequest $request){
        ############## check in online times
            $online = OnlineConcultation::where('doctor_id' , Auth::user()->id)->get();
            foreach ($online as $singleOnline){
                if($request->from){
                    $check_from = $singleOnline->workingTimes()->where('day', $request->day)
                    ->where('from', '<=', $request->from)
                    ->where('to', '>', $request->from)
                    ->get();
                    if($check_from->count() > 0){
                        return $this->responseJsonFailed('200' ,'This time conflicts with another online time');
                    }
                }elseif($request->to){
                    $check_to = $singleOnline->workingTimes()->where('day', $request->day)
                        ->where('from', '<', $request->to)
                        ->where('to', '>=', $request->to)
                        ->get();
                    if($check_to->count() > 0){
                        return $this->responseJsonFailed('200' ,'This time conflicts with another online time');
                    }
                }
            }
        ############## check in home times
            $home = HomeConcultation::where('doctor_id' , Auth::user()->id)->get();
            foreach ($home as $singleHome){
                if($request->from){
                    $check_from = $singleHome->workingTimes()->where('day', $request->day)
                    ->where('from', '<=', $request->from)
                    ->where('to', '>', $request->from)
                    ->get();
                    if($check_from->count() > 0){
                        return $this->responseJsonFailed('200' ,'This time conflicts with another home time');
                    }
                }elseif($request->to){
                    $check_to = $singleHome->workingTimes()->where('day', $request->day)
                        ->where('from', '<', $request->to)
                        ->where('to', '>=', $request->to)
                        ->get();
                    if($check_to->count() > 0){
                        return $this->responseJsonFailed('200' ,'This time conflicts with another home time');
                    }
                }
            }
        ############## check in clinic times
        $clinics = Clinic::where('doctor_id' , Auth::user()->id)->get();
        foreach ($clinics as $singleClinic){
            if($request->from){
                $check_from = $singleClinic->workingTimes()->where('day', $request->day)
                ->where('from', '<=', $request->from)
                ->where('to', '>', $request->from)
                ->get();
                if($check_from->count() > 0){
                    return $this->responseJsonFailed('200' ,'This time conflicts with another Clinic time');
                }
            }elseif($request->to){
                $check_to = $singleClinic->workingTimes()->where('day', $request->day)
                    ->where('from', '<', $request->to)
                    ->where('to', '>=', $request->to)
                    ->get();
                if($check_to->count() > 0){
                    return $this->responseJsonFailed('200' ,'This time conflicts with another clinic time');
                }
            }
        }
        return $this->responseJsonWithoutData();
    }

    public function checkTimes(CheckTimesRequest $request){
        ############## check in online times
            $online = OnlineConcultation::where('doctor_id' , Auth::user()->id)->get();
            foreach ($online as $singleOnline){
                if($request->from){
                    $check_from = $singleOnline->workingTimes()->whereIn('day', $request->days)
                    ->where('from', '<=', $request->from)
                    ->where('to', '>', $request->from)
                    ->get();
                    if($check_from->count() > 0){
                        return $this->responseJsonFailed('200' ,'This time conflicts with another online time');
                    }
                }elseif($request->to){
                    $check_to = $singleOnline->workingTimes()->whereIn('day', $request->days)
                        ->where('from', '<', $request->to)
                        ->where('to', '>=', $request->to)
                        ->get();
                    if($check_to->count() > 0){
                        return $this->responseJsonFailed('200' ,'This time conflicts with another online time');
                    }
                }
            }
        ############## check in home times
            $home = HomeConcultation::where('doctor_id' , Auth::user()->id)->get();
            foreach ($home as $singleHome){
                if($request->from){
                    $check_from = $singleHome->workingTimes()->whereIn('day', $request->days)
                    ->where('from', '<=', $request->from)
                    ->where('to', '>', $request->from)
                    ->get();
                    if($check_from->count() > 0){
                        return $this->responseJsonFailed('200' ,'This time conflicts with another home time');
                    }
                }elseif($request->to){
                    $check_to = $singleHome->workingTimes()->whereIn('day', $request->days)
                        ->where('from', '<', $request->to)
                        ->where('to', '>=', $request->to)
                        ->get();
                    if($check_to->count() > 0){
                        return $this->responseJsonFailed('200' ,'This time conflicts with another home time');
                    }
                }
            }
        ############## check in clinic times
        $clinics = Clinic::where('doctor_id' , Auth::user()->id)->get();
        foreach ($clinics as $singleClinic){
            if($request->from){
                $check_from = $singleClinic->workingTimes()->whereIn('day', $request->days)
                ->where('from', '<=', $request->from)
                ->where('to', '>', $request->from)
                ->get();
                if($check_from->count() > 0){
                    return $this->responseJsonFailed('200' ,'This time conflicts with another Clinic time');
                }
            }elseif($request->to){
                $check_to = $singleClinic->workingTimes()->whereIn('day', $request->days)
                    ->where('from', '<', $request->to)
                    ->where('to', '>=', $request->to)
                    ->get();
                if($check_to->count() > 0){
                    return $this->responseJsonFailed('200' ,'This time conflicts with another clinic time');
                }
            }
        }
        return $this->responseJsonWithoutData();
    }
}
