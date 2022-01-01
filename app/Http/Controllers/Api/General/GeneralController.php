<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ForgotPasswordRequest;
use App\Http\Requests\Api\Doctor\RegisterRequest;
use App\Http\Requests\Api\General\LoginRequest;
use App\Http\Resources\Doctor\LoginResource;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use Hash;
use App\Models\Doctor;
use App\Models\Country;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\Models\DeviceToken;
use App\Models\Specialty;
use Illuminate\Validation\Rule;

class GeneralController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;


    public function login(LoginRequest $request)
    {
        try {
            if ($request->app_type == 1){  // it's mean doctor App
                $auth = Auth::guard('doctor')->attempt(['phone' => $request->phone, 'password' => $request->password]);
                $auth_user = Doctor::where("phone", $request->phone)->first();
                $check_device_token = DeviceToken::where('token',$request->device_token)->first();
                $apiToke  = $auth_user->createToken('auth_token')->accessToken;
                if(!$check_device_token){
                    $device_token = DeviceToken::create([
                        'token' => $request->device_token,
                        'type' => 'Doctor',
                        'type_token' => $apiToke,
                    ]);
                }else{
                    $device_token = DeviceToken::where('token' , $request->device_token)->update(['type_token'=>$apiToke]);
                };
            }else{
                return $this->responseJsonFailed(404, 'the app type is incorrect');
            }

            if (!Auth::guard('doctor')->attempt(["phone" => $request->phone, "password" => $request->password])) {
                return $this->responseJsonFailed(404, 'the phone number or password is incorrect');
            }else{
                $auth_user->api_token = $apiToke;
                $auth_user->device_token = $request->device_token;
                return $this->responseJson(200, "Doctor Login Successfully", new LoginResource($auth_user));
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }

    }


    public function getCountries(Request $request)
    {
        try {
            $lang = $request->header('lang');
            if( $lang == 'ar' || $lang == 'en' || $lang =='ro'){
                $countries = Country::select('id' ,'name_'.$lang.' as name', 'flag', 'code')->where('active','1')->get();
                return $this->responseJson(200, "all countries data", $countries);
            }else{
                return $this->responseValidationJsonFailed('language code is incorrect');
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }




}
