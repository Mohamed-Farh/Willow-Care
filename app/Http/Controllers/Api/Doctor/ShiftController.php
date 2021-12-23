<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\ClinicRequest;
use App\Http\Resources\Doctor\ClinicResource;
use App\Models\Clinic;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Throwable;
use App\Models\Specialty;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShiftController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;


}
