<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChiefDirectorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'region_director' => new RegionDirectorResource($this->regionDirector),
            'name' => $this->name,
            'description' => $this->description
        ];
    }
}
