<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'gender'        => $this->gender,
            'joined_year'   => $this->joined_year,
            // 'teacher_id'    => $this->when($this->teacher_id == 1, 'Emily', 'Isabella'),
            'teacher_id'    => $this->teacher_id,
            // 'classroom_id'  => $this->classroom_id == 1 ? 'A' : $this->classroom_id == 2 ? 'B' : 'C',
            'classroom_id'  => $this->classroom_id,
        ];
    }
}
