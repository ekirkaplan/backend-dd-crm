<?php

namespace App\Services;

use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class CityService
{
    /**
     * @param City $city
     * @return CityResource
     */
    public function setSingle(City $city): CityResource
    {
        return new CityResource($city);
    }

    /**
     * @param Collection $cities
     * @return JsonResource
     */
    public function setPlural(Collection $cities): JsonResource
    {
        return CityResource::collection($cities);
    }
}
