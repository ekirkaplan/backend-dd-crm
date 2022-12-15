<?php

namespace App\Services;

use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverService
{
    /**
     * @param  Driver  $driver
     * @return DriverResource
     */
    public function setSingle(Driver $driver): DriverResource
    {
        return new DriverResource($driver);
    }

    /**
     * @param  Collection  $drivers
     * @return JsonResource
     */
    public function setPlural(Collection $drivers): JsonResource
    {
        return DriverResource::collection($drivers);
    }
}
