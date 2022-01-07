<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkingTimeResource extends JsonResource
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
            "from" => isset($this->from) ? \Carbon\Carbon::createFromTimeStamp(strtotime($this->from))->format('H:i') : '',
            "to" => isset($this->to) ? \Carbon\Carbon::createFromTimeStamp(strtotime($this->to))->format('H:i') : '',
        ];

    }
}
