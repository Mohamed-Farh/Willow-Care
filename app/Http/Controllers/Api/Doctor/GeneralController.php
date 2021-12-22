<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Throwable;
use App\Models\Specialty;

class GeneralController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    public function getSpecialties(Request $request){
        try {
            $lang =  $_GET['lang'];
            if( $lang == 'ar' || $lang == 'en' || $lang =='ro'){
                $Specialties = Specialty::select('id' ,'name_'.$lang)
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


}
