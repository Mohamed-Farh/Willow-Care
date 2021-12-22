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

class GeneralController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;




}
