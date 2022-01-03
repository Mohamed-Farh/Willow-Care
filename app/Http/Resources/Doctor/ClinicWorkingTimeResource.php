<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;

class ClinicWorkingTimeResource extends JsonResource
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
            "day" => isset($this->day) ? $this->day : '',
            "from" => isset($this->from) ? $this->from : '',
            "to" => isset($this->to) ? $this->to : '',
        ];
    }
}
