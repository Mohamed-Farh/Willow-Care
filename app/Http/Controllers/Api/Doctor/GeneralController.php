<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
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

class GeneralController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    public function getSpecialties(Request $request)
    {
        try {
            $lang =  Auth::user()->lang;
            if( $lang == 'ar' || $lang == 'en' || $lang =='ro'){
                $Specialties = Specialty::select('id' ,'name_'.$lang.' as name' , 'icon')
                                        ->where('type','Doctor')
                                        ->where('active','1')
                                        ->get();
                return $this->responseJson("200", "all Specialties In Doctor Category", $Specialties);
            }else{
                return $this->responseJsonFailed('404','language code is incorrect');
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }

    public function getTermsAndConditions(Request $request)
    {
        try {
            $lang =  Auth::user()->lang;
            if( $lang == 'ar' || $lang == 'en' || $lang =='ro'){
                $terms = Term::select('id' ,'text_'.$lang.' as text')
                                        ->where('active','1')
                                        ->where('app_type','Doctor')
                                        ->get();
                return $this->responseJson("200", "all Terms In Doctor Category", $terms);
            }else{
                return $this->responseJsonFailed('404','language code is incorrect');
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }




}
