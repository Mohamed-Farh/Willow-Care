<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;

class LicenseResource extends JsonResource
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
            "image" => isset($this->image) ? env('APP_URL').'/public/'.$this->image : '',
            "doctor_id" => strval($this->doctor_id),
            "created_at" => strval($this->created_at),
            "updated_at" => strval($this->updated_at),
        ];
    }
}
