<?php

namespace App\Http\Resources\Doctor\Profile;

use App\Models\Doctor;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileSpecialtyResource extends JsonResource
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

        $mySpecialty = DB::table('doctor_specialty')->where('doctor_id', Auth::guard('api-doctor')->id())->pluck('specialty_id')->toArray();

        if (in_array($this->id, $mySpecialty))
        { $selected = "1"; }
        else
        {  $selected = "0"; }



        return [
            "id" => $this->id,
            "name" => isset($this->name) ? $this->name : '',
            "image" => isset($this->icon) ? 'public/'.$this->icon : '',
            "selected" => $selected,
            "created_at" => strval($this->created_at),
            "updated_at" => strval($this->updated_at),
        ];
    }
}
