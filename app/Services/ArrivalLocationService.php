<?php

namespace App\Services;

use App\Http\Resources\ArrivalLocationResource;
use App\Models\ArrivalLocation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ArrivalLocationService
{
    /**
     * @param ArrivalLocation $arrivalLocation
     * @return ArrivalLocationResource
     */
    public function setSingle(ArrivalLocation $arrivalLocation): ArrivalLocationResource
    {
        return new ArrivalLocationResource($arrivalLocation);
    }

    /**
     * @param Collection $arrivalLocations
     * @return JsonResource
     */
    public function setPlural(Collection $arrivalLocations): JsonResource
    {
        return ArrivalLocationResource::collection($arrivalLocations);
    }
}
