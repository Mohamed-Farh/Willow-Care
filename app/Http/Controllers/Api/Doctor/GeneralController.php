<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Throwable;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{

    use ApiTraits, HelperTrait, HasApiTokens;

    public function getSpecialties(Request $request)
    {
        try {
            $lang =  Auth::user()->lang;
            if( $lang == 1){$lang = 'ro';};
            if( $lang == 2){$lang = 'en';};
            if( $lang == 3){$lang = 'ar';};

            if( $lang == 'ar' || $lang == 'en' || $lang =='ro'){
                $Specialties = Specialty::select('id' ,'name_'.$lang.' as name')
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
