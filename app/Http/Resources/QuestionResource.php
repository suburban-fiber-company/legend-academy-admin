<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\QuestionOptionResource;

class QuestionResource extends JsonResource
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
            'question' => $this->question,
            'correct_answer' => $this->correct_answer,
            'quiz_id' => $this->quiz_id,
            'options' => QuestionOptionResource::collection($this->options),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
