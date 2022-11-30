<?php

namespace App\Services;

use App\Http\Resources\CustomerUnitPriceResource;
use App\Models\CustomerUnitPrice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerUnitPriceService
{
    /**
     * @param CustomerUnitPrice $customerUnitPrice
     * @return CustomerUnitPriceResource
     */
    public function setSingle(CustomerUnitPrice $customerUnitPrice): CustomerUnitPriceResource
    {
        return new CustomerUnitPriceResource($customerUnitPrice);
    }

    /**
     * @param Collection $customerUnitPrices
     * @return JsonResource
     */
    public function setPlural(Collection $customerUnitPrices): JsonResource
    {
        return CustomerUnitPriceResource::collection($customerUnitPrices);
    }
}
