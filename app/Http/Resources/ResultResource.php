<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
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
            'user_id' =>$this->user_id,
            'course_id' => $this->course_id,
            'module_id' => $this->module_id,
            'correct_answers' => $this->correct_answers,
            'questions_count'=> $this->questions_count,
        ];
    }
}
