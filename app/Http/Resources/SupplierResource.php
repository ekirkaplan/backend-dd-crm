<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'city' => new CityResource($this->city),
            'title' => $this->title,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'tax_no' => $this->tax_no,
            'tax_office' => $this->tax_office,
            'description' => $this->description
        ];
    }
}