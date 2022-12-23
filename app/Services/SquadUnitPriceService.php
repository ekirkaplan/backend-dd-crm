<?php

namespace App\Services;

use App\Http\Resources\SquadUnitPriceResource;
use App\Models\SquadUnitPrice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class SquadUnitPriceService
{
    /**
     * @param SquadUnitPrice $squadUnitPrice
     * @return SquadUnitPriceResource
     */
    public function setSingle(SquadUnitPrice $squadUnitPrice): SquadUnitPriceResource
    {
        return new SquadUnitPriceResource($squadUnitPrice);
    }

    /**
     * @param Collection $squadUnitPrice
     * @return JsonResource
     */
    public function setPlural(Collection $squadUnitPrice): JsonResource
    {
        return SquadUnitPriceResource::collection($squadUnitPrice);
    }
}
