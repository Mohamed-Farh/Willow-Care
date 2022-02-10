<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Doctor\SpecialtyResource;
use App\Http\Resources\Doctor\TermResource;
use App\Models\Category;
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
                $category = Category::where('id',1)->first();
                $ids = $category->specialties->pluck('id');
                $Specialties = Specialty::withoutAppends()->whereIn('id', $ids)
                                        ->where('active','1')
                                        ->get();
                return $this->responseJson(200, "all Specialties In Doctor Category", SpecialtyResource::collection($Specialties));
            }else{
                return $this->responseValidationJsonFailed(422,'language code is incorrect');
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }

    public function getTermsAndConditions(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'lang' => ['required', Rule::in(['en', 'ro', 'ar'])],
            ]);
            if ($validator->fails()) {
                return $this->responseValidationJsonFailed('language is incorrect or required');
            }
            $lang =  $_GET['lang'];
            if( $lang == 'ar' || $lang == 'en' || $lang =='ro'){
                $terms = Term::select('id' ,'text_'.$lang.' as text')
                                        ->where('active','1')
                                        ->where('category_id','1')
                                        ->get();
                                        
                return $this->responseJson(200, "Terms & Conditions", TermResource::collection($terms));
            }else{
                return $this->responseValidationJsonFailed('language code is incorrect');
            }
        } catch (Throwable $e) {
            return $this->responseJsonFailed();
        }
    }




}
