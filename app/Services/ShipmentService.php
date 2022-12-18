<?php

namespace App\Services;

use App\Http\Resources\ArrivalLocationResource;
use App\Http\Resources\ShipmentResource;
use App\Models\ArrivalLocation;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentService
{
    /**
     * @param Shipment $shipment
     * @return ShipmentResource
     */
    public function setSingle(Shipment $shipment): ShipmentResource
    {
        return new ShipmentResource($shipment);
    }

    /**
     * @param Collection $shipments
     * @return JsonResource
     */
    public function setPlural(Collection $shipments): JsonResource
    {
        return ShipmentResource::collection($shipments);
    }
}
