<?php

namespace App\Http\Resources\Doctor\Profile;

use App\Models\Doctor;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileInsuranceCompaniesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(request()->user()->lang){
            $name = "name_". request()->user()->lang;
        }else{
            $name = "name_en";
        }

        $myCompanies = DB::table('doctor_insurance_company')->where('doctor_id', Auth::guard('api-doctor')->id())->pluck('insurance_company_id')->toArray();

        if (in_array($this->id, $myCompanies))
        { $selected = "1"; }
        else
        {  $selected = "0"; }



        return [
            "id" => $this->id,
            "name" => isset($this->$name) ? $this->$name : '',
            "image" => isset($this->image) ? env('APP_URL').'/public/'.$this->image : '',
            "selected" => $selected,
            "created_at" => strval($this->created_at),
            "updated_at" => strval($this->updated_at),
        ];
    }
}
