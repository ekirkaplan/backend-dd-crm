<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChiefDirectorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'region_director_id' => $this->regionDirector->id,
            'name' => $this->name,
            'description' => $this->description,
            'region_director' => new RegionDirectorResource($this->regionDirector)
        ];
    }
}
