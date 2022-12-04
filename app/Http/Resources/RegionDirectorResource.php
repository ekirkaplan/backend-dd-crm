<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionDirectorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'city_id' => $this->city->id,
            'name' => $this->name,
            'description' => $this->description,
            'city'=> new CityResource($this->city)
        ];
    }
}
