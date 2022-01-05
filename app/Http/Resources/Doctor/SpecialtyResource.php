<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialtyResource extends JsonResource
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
            "image" => isset($this->icon) ? env('APP_URL').'/public/'.$this->icon : '',
            "created_at" => strval($this->created_at),
            "updated_at" => strval($this->updated_at),
        ];

    }
}
