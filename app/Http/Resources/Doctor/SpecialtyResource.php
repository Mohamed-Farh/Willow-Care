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
            "another_phone" => $this->another_phone,
            "lat" => $this->lat,
            "long" => strval($this->long),
            "location" => $this->location,
            "price" => $this->price,
            "renewal_price" => $this->renewal_price,
            "duration" => $this->duration,
            "payment_method" => $this->payment_method,
            "clinic_image" => $this->image,
            "active" => '1',
            "doctor_id" => $this->doctor_id,
            "active" => '1',
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
