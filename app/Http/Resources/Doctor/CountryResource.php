<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */


    public function toArray($request)
    {

        return [
            "id" => $this->id,
            "name" => isset($this->name) ? $this->name : '',
            "flag" => isset($this->flag) ? env('APP_URL').'/public/'.$this->flag : '',
            "created_at" => strval($this->created_at),
            "updated_at" => strval($this->updated_at),
        ];

    }
}
