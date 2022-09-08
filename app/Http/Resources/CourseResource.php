<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'number_of_modules' => $this->number_of_modules,
            'number_enrolled' => $this->number_enrolled,
            'user_id' => $this->user_id,
            'department_id' => $this->department_id,
            'status' => $this->status,
            'created_by'=> "johnebuka@gmail.com",
            'created_at' => $this->created_at->format('F jS, Y'),
            'updated_at' => $this->updated_at->format('F jS, Y'),
        ];
    }
}
