<?php

namespace App\Http\Resources\Doctor\Profile;

use App\Http\Resources\Doctor\LicenseResource;
use App\Models\License;
use Illuminate\Http\Resources\Json\JsonResource;

class BasicInformationResource extends JsonResource
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
            "lang" => strval($this->lang),
            "phone" => $this->phone,
            "email" => $this->email,
            "phone_verification" => strval($this->phone_verification),
            "code" => $this->country->code,
            "approve_status" => strval($this->is_approved),
            "fb_id" => isset($this->f_code) ? $this->f_code : '',
            "google_id" => isset($this->g_code) ? $this->g_code : '',
            "apple_id" => isset($this->a_code) ? $this->a_code : '',
            "rate" => '1',
            "profile_view" => '1',
            "patients_count" => '1',
            "exp_years" => '5',
            "professional_title_id" =>isset($this->professional_title_id) ? $this->professional_title_id : '',
            "profile_image"=>isset($this->image) ? env('APP_URL').'/public/'.$this->image : '',
            "gender" => ($this->gender == 0) ? "male" : "female",
            "about" => isset($this->about) ? $this->about : '',
            // "user_token" => isset($this->api_token) ? $this->api_token : '',
            // "device_token" => isset($this->device_token) ? $this->device_token : '',
            'licenses' => LicenseResource::collection(License::where('doctor_id', $this->id)->get()),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
