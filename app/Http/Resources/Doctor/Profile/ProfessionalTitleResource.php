<?php

namespace App\Http\Resources\Doctor\Profile;

use App\Models\Doctor;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfessionalTitleResource extends JsonResource
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


        return [
            "id" => $this->id,
            "name" => isset($this->$name) ? $this->$name : '',
        ];
    }
}
