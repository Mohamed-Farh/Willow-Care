<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ClinicRequest;
use App\Http\Requests\Api\Doctor\ClinicWorkTimeRequest;
use App\Http\Requests\Api\Doctor\HomeConculationRequest;
use App\Http\Resources\Doctor\ClinicResource;
use App\Http\Resources\Doctor\HomeConculationResource;
use App\Models\Clinic;
use App\Models\HomeConcultation;
use Laravel\Passport\HasApiTokens;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Auth;

class HomeConcultationController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    public function getHomeConcultation(Request $request)
    {
        try {
            $HomeConcultation = HomeConcultation::where('doctor_id', Auth::user()->id)->get();
            return $this->responseJson(200, "Doctor Home Concultation", HomeConculationResource::collection($HomeConcultation));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
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
            $this->responseJsonFailed();
        }
    }



}
