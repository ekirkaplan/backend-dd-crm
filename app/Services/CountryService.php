<?php

namespace App\Services;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryService
{
    /**
     * @param Country $country
     * @return CountryResource
     */
    public function setSingle(Country $country): CountryResource
    {
        return new CountryResource($country);
    }

    /**
     * @param Collection $countries
     * @return JsonResource
     */
    public function setPlural(Collection $countries): JsonResource
    {
        return CountryResource::collection($countries);
    }
}
