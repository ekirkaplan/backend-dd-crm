<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'city_id' => $this->city->id,
            'title' => $this->title,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'tax_no' => $this->tax_no,
            'tax_office_id' => $this->tax_office_id,
            'description' => $this->description,
            'city' => new CityResource($this->city),
            'files' => $this->medias
        ];
    }
}
