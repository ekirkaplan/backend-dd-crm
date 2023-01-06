<?php

namespace App\Services;

use App\Http\Resources\ContractShipmentResource;
use App\Models\ContractShipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractShipmentService
{
    /**
     * @param  ContractShipment  $contractShipment
     * @return ContractShipmentResource
     */
    public function setSingle(ContractShipment $contractShipment): ContractShipmentResource
    {
        return new ContractShipmentResource($contractShipment);
    }

    /**
     * @param Collection $contractShipments
     * @return JsonResource
     */
    public function setPlural(Collection $contractShipments): JsonResource
    {
        return ContractShipmentResource::collection($contractShipments);
    }
}
