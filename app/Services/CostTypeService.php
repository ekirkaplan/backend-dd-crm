<?php

namespace App\Services;

use App\Http\Resources\CostTypeResource;
use App\Models\CostType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class CostTypeService
{
    /**
     * @param CostType $costType
     * @return CostTypeResource
     */
    public function setSingle(CostType $costType): CostTypeResource
    {
        return new CostTypeResource($costType);
    }

    /**
     * @param Collection $costType
     * @return JsonResource
     */
    public function setPlural(Collection $costType): JsonResource
    {
        return CostTypeResource::collection($costType);
    }
}
