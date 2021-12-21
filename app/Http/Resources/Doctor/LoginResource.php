<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            "lang" => $this->lang,
            "phone" => $this->phone,
            "email" => $this->email,
            "phone_verification" => $this->phone_verification,
            "code" => $this->code,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "location" => $this->location,
            "approve_status" => $this->is_approved,
            "fb_id" => $this->f_code,
            "google_id" => $this->g_code,
            "apple_id" => $this->a_code,
            "rate" => '###',
            "profile_view" => '###',
            "patients_count" => '###',
            "exp_years" => 1111111111,
            "professional_title" =>  $this->professional_title,
            "profile_image"=>$this->image,
            "gender" => ($this->gender == 0) ? "male" : "female",
            "about" => $this->about,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
