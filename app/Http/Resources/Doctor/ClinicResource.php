<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;

class ClinicResource extends JsonResource
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
            "name" => $this->name,
            "phone" => strval($this->phone),
            "another_phone" => strval($this->another_phone),
            "lat" => strval($this->lat),
            "long" => strval($this->long),
            "location" => $this->location,
            "price" => strval($this->price),
            "renewal_price" => strval($this->renewal_price),
            "duration" => strval($this->duration),
            "payment_method" => strval($this->payment_method),
            "clinic_image" => "public/".strval($this->image),
            "active" => '1',
            "doctor_id" => strval($this->doctor_id),
            "created_at" => strval($this->created_at),
            "updated_at" => strval($this->updated_at),
        ];
    }
}
