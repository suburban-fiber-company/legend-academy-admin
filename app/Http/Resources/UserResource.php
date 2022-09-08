<?php

namespace App\Http\Resources;

use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' =>$this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'user_type' => $this->user_type,
            'department' => $this->department($this->department_id),
            'created_at' => $this->created_at->format('F jS, Y'),
        ];
    }

    protected function department($id) {

        $data = Department::find($id);
        return $data->name;
    }
}
