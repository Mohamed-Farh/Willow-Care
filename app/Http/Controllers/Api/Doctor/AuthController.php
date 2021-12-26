<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ForgotPasswordRequest;
use App\Http\Requests\Api\Doctor\ChangePasswordRequest;
use App\Http\Requests\Api\Doctor\PhoneVerifyRequest;
use App\Http\Requests\Api\Doctor\RegisterRequest;
use App\Http\Requests\Api\General\LoginRequest;
use App\Http\Resources\Doctor\LoginResource;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use Hash;
use App\Models\Doctor;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\Models\DeviceToken;

class AuthController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    public function doctorRegister(RegisterRequest $request){
        try {
            // $img = $this->uploadImages($request->image, "images/doctor/profile");
            $doctor = Doctor::create($request->all());
            // $doctor->update(["image" => $img]);
            $doctor = Doctor::where('id', $doctor->id)->first();
            $apiToke  = $doctor->createToken('auth_token')->accessToken;
            $device_token = DeviceToken::create([
                'token' => $request->device_token,
                'type' => 'Doctor',
                'type_token' => $apiToke,
            ]);
            $doctor->api_token = $apiToke;
            $doctor->device_token = $request->device_token;
            return $this->responseJson(200 , "Registration Successfully", new LoginResource($doctor));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    public function forgetPassword(ForgotPasswordRequest $request){
        try {
            $doctor = Doctor::where("phone", $request->phone)->first();
            $doctor->update(["password" => $request->password]);
            return $this->responseJsonWithoutData();
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    public function changePassword(ChangePasswordRequest $request){
        try {
            Auth::user()->update(["password" => $request->new_password]);
            return $this->responseJsonWithoutData();
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }


    public function phoneVerify(PhoneVerifyRequest $request){
        try {
            Auth::user()->update(["phone_verification" => $request->phone_verify]);
            $doctor = Auth::user();
            $doctor->api_token = $request->bearerToken();
            $device_token = DeviceToken::where('type_token', $request->bearerToken())->first();
            $doctor->device_token = $device_token->token;
            return $this->responseJson(200 , "Phone has been verified", new LoginResource($doctor));
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }
    }

    public function changeProfileImage(Request $request){
        if($request->image){
            $img = $this->uploadImages($request->image, "public/images/doctor/profile");
            $doctor = Auth::user();
            $doctor->update(["image" => $img]);
            return $this->responseJsonWithoutData();
        }else{
            $this->responseJsonFailed(011, 'image field is required');
        }
    }


}
