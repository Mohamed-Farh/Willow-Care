<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;

class OnlineConculationResource extends JsonResource
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
            "id" => isset($this->id) ? $this->i : 0 ,
            "price" => isset($this->price) ? strval($this->price) : '',
            "renewal_price" => isset($this->renewal_price) ? strval($this->renewal_price) : '',
            "doctor_id" => isset($this->doctor_id) ? strval($this->doctor_id) : '',
            "created_at" => isset($this->created_at) ? strval($this->created_at) : '',
            "updated_at" => isset($this->updated_at) ? strval($this->updated_at) : '',
        ];
    }
}
