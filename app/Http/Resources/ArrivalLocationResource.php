<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArrivalLocationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'city_id' => $this->city->id,
            'transport_unit_price' => $this->transport_unit_price,
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->description,
            'city' => new CityResource($this->city)
        ];
    }
}
