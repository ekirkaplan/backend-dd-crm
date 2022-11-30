<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionDirectorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'city'=> new CityResource($this->city),
            'name' => $this->name,
            'description' => $this->description
        ];
    }
}
