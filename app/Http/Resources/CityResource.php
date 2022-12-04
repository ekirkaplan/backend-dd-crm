<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'country_id' => $this->country->id,
            'country' => $this->country->name,
            'name' => $this->name,
        ];
    }
}
