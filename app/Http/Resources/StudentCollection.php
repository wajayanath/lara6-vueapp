<?php

namespace App\Http\Resources;

use App\Http\Resources\StudentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        // return [
        //     'data' => $this->collection
        // ];
        return StudentResource::collection($this->collection);
    }
}
