<?php

namespace App\Services;

use App\Http\Resources\CustomerShipmentResource;
use App\Models\CustomerShipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerShipmentService
{
    /**
     * @param CustomerShipment $customerShipment
     * @return CustomerShipmentResource
     */
    public function setSingle(CustomerShipment $customerShipment): CustomerShipmentResource
    {
        return new CustomerShipmentResource($customerShipment);
    }

    /**
     * @param Collection $customerShipments
     * @return JsonResource
     */
    public function setPlural(Collection $customerShipments): JsonResource
    {
        return CustomerShipmentResource::collection($customerShipments);
    }
}
