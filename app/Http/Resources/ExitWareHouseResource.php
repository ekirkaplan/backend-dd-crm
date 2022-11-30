<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExitWareHouseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'city' => new CityResource($this->city),
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'description' => $this->description,
        ];
    }
}
