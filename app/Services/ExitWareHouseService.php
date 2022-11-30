<?php

namespace App\Services;

use App\Http\Resources\ExitWareHouseResource;
use App\Models\ExitWareHouse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ExitWareHouseService
{
    /**
     * @param ExitWareHouse $exitWareHouse
     * @return ExitWareHouseResource
     */
    public function setSingle(ExitWareHouse $exitWareHouse): ExitWareHouseResource
    {
        return new ExitWareHouseResource($exitWareHouse);
    }

    /**
     * @param Collection $exitWareHouses
     * @return JsonResource
     */
    public function setPlural(Collection $exitWareHouses): JsonResource
    {
        return ExitWareHouseResource::collection($exitWareHouses);
    }
}
