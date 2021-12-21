<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ForgotPasswordRequest;
use App\Http\Requests\Api\Doctor\RegisterRequest;
use App\Http\Requests\Api\General\LoginRequest;
use App\Http\Resources\Doctor\LoginResource;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Doctor;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    public function doctorRegister(RegisterRequest $request){
        try {
            $img = $this->uploadImages($request->image, "images/doctors/profiles");
            $doctor = Doctor::create($request->all());
            $doctor->update(["image" => $img]);
            $apiToke  = $doctor->createToken('auth_token')->accessToken;
            return $this->responseJson("200", "Registration Successfully",
            [
                "api_token" => $apiToke,
                "Doctor" => new LoginResource($doctor),

            ]);
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

    public function doctorLogin(LoginRequest $request)
    {

        try {
            if ($request->app_type == 1){  // it's mean doctor App
                $auth = Auth::guard('doctor')->attempt(["phone" => $request->phone, "password" => $request->password]);
                $auth_user = Doctor::where("phone", $request->phone)->first();
            }else{
                return $this->responseJsonFailed('404', 'the app type is incorrect');
            }

            if (!$auth) {
                return $this->responseJsonFailed('404', 'the phone number or password is incorrect');
            }else{
                $apiToke  = $auth_user->createToken('auth_token')->accessToken;
                // return $apiToke;
                return $this->responseJson("200", "Doctor Login Successfully",
                    [
                        "api_token" => $apiToke,
                        "Doctor" => new LoginResource($auth_user),

                    ]);
        }
        } catch (Throwable $e) {
            $this->responseJsonFailed();
        }

    }


}
