<?php

namespace App\Services;

use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleService
{
    /**
     * @param  Vehicle  $vehicle
     * @return VehicleResource
     */
    public function setSingle(Vehicle $vehicle): VehicleResource
    {
        return new VehicleResource($vehicle);
    }

    /**
     * @param  Collection  $vehicles
     * @return JsonResource
     */
    public function setPlural(Collection $vehicles): JsonResource
    {
        return VehicleResource::collection($vehicles);
    }
}
