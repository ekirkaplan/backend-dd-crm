<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerUnitPriceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'customer' => new CustomerResource($this->customer),
            'product_type' => new ProductTypeResource($this->productType),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'purchase_unit_price' => $this->purchase_unit_price
        ];
    }
}
