<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\QuestionResource;

class QuizResource extends JsonResource
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
            'course_id' =>$this->course_id,
            'module_id' => $this->module_id,
            'published' => $this->published ? true : false,
            'questions' => QuestionResource::collection($this->questions),
            'date_created' => $this->date_created,
        ];
    }
}
