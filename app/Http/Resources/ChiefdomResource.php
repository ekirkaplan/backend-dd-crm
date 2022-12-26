<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChiefdomResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'chief_director_id' => $this->chief_director_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'description' => $this->description,
            'chief_director' => new ChiefDirectorResource($this->chiefDirector)
        ];
    }
}
